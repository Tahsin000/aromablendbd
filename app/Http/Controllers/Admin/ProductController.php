<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductTag;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['images', 'tags'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('badge', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }

        $products = $query->paginate(15)->withQueryString();

        return view('admin.ecommerce.products.index', compact('products'));
    }

    public function create()
    {
        $mediaLibraryImages = $this->mediaLibraryImages();

        return view('admin.ecommerce.products.create', compact('mediaLibraryImages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255',
            'desc'           => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'badge'          => 'nullable|string|max:100',
            'stock'          => 'required|integer|min:0',
            'discount_label' => 'nullable|string|max:255',
            'review_count'   => 'nullable|integer|min:0',
            'is_active'      => 'nullable|in:0,1',
            'sort_order'     => 'nullable|integer|min:0',
            'existing_images'   => 'nullable|array',
            'existing_images.*' => [
                'string',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (!is_string($value) || !$this->isValidExistingProductImagePath($value)) {
                        $fail('One or more selected media files are no longer available.');
                    }
                },
            ],
            'new_images'     => 'nullable|array',
            'new_images.*'   => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'tags'           => 'nullable|array',
            'tags.*.label'   => 'required_with:tags|string|max:255',
            'tags.*.color'   => 'nullable|in:green,red,amber,blue,purple',
        ]);

        $validated['slug']        = Str::slug($validated['slug'] ?? $validated['name']);
        $validated['is_active']   = ($validated['is_active'] ?? '0') === '1';
        $validated['sort_order']  = $validated['sort_order'] ?? 0;
        $validated['review_count']= $validated['review_count'] ?? 0;

        DB::transaction(function () use ($request, $validated) {
            $product = Product::create(collect($validated)->except(['existing_images', 'new_images', 'tags'])->toArray());

            $nextOrder = 1;
            $hasPrimary = false;

            foreach (array_values(array_unique($validated['existing_images'] ?? [])) as $path) {
                $this->attachImagePath($product, $path, $nextOrder, $hasPrimary);
            }

            if ($request->hasFile('new_images')) {
                $this->attachUploadedImages($product, $request->file('new_images'), $nextOrder, $hasPrimary);
            }

            // Handle tags
            if (!empty($validated['tags'])) {
                foreach ($validated['tags'] as $i => $tag) {
                    ProductTag::create([
                        'product_id' => $product->id,
                        'label'      => $tag['label'],
                        'color'      => $tag['color'] ?? 'green',
                        'sort_order' => $i + 1,
                    ]);
                }
            }
        });

        return redirect()->route('admin.ecommerce.products.index')
            ->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $product->load(['images', 'tags']);
        $mediaLibraryImages = $this->mediaLibraryImages();

        return view('admin.ecommerce.products.edit', compact('product', 'mediaLibraryImages'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'slug'           => 'nullable|string|max:255',
            'desc'           => 'nullable|string',
            'price'          => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'badge'          => 'nullable|string|max:100',
            'stock'          => 'required|integer|min:0',
            'discount_label' => 'nullable|string|max:255',
            'review_count'   => 'nullable|integer|min:0',
            'is_active'      => 'nullable|in:0,1',
            'sort_order'     => 'nullable|integer|min:0',
            'existing_images'   => 'nullable|array',
            'existing_images.*' => [
                'string',
                function (string $attribute, mixed $value, \Closure $fail) {
                    if (!is_string($value) || !$this->isValidExistingProductImagePath($value)) {
                        $fail('One or more selected media files are no longer available.');
                    }
                },
            ],
            'new_images'     => 'nullable|array',
            'new_images.*'   => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'delete_images'  => 'nullable|array',
            'delete_images.*'=> [
                'integer',
                Rule::exists('product_images', 'id')->where(fn ($query) => $query->where('product_id', $product->id)),
            ],
            'primary_image'  => [
                'nullable',
                'integer',
                Rule::exists('product_images', 'id')->where(fn ($query) => $query->where('product_id', $product->id)),
            ],
            'tags'           => 'nullable|array',
            'tags.*.label'   => 'required_with:tags|string|max:255',
            'tags.*.color'   => 'nullable|in:green,red,amber,blue,purple',
        ]);

        $validated['slug']         = Str::slug($validated['slug'] ?? $validated['name']);
        // Preserve current status when a partial update payload omits is_active.
        $validated['is_active']    = ($validated['is_active'] ?? ($product->is_active ? '1' : '0')) === '1';
        $validated['sort_order']   = $validated['sort_order'] ?? 0;
        $validated['review_count'] = $validated['review_count'] ?? 0;

        DB::transaction(function () use ($request, $product, $validated) {
            $product->update(collect($validated)->except(['existing_images', 'new_images', 'delete_images', 'primary_image', 'tags'])->toArray());

            // Delete selected images
            if (!empty($validated['delete_images'])) {
                $toDelete = ProductImage::whereIn('id', $validated['delete_images'])
                    ->where('product_id', $product->id)->get();
                foreach ($toDelete as $img) {
                    $this->deleteProductImage($img);
                }
            }

            $nextOrder = (int) ($product->images()->max('sort_order') ?? 0) + 1;
            $hasPrimary = $product->images()->where('is_primary', true)->exists();

            foreach (array_values(array_unique($validated['existing_images'] ?? [])) as $path) {
                $this->attachImagePath($product, $path, $nextOrder, $hasPrimary);
            }

            if ($request->hasFile('new_images')) {
                $this->attachUploadedImages($product, $request->file('new_images'), $nextOrder, $hasPrimary);
            }

            // Set primary image if it still exists after deletions.
            if (!empty($validated['primary_image'])) {
                $primaryExists = $product->images()->whereKey($validated['primary_image'])->exists();
                if ($primaryExists) {
                    $product->images()->update(['is_primary' => false]);
                    $product->images()->where('id', $validated['primary_image'])->update(['is_primary' => true]);
                }
            }

            $this->ensurePrimaryImage($product);

            // Replace tags only when tags are present in this request payload.
            if (array_key_exists('tags', $validated)) {
                $product->tags()->delete();
                if (!empty($validated['tags'])) {
                    foreach ($validated['tags'] as $i => $tag) {
                        ProductTag::create([
                            'product_id' => $product->id,
                            'label'      => $tag['label'],
                            'color'      => $tag['color'] ?? 'green',
                            'sort_order' => $i + 1,
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.ecommerce.products.index')
            ->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            $product->loadMissing('images');
            foreach ($product->images as $img) {
                $this->deleteProductImage($img);
            }
            $product->delete();
        });

        return redirect()->route('admin.ecommerce.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->update(['is_active' => !$product->is_active]);
        return back()->with('success', 'Product status updated.');
    }

    public function toggleHighlight(Product $product)
    {
        $product->update(['highlight' => !$product->highlight]);
        return back()->with('success', 'Product highlight updated.');
    }

    public function destroyImage(Product $product, \App\Models\ProductImage $image)
    {
        // Ensure the image belongs to this product
        abort_if($image->product_id !== $product->id, 403);

        $this->deleteProductImage($image);
        $this->ensurePrimaryImage($product);

        return back()->with('success', 'Image deleted.');
    }

    public function destroyImages(Request $request, Product $product)
    {
        $validated = $request->validate([
            'image_ids'   => 'required|array|min:1',
            'image_ids.*' => [
                'integer',
                Rule::exists('product_images', 'id')->where(fn ($query) => $query->where('product_id', $product->id)),
            ],
        ]);

        $deletedCount = 0;
        DB::transaction(function () use ($product, $validated, &$deletedCount) {
            $images = ProductImage::where('product_id', $product->id)
                ->whereIn('id', $validated['image_ids'])
                ->get();

            foreach ($images as $image) {
                $this->deleteProductImage($image);
                $deletedCount++;
            }

            $this->ensurePrimaryImage($product);
        });

        return back()->with('success', $deletedCount . ' image(s) deleted.');
    }

    private function mediaLibraryImages(): array
    {
        $disk = Storage::disk('public');
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'];

        return collect($disk->allFiles('products'))
            ->filter(function (string $path) use ($allowedExtensions) {
                return in_array(Str::lower(pathinfo($path, PATHINFO_EXTENSION)), $allowedExtensions, true);
            })
            ->map(function (string $path) use ($disk) {
                return [
                    'path' => $path,
                    'url' => ImageService::url($path),
                    'name' => basename($path),
                    'modified_at' => $disk->lastModified($path),
                ];
            })
            ->sortByDesc('modified_at')
            ->values()
            ->all();
    }

    private function isValidExistingProductImagePath(string $path): bool
    {
        $normalized = ltrim(str_replace('\\', '/', $path), '/');
        if (!Str::startsWith($normalized, 'products/')) {
            return false;
        }

        $ext = Str::lower(pathinfo($normalized, PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'gif', 'avif'], true)) {
            return false;
        }

        return Storage::disk('public')->exists($normalized);
    }

    private function attachImagePath(Product $product, string $path, int &$nextOrder, bool &$hasPrimary): void
    {
        $normalized = ltrim(str_replace('\\', '/', $path), '/');
        $alreadyAttached = $product->images()
            ->where('image_path', $normalized)
            ->exists();

        if ($alreadyAttached) {
            return;
        }

        ProductImage::create([
            'product_id' => $product->id,
            'image_path' => $normalized,
            'sort_order' => $nextOrder++,
            'is_primary' => !$hasPrimary,
        ]);

        $hasPrimary = true;
    }

    private function attachUploadedImages(Product $product, array $files, int &$nextOrder, bool &$hasPrimary): void
    {
        foreach ($files as $file) {
            $path = ImageService::upload($file, 'products');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'sort_order' => $nextOrder++,
                'is_primary' => !$hasPrimary,
            ]);
            $hasPrimary = true;
        }
    }

    private function deleteProductImage(ProductImage $image): void
    {
        $path = $image->image_path;
        $image->delete();

        if ($path && !ProductImage::where('image_path', $path)->exists()) {
            ImageService::delete($path);
        }
    }

    private function ensurePrimaryImage(Product $product): void
    {
        $hasPrimary = $product->images()->where('is_primary', true)->exists();
        if ($hasPrimary) {
            return;
        }

        $first = $product->images()->orderBy('sort_order')->orderBy('id')->first();
        if ($first) {
            $first->update(['is_primary' => true]);
        }
    }
}
