<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Services\ImageService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%")
                  ->orWhere('text', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status === 'active');
        }

        $reviews = $query->paginate(15);

        return view('admin.ecommerce.reviews', compact('reviews'));
    }

    public function create()
    {
        return view('admin.ecommerce.review-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'text'     => 'required|string',
            'stars'    => 'required|integer|min:1|max:5',
            'status'   => 'nullable|in:0,1',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:200',
        ]);

        $validated['status'] = $validated['status'] === '1';

        if ($request->hasFile('image')) {
            $validated['image'] = ImageService::upload($request->file('image'), 'reviews');
        }

        Review::create($validated);

        return redirect()->route('admin.ecommerce.reviews')
            ->with('success', 'Review added successfully.');
    }

    public function edit(Review $review)
    {
        return view('admin.ecommerce.review-edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'text'     => 'required|string',
            'stars'    => 'required|integer|min:1|max:5',
            'status'   => 'nullable|in:0,1',
            'image'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:200',
        ]);

        $validated['status'] = $validated['status'] === '1';

        if ($request->hasFile('image')) {
            $validated['image'] = ImageService::replace($review->image, $request->file('image'), 'reviews');
        }

        $review->update($validated);

        return redirect()->route('admin.ecommerce.reviews')
            ->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        if ($review->image) {
            ImageService::delete($review->image);
        }
        $review->delete();

        return redirect()->route('admin.ecommerce.reviews')
            ->with('success', 'Review deleted successfully.');
    }

    public function toggleStatus(Review $review)
    {
        $review->update(['status' => !$review->status]);

        return back()->with('success', 'Review status updated.');
    }
}
