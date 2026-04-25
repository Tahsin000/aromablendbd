<form method="POST" action="{{ route('admin.ecommerce.settings-update') }}" class="landing-form">
    @csrf
    <input type="hidden" name="section" value="offer">
    <input type="hidden" id="fields-json" name="fields" value="">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Offer Section Settings</h6>
        <div class="form-check form-switch">
            <input class="form-check-input section-status-toggle" type="checkbox" id="offer-status"
                {{ ($data['offer']['status'] ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="offer-status">
                {{ ($data['offer']['status'] ?? true) ? 'Enabled' : 'Disabled' }}
            </label>
        </div>
    </div>

    <input type="hidden" data-field="status" value="{{ ($data['offer']['status'] ?? true) ? '1' : '0' }}">

    <div class="mb-3">
        <label class="form-label">Badge Text</label>
        <input type="text" class="form-control" data-field="badge" value="{{ $data['offer']['badge'] ?? '' }}" />
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Part 1</label>
            <input type="text" class="form-control" data-field="title_1" value="{{ $data['offer']['title_1'] ?? '' }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Title Highlight (yellow text)</label>
            <input type="text" class="form-control" data-field="title_highlight" value="{{ $data['offer']['title_highlight'] ?? '' }}" />
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" data-field="description" rows="3">{{ $data['offer']['description'] ?? '' }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Countdown Label</label>
        <input type="text" class="form-control" data-field="countdown_label" value="{{ $data['offer']['countdown_label'] ?? '' }}" />
    </div>

    <hr class="my-4">
    <h6 class="mb-3">Countdown Timer</h6>

    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" id="offer-timer-enabled"
            {{ ($data['offer']['timer_enabled'] ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="offer-timer-enabled">Enable Countdown Timer</label>
    </div>

    <input type="hidden" data-field="timer_enabled" value="{{ ($data['offer']['timer_enabled'] ?? true) ? '1' : '0' }}">

    <div class="mb-3">
        <label class="form-label">End Date</label>
        <input type="date" class="form-control" data-field="end_date" value="{{ $data['offer']['end_date'] ?? '' }}" min="{{ date('Y-m-d') }}" />
        <div class="form-text">Leave empty to count down to end of today. Timer runs until this date at 23:59:59.</div>
    </div>

    <hr class="my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Offer Stats</h6>
        <button type="button" class="btn btn-sm btn-outline-primary btn-add-item" data-group="stats">
            <i class="ti ti-plus me-1"></i> Add Stat
        </button>
    </div>

    <div class="array-container" data-group="stats">
        @php $stats = $data['offer']['stats'] ?? []; @endphp
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

    <div class="mb-3 mt-3">
        <label class="form-label">CTA Button Text</label>
        <input type="text" class="form-control" data-field="cta_text" value="{{ $data['offer']['cta_text'] ?? '' }}" />
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-check me-1"></i> Save Offer Section
        </button>
    </div>
</form>

<script>
document.getElementById('offer-status').addEventListener('change', function() {
    this.closest('form').querySelector('[data-field="status"]').value = this.checked ? '1' : '0';
    this.parentElement.querySelector('label.form-check-label').textContent = this.checked ? 'Enabled' : 'Disabled';
});
document.getElementById('offer-timer-enabled').addEventListener('change', function() {
    this.closest('form').querySelector('[data-field="timer_enabled"]').value = this.checked ? '1' : '0';
});
</script>