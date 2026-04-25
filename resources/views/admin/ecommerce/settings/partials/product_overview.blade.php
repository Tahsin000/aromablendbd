<form method="POST" action="{{ route('admin.ecommerce.settings-update') }}" class="landing-form">
    @csrf
    <input type="hidden" name="section" value="product_overview">
    <input type="hidden" id="fields-json" name="fields" value="">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Product Overview Settings</h6>
        <div class="form-check form-switch">
            <input class="form-check-input section-status-toggle" type="checkbox" id="product_overview-status"
                {{ ($data['product_overview']['status'] ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="product_overview-status">
                {{ ($data['product_overview']['status'] ?? true) ? 'Enabled' : 'Disabled' }}
            </label>
        </div>
    </div>

    <input type="hidden" data-field="status" value="{{ ($data['product_overview']['status'] ?? true) ? '1' : '0' }}">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Badge Text</label>
            <input type="text" class="form-control" data-field="badge" value="{{ $data['product_overview']['badge'] ?? '' }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Part 1</label>
            <input type="text" class="form-control" data-field="title_1" value="{{ $data['product_overview']['title_1'] ?? '' }}" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Highlight (green text)</label>
            <input type="text" class="form-control" data-field="title_highlight" value="{{ $data['product_overview']['title_highlight'] ?? '' }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Part 2</label>
            <input type="text" class="form-control" data-field="title_2" value="{{ $data['product_overview']['title_2'] ?? '' }}" />
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" data-field="description" rows="3">{{ $data['product_overview']['description'] ?? '' }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Popular Products Title</label>
        <input type="text" class="form-control" data-field="popular_title" value="{{ $data['product_overview']['popular_title'] ?? '' }}" />
    </div>

    <hr class="my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Feature Cards</h6>
        <button type="button" class="btn btn-sm btn-outline-primary btn-add-item" data-group="features">
            <i class="ti ti-plus me-1"></i> Add Feature
        </button>
    </div>

    <div class="array-container" data-group="features">
        @php $features = $data['product_overview']['features'] ?? []; @endphp
        @foreach($features as $i => $feature)
            <div class="card mb-3 array-item" data-group="features">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary feature-badge">Feature {{ $i + 1 }}</span>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label small">Icon</label>
                            <select class="form-select form-select-sm" data-field="icon">
                                <option value="shield" {{ ($feature['icon'] ?? '') == 'shield' ? 'selected' : '' }}>Shield</option>
                                <option value="truck" {{ ($feature['icon'] ?? '') == 'truck' ? 'selected' : '' }}>Truck</option>
                                <option value="star" {{ ($feature['icon'] ?? '') == 'star' ? 'selected' : '' }}>Star</option>
                                <option value="bolt" {{ ($feature['icon'] ?? '') == 'bolt' ? 'selected' : '' }}>Bolt</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label small">Title</label>
                            <input type="text" class="form-control form-control-sm" data-field="title" value="{{ $feature['title'] ?? '' }}" />
                        </div>
                        <div class="col-md-5 mb-2">
                            <label class="form-label small">Description</label>
                            <input type="text" class="form-control form-control-sm" data-field="desc" value="{{ $feature['desc'] ?? '' }}" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-check me-1"></i> Save Product Overview
        </button>
    </div>
</form>
