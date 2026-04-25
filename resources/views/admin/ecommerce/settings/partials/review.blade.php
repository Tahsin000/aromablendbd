<form method="POST" action="{{ route('admin.ecommerce.settings-update') }}" class="landing-form">
    @csrf
    <input type="hidden" name="section" value="review">
    <input type="hidden" id="fields-json" name="fields" value="">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Review Section Settings</h6>
        <div class="form-check form-switch">
            <input class="form-check-input section-status-toggle" type="checkbox" id="review-status"
                {{ ($data['review']['status'] ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="review-status">
                {{ ($data['review']['status'] ?? true) ? 'Enabled' : 'Disabled' }}
            </label>
        </div>
    </div>

    <input type="hidden" data-field="status" value="{{ ($data['review']['status'] ?? true) ? '1' : '0' }}">

    <div class="mb-3">
        <label class="form-label">Badge Text</label>
        <input type="text" class="form-control" data-field="badge" value="{{ $data['review']['badge'] ?? '' }}" />
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Title Part 1</label>
            <input type="text" class="form-control" data-field="title_1" value="{{ $data['review']['title_1'] ?? '' }}" />
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Title Highlight (green text)</label>
            <input type="text" class="form-control" data-field="title_highlight" value="{{ $data['review']['title_highlight'] ?? '' }}" />
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Title Part 2</label>
            <input type="text" class="form-control" data-field="title_2" value="{{ $data['review']['title_2'] ?? '' }}" />
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" data-field="description" rows="3">{{ $data['review']['description'] ?? '' }}</textarea>
    </div>

    <hr class="my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Stats</h6>
        <button type="button" class="btn btn-sm btn-outline-primary btn-add-item" data-group="stats">
            <i class="ti ti-plus me-1"></i> Add Stat
        </button>
    </div>

    <div class="array-container" data-group="stats">
        @php $stats = $data['review']['stats'] ?? []; @endphp
        @foreach($stats as $stat)
            <div class="row mb-2 array-item" data-group="stats">
                <div class="col-md-5 mb-2 mb-md-0">
                    <label class="form-label small">Value</label>
                    <input type="text" class="form-control form-control-sm" data-field="value" value="{{ $stat['value'] ?? '' }}" />
                </div>
                <div class="col-md-5 mb-2 mb-md-0">
                    <label class="form-label small">Label</label>
                    <input type="text" class="form-control form-control-sm" data-field="label" value="{{ $stat['label'] ?? '' }}" />
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item w-100">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-check me-1"></i> Save Review Section
        </button>
    </div>
</form>
