<form method="POST" action="{{ route('admin.ecommerce.settings-update') }}" class="landing-form">
    @csrf
    <input type="hidden" name="section" value="ribbon">
    <input type="hidden" id="fields-json" name="fields" value="">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Ribbon / Promotion Settings</h6>
        <div class="form-check form-switch">
            <input class="form-check-input section-status-toggle" type="checkbox" id="ribbon-status"
                {{ ($data['ribbon']['status'] ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="ribbon-status">
                {{ ($data['ribbon']['status'] ?? true) ? 'Enabled' : 'Disabled' }}
            </label>
        </div>
    </div>

    <input type="hidden" data-field="status" value="{{ ($data['ribbon']['status'] ?? true) ? '1' : '0' }}">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Background Color</label>
            <select class="form-select" data-field="color">
                <option value="green" {{ ($data['ribbon']['color'] ?? 'green') == 'green' ? 'selected' : '' }}>Green</option>
                <option value="red" {{ ($data['ribbon']['color'] ?? 'green') == 'red' ? 'selected' : '' }}>Red</option>
                <option value="yellow" {{ ($data['ribbon']['color'] ?? 'green') == 'yellow' ? 'selected' : '' }}>Yellow</option>
                <option value="blue" {{ ($data['ribbon']['color'] ?? 'green') == 'blue' ? 'selected' : '' }}>Blue</option>
            </select>
        </div>
    </div>

    <hr class="my-4">
    <h6 class="mb-3">Rotating Texts</h6>
    <p class="text-muted small mb-3">Multiple texts rotate on the ribbon every 5 seconds.</p>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0 text-muted">Text Items</h6>
        <button type="button" class="btn btn-sm btn-outline-primary btn-add-item" data-group="texts">
            <i class="ti ti-plus me-1"></i> Add Text
        </button>
    </div>

    <div class="array-container" data-group="texts">
        @php $texts = $data['ribbon']['texts'] ?? []; @endphp
        @foreach($texts as $i => $textItem)
            <div class="card mb-3 array-item" data-group="texts">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary ribbon-text-badge">Text {{ $i + 1 }}</span>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label small">Badge</label>
                            <input type="text" class="form-control form-control-sm" data-field="badge_text" value="{{ $textItem['badge_text'] ?? '' }}" placeholder="অফার" />
                        </div>
                        <div class="col-md-5 mb-2">
                            <label class="form-label small">Promotion Text</label>
                            <input type="text" class="form-control form-control-sm" data-field="promotion_text" value="{{ $textItem['promotion_text'] ?? '' }}" placeholder="20% ছাড় সকল পণ্যে" />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label small">CTA</label>
                            <input type="text" class="form-control form-control-sm" data-field="cta" value="{{ $textItem['cta'] ?? '' }}" placeholder="অফার দেখুন" />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label small">Link</label>
                            <input type="text" class="form-control form-control-sm" data-field="link_url" value="{{ $textItem['link_url'] ?? '' }}" placeholder="#offer" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="my-4">
    <h6 class="mb-3">Timer Settings</h6>

    <div class="form-check form-switch mb-3">
        <input class="form-check-input" type="checkbox" id="timer-enabled"
            {{ ($data['ribbon']['timer']['enabled'] ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="timer-enabled">Show Countdown Timer</label>
    </div>

    <input type="hidden" data-field="timer_enabled" value="{{ ($data['ribbon']['timer']['enabled'] ?? true) ? '1' : '0' }}">

    <div class="mb-3">
        <label class="form-label">Timer Label</label>
        <input type="text" class="form-control" data-field="timer_label" value="{{ $data['ribbon']['timer']['countdown_label'] ?? '' }}" placeholder="অফার শেষ হতে বাকি" />
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" data-field="timer_start" value="{{ $data['ribbon']['timer']['start_date'] ?? '' }}" min="{{ date('Y-m-d') }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" data-field="timer_end" value="{{ $data['ribbon']['timer']['end_date'] ?? '' }}" min="{{ date('Y-m-d') }}" />
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-check me-1"></i> Save Ribbon Settings
        </button>
    </div>
</form>

<script>
document.getElementById('ribbon-status').addEventListener('change', function() {
    this.nextElementSibling.value = this.checked ? '1' : '0';
    this.parentElement.querySelector('label.form-check-label').textContent = this.checked ? 'Enabled' : 'Disabled';
});
document.getElementById('timer-enabled').addEventListener('change', function() {
    this.nextElementSibling.value = this.checked ? '1' : '0';
});
</script>
