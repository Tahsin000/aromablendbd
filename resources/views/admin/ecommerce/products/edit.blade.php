@extends('admin.layouts.app')

@section('title', 'Edit Product | Aroma Blend Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Product: {{ $product->name }}</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show">
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.ecommerce.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $product->name) }}" required />
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   value="{{ old('slug', $product->slug) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Description</label>
                            <textarea name="desc" id="desc" rows="4" class="form-control">{{ old('desc', $product->desc) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Product Images</h5>
                    </div>
                    <div class="card-body">
                        @if($product->images->isNotEmpty())
                            @php
                                $defaultPrimaryId = old('primary_image') ?? optional($product->images->firstWhere('is_primary', true))->id;
                                $oldDeleteImages = collect(old('delete_images', []))->map(fn ($id) => (string) $id)->all();
                            @endphp
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-2">
                                <p class="text-muted small mb-0">Pick a primary image and optionally delete multiple images with a modal confirmation.</p>
                                <div class="d-flex flex-wrap gap-2">
                                    <button type="button" class="btn btn-soft-secondary btn-sm" id="toggle-select-images">Select All</button>
                                    <button type="button" class="btn btn-soft-danger btn-sm" id="open-delete-images-modal"
                                            data-bs-toggle="modal" data-bs-target="#deleteImagesModal" disabled>
                                        <i class="ti ti-trash me-1"></i> Delete Selected
                                    </button>
                                </div>
                            </div>

                            <div class="row g-3 mb-4" id="existing-images">
                                @foreach($product->images as $img)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <div class="card border text-center h-100">
                                        <div class="position-relative">
                                            <img src="{{ $img->url }}" class="card-img-top" style="height:110px;object-fit:cover;" alt="Product image">
                                            <div class="position-absolute top-0 end-0 m-2">
                                                <input type="checkbox"
                                                       class="form-check-input delete-image-checkbox"
                                                       name="delete_images[]"
                                                       value="{{ $img->id }}"
                                                       {{ in_array((string) $img->id, $oldDeleteImages, true) ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <div class="card-body p-2 d-flex flex-column gap-2">
                                            <label class="btn btn-soft-primary btn-xs mb-0 d-flex align-items-center justify-content-center gap-1" style="font-size:11px; cursor:pointer;">
                                                <input type="radio"
                                                       class="form-check-input m-0"
                                                       name="primary_image"
                                                       value="{{ $img->id }}"
                                                       {{ (string) $defaultPrimaryId === (string) $img->id ? 'checked' : '' }}>
                                                <span>Primary</span>
                                            </label>
                                            @if($img->is_primary)
                                                <span class="badge badge-soft-success">Current primary</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted small mb-4">No images uploaded yet. Add from media library or upload new files.</p>
                        @endif

                        <div class="border rounded p-3 mb-3">
                            <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-2">
                                <label class="form-label mb-0">Add From Existing Media</label>
                                <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#mediaLibraryModal">
                                    <i class="ti ti-photo me-1"></i> Choose From Media
                                </button>
                            </div>
                            <div id="selected-existing-empty" class="text-muted small">No additional media selected.</div>
                            <div id="selected-existing-list" class="row g-2"></div>
                            <div id="selected-existing-inputs"></div>
                        </div>

                        <div>
                            <label class="form-label" for="new-images">Upload New Images <small class="text-muted">(multiple)</small></label>
                            <input type="file" name="new_images[]" id="new-images" class="form-control" accept="image/*" multiple />
                            <small class="text-muted">JPEG/PNG/WEBP/GIF/AVIF - max 2MB each.</small>
                            <div id="new-image-preview" class="row g-2 mt-2"></div>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header border-light d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0">Product Tags / Labels</h5>
                        <button type="button" class="btn btn-soft-primary btn-sm" id="add-tag-btn">
                            <i class="ti ti-plus me-1"></i> Add Tag
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="tags-container">
                            @foreach($product->tags as $i => $tag)
                            <div class="row g-2 mb-2 align-items-center tag-row">
                                <div class="col">
                                    <input type="text" name="tags[{{ $i }}][label]" class="form-control form-control-sm"
                                           value="{{ $tag->label }}" placeholder="Tag label" required />
                                </div>
                                <div class="col-auto">
                                    <select name="tags[{{ $i }}][color]" class="form-select form-select-sm">
                                        @foreach(['green','red','amber','blue','purple'] as $c)
                                            <option value="{{ $c }}" {{ $tag->color === $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-soft-danger btn-sm remove-tag-btn">
                                        <i class="ti ti-x"></i>
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <p class="text-muted small" id="no-tags-msg" {{ $product->tags->isNotEmpty() ? 'style=display:none' : '' }}>No tags added.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Pricing & Stock</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="price" class="form-label">Sale Price (Tk) <span class="text-danger">*</span></label>
                            <input type="number" name="price" id="price" class="form-control"
                                   value="{{ old('price', $product->price) }}" min="0" step="0.01" required />
                        </div>
                        <div class="mb-3">
                            <label for="original_price" class="form-label">Original Price (Tk) <span class="text-danger">*</span></label>
                            <input type="number" name="original_price" id="original_price" class="form-control"
                                   value="{{ old('original_price', $product->original_price) }}" min="0" step="0.01" required />
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                            <input type="number" name="stock" id="stock" class="form-control"
                                   value="{{ old('stock', $product->stock) }}" min="0" required />
                        </div>
                        <div class="mb-3">
                            <label for="review_count" class="form-label">Review Count</label>
                            <input type="number" name="review_count" id="review_count" class="form-control"
                                   value="{{ old('review_count', $product->review_count) }}" min="0" />
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-header border-light">
                        <h5 class="card-title m-0">Display Options</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="badge" class="form-label">Badge Label</label>
                            <input type="text" name="badge" id="badge" class="form-control"
                                   value="{{ old('badge', $product->badge) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="discount_label" class="form-label">Discount Label</label>
                            <input type="text" name="discount_label" id="discount_label" class="form-control"
                                   value="{{ old('discount_label', $product->discount_label) }}" />
                        </div>
                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" id="sort_order" class="form-control"
                                   value="{{ old('sort_order', $product->sort_order) }}" min="0" />
                        </div>
                        <div>
                            <label class="form-label">Status</label>
                            <div class="d-flex gap-3 mt-1">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="activeYes" value="1"
                                           {{ old('is_active', $product->is_active ? '1' : '0') === '1' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeYes"><span class="badge bg-success">Active</span></label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="is_active" id="activeNo" value="0"
                                           {{ old('is_active', $product->is_active ? '1' : '0') === '0' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="activeNo"><span class="badge bg-danger">Inactive</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="ti ti-check me-1"></i> Update Product
                    </button>
                    <a href="{{ route('admin.ecommerce.products.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </form>

    <form id="delete-selected-images-form" action="{{ route('admin.ecommerce.products.images.destroy', $product) }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
        <div id="delete-selected-images-inputs"></div>
    </form>
</div>

<div class="modal fade" id="deleteImagesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Delete Images</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="mb-0">
                    Are you sure you want to delete <strong id="delete-images-count">0</strong> selected image(s)?
                    This action cannot be undone.
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger btn-sm" id="confirm-delete-images">
                    <i class="ti ti-trash me-1"></i> Delete Selected
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mediaLibraryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Media Library</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <input type="text" id="media-search" class="form-control" placeholder="Search by filename..." />
                </div>

                @if(!empty($mediaLibraryImages))
                    <div class="row g-3" id="media-grid">
                        @foreach($mediaLibraryImages as $media)
                            <div class="col-6 col-md-4 col-lg-3 media-item" data-media-name="{{ strtolower($media['name']) }}">
                                <label class="card border h-100 mb-0">
                                    <input type="checkbox" class="form-check-input position-absolute top-0 end-0 m-2 media-checkbox" value="{{ $media['path'] }}">
                                    <img src="{{ $media['url'] }}" class="card-img-top" style="height:120px;object-fit:cover;" alt="{{ $media['name'] }}">
                                    <div class="card-body p-2">
                                        <p class="mb-0 small text-truncate" title="{{ $media['name'] }}">{{ $media['name'] }}</p>
                                    </div>
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-muted small mt-3 mb-0 d-none" id="media-empty-search">No media matched your search.</p>
                @else
                    <div class="alert alert-light border mb-0">
                        No uploaded product media found yet. Upload images first to reuse them later.
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary btn-sm" id="use-selected-media">
                    Use Selected Media
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
const mediaLibrary = @json($mediaLibraryImages);
const mediaByPath = Object.fromEntries(mediaLibrary.map(item => [item.path, item]));
const selectedExisting = new Set(@json(old('existing_images', [])));

const selectedExistingList = document.getElementById('selected-existing-list');
const selectedExistingInputs = document.getElementById('selected-existing-inputs');
const selectedExistingEmpty = document.getElementById('selected-existing-empty');
const mediaModalElement = document.getElementById('mediaLibraryModal');

function renderSelectedExisting() {
    const paths = Array.from(selectedExisting);
    selectedExistingList.innerHTML = '';
    selectedExistingInputs.innerHTML = '';
    selectedExistingEmpty.classList.toggle('d-none', paths.length > 0);

    paths.forEach(path => {
        const media = mediaByPath[path];
        if (!media) return;

        const col = document.createElement('div');
        col.className = 'col-6 col-md-4 col-lg-3';
        col.innerHTML = `
            <div class="card border mb-0 h-100">
                <img src="${media.url}" class="card-img-top" style="height:100px;object-fit:cover;" alt="${media.name}">
                <div class="card-body p-2 d-flex justify-content-between align-items-center gap-2">
                    <span class="small text-truncate" title="${media.name}">${media.name}</span>
                    <button type="button" class="btn btn-soft-danger btn-xs remove-existing-media" data-path="${path}">
                        <i class="ti ti-x"></i>
                    </button>
                </div>
            </div>
        `;
        selectedExistingList.appendChild(col);

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'existing_images[]';
        input.value = path;
        selectedExistingInputs.appendChild(input);
    });

    document.querySelectorAll('.remove-existing-media').forEach(btn => {
        btn.addEventListener('click', function() {
            selectedExisting.delete(this.getAttribute('data-path'));
            renderSelectedExisting();
            syncModalCheckboxes();
        });
    });
}

function syncModalCheckboxes() {
    document.querySelectorAll('.media-checkbox').forEach(cb => {
        cb.checked = selectedExisting.has(cb.value);
    });
}

if (mediaModalElement) {
    mediaModalElement.addEventListener('show.bs.modal', function() {
        syncModalCheckboxes();
    });
}

const useSelectedMediaBtn = document.getElementById('use-selected-media');
if (useSelectedMediaBtn) {
    useSelectedMediaBtn.addEventListener('click', function() {
        const checked = Array.from(document.querySelectorAll('.media-checkbox:checked')).map(cb => cb.value);
        selectedExisting.clear();
        checked.forEach(path => selectedExisting.add(path));
        renderSelectedExisting();
        const instance = bootstrap.Modal.getInstance(mediaModalElement);
        if (instance) instance.hide();
    });
}

const mediaSearch = document.getElementById('media-search');
if (mediaSearch) {
    mediaSearch.addEventListener('input', function() {
        const keyword = this.value.trim().toLowerCase();
        const items = document.querySelectorAll('.media-item');
        let visibleCount = 0;

        items.forEach(item => {
            const matched = item.getAttribute('data-media-name').includes(keyword);
            item.classList.toggle('d-none', !matched);
            if (matched) visibleCount++;
        });

        const emptyBySearch = document.getElementById('media-empty-search');
        if (emptyBySearch) {
            emptyBySearch.classList.toggle('d-none', visibleCount > 0);
        }
    });
}

const newImageInput = document.getElementById('new-images');
let newImageDataTransfer = new DataTransfer();

function renderNewImagePreview() {
    const container = document.getElementById('new-image-preview');
    container.innerHTML = '';

    Array.from(newImageDataTransfer.files).forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-6 col-md-4 col-lg-3';
            col.innerHTML = `
                <div class="card border mb-0 h-100">
                    <img src="${e.target.result}" class="card-img-top" style="height:100px;object-fit:cover;" alt="${file.name}">
                    <div class="card-body p-2 d-flex justify-content-between align-items-center gap-2">
                        <span class="small text-truncate" title="${file.name}">${file.name}</span>
                        <button type="button" class="btn btn-soft-danger btn-xs remove-new-image" data-index="${idx}">
                            <i class="ti ti-x"></i>
                        </button>
                    </div>
                </div>
            `;
            container.appendChild(col);
        };
        reader.readAsDataURL(file);
    });

    setTimeout(function() {
        document.querySelectorAll('.remove-new-image').forEach(btn => {
            btn.addEventListener('click', function() {
                const removeIndex = Number(this.getAttribute('data-index'));
                const nextTransfer = new DataTransfer();
                Array.from(newImageDataTransfer.files).forEach((file, idx) => {
                    if (idx !== removeIndex) nextTransfer.items.add(file);
                });
                newImageDataTransfer = nextTransfer;
                newImageInput.files = newImageDataTransfer.files;
                renderNewImagePreview();
            });
        });
    }, 0);
}

if (newImageInput) {
    newImageInput.addEventListener('change', function() {
        const nextTransfer = new DataTransfer();
        Array.from(this.files).forEach(file => nextTransfer.items.add(file));
        newImageDataTransfer = nextTransfer;
        this.files = newImageDataTransfer.files;
        renderNewImagePreview();
    });
}

const imageCheckboxes = Array.from(document.querySelectorAll('.delete-image-checkbox'));
const deleteButton = document.getElementById('open-delete-images-modal');
const selectToggleButton = document.getElementById('toggle-select-images');

function selectedImageIds() {
    return imageCheckboxes.filter(cb => cb.checked).map(cb => cb.value);
}

function refreshDeleteSelectionUi() {
    if (!deleteButton) return;
    const count = selectedImageIds().length;
    deleteButton.disabled = count === 0;
    if (selectToggleButton) {
        const allSelected = imageCheckboxes.length > 0 && count === imageCheckboxes.length;
        selectToggleButton.textContent = allSelected ? 'Clear Selection' : 'Select All';
    }
}

imageCheckboxes.forEach(cb => {
    cb.addEventListener('change', refreshDeleteSelectionUi);
});

if (selectToggleButton) {
    selectToggleButton.addEventListener('click', function() {
        const ids = selectedImageIds();
        const shouldSelectAll = ids.length !== imageCheckboxes.length;
        imageCheckboxes.forEach(cb => {
            cb.checked = shouldSelectAll;
        });
        refreshDeleteSelectionUi();
    });
}

const deleteImagesModal = document.getElementById('deleteImagesModal');
if (deleteImagesModal) {
    deleteImagesModal.addEventListener('show.bs.modal', function() {
        const ids = selectedImageIds();
        document.getElementById('delete-images-count').textContent = String(ids.length);

        const inputsContainer = document.getElementById('delete-selected-images-inputs');
        inputsContainer.innerHTML = '';
        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'image_ids[]';
            input.value = id;
            inputsContainer.appendChild(input);
        });
    });
}

const confirmDeleteImagesBtn = document.getElementById('confirm-delete-images');
if (confirmDeleteImagesBtn) {
    confirmDeleteImagesBtn.addEventListener('click', function() {
        const form = document.getElementById('delete-selected-images-form');
        if (form) form.submit();
    });
}

let tagCount = {{ $product->tags->count() }};
const noTagsMsg = document.getElementById('no-tags-msg');

document.querySelectorAll('.remove-tag-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        this.closest('.tag-row').remove();
        if (!document.querySelector('.tag-row')) noTagsMsg.style.display = '';
    });
});

document.getElementById('add-tag-btn').addEventListener('click', function() {
    noTagsMsg.style.display = 'none';
    const container = document.getElementById('tags-container');
    const idx = tagCount++;
    const row = document.createElement('div');
    row.className = 'row g-2 mb-2 align-items-center tag-row';
    row.innerHTML = `
        <div class="col"><input type="text" name="tags[${idx}][label]" class="form-control form-control-sm" placeholder="Tag label" required /></div>
        <div class="col-auto">
            <select name="tags[${idx}][color]" class="form-select form-select-sm">
                <option value="green">Green</option><option value="red">Red</option>
                <option value="amber">Amber</option><option value="blue">Blue</option>
                <option value="purple">Purple</option>
            </select>
        </div>
        <div class="col-auto"><button type="button" class="btn btn-soft-danger btn-sm remove-tag-btn"><i class="ti ti-x"></i></button></div>
    `;
    row.querySelector('.remove-tag-btn').addEventListener('click', function() {
        row.remove();
        if (!document.querySelector('.tag-row')) noTagsMsg.style.display = '';
    });
    container.appendChild(row);
});

renderSelectedExisting();
refreshDeleteSelectionUi();
</script>
@endpush
