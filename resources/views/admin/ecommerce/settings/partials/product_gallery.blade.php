<form method="POST" action="{{ route('admin.ecommerce.settings-update') }}" class="landing-form">
    @csrf
    <input type="hidden" name="section" value="product_gallery">
    <input type="hidden" id="fields-json" name="fields" value="">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Product Gallery Settings</h6>
        <div class="form-check form-switch">
            <input class="form-check-input section-status-toggle" type="checkbox" id="product_gallery-status"
                {{ ($data['product_gallery']['status'] ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="product_gallery-status">
                {{ ($data['product_gallery']['status'] ?? true) ? 'Enabled' : 'Disabled' }}
            </label>
        </div>
    </div>

    <input type="hidden" data-field="status" value="{{ ($data['product_gallery']['status'] ?? true) ? '1' : '0' }}">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Badge Text</label>
            <input type="text" class="form-control" data-field="badge" value="{{ $data['product_gallery']['badge'] ?? '' }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Part 1</label>
            <input type="text" class="form-control" data-field="title_1" value="{{ $data['product_gallery']['title_1'] ?? '' }}" />
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Highlight (green text)</label>
            <input type="text" class="form-control" data-field="title_highlight" value="{{ $data['product_gallery']['title_highlight'] ?? '' }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Part 2</label>
            <input type="text" class="form-control" data-field="title_2" value="{{ $data['product_gallery']['title_2'] ?? '' }}" />
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" data-field="description" rows="3">{{ $data['product_gallery']['description'] ?? '' }}</textarea>
    </div>

    <hr class="my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Journey Steps</h6>
        <button type="button" class="btn btn-sm btn-outline-primary btn-add-item" data-group="steps">
            <i class="ti ti-plus me-1"></i> Add Step
        </button>
    </div>

    <div class="array-container" data-group="steps">
        @php $steps = $data['product_gallery']['steps'] ?? []; @endphp
        @foreach($steps as $i => $step)
            <div class="card mb-3 array-item" data-group="steps">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary step-badge">Step {{ $i + 1 }}</span>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-2">
                            <label class="form-label small">Title</label>
                            <input type="text" class="form-control form-control-sm" data-field="title" value="{{ $step['title'] ?? '' }}" />
                        </div>
                        <div class="col-md-8 mb-2">
                            <label class="form-label small">Description</label>
                            <textarea class="form-control form-control-sm" data-field="desc" rows="2">{{ $step['desc'] ?? '' }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-check me-1"></i> Save Product Gallery
        </button>
    </div>
</form>
