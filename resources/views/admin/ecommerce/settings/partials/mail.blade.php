<form method="POST" action="{{ route('admin.ecommerce.settings-update') }}" class="landing-form">
    @csrf
    <input type="hidden" name="section" value="mail">
    <input type="hidden" id="fields-json" name="fields" value="">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Mail Notification Settings</h6>
        <div class="form-check form-switch">
            <input class="form-check-input section-status-toggle" type="checkbox" id="mail-status"
                {{ ($data['mail']['status'] ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="mail-status">
                {{ ($data['mail']['status'] ?? true) ? 'Enabled' : 'Disabled' }}
            </label>
        </div>
    </div>

    <input type="hidden" data-field="status" value="{{ ($data['mail']['status'] ?? true) ? '1' : '0' }}">

    <div class="mb-3">
        <p class="text-muted small mb-2">Emails listed below receive notifications when orders are placed. Toggle each email on/off.</p>
    </div>

    <hr class="my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Notification Emails</h6>
        <button type="button" class="btn btn-sm btn-outline-primary btn-add-item" data-group="emails">
            <i class="ti ti-plus me-1"></i> Add Email
        </button>
    </div>

    <div class="array-container" data-group="emails">
        @php $emails = $data['mail']['emails'] ?? []; @endphp
        @foreach($emails as $i => $emailItem)
            <div class="card mb-2 array-item" data-group="emails">
                <div class="card-body py-2">
                    <div class="row align-items-center">
                        <div class="col-md-6 mb-2 mb-md-0">
                            <label class="form-label small mb-1">Email</label>
                            <input type="email" class="form-control form-control-sm" data-field="email" value="{{ $emailItem['email'] ?? '' }}" placeholder="notifications@example.com" />
                        </div>
                        <div class="col-md-3 mb-2 mb-md-0">
                            <div class="form-check form-switch">
                                <input class="form-check-input email-active-toggle" type="checkbox" data-field="active" {{ ($emailItem['active'] ?? true) ? 'checked' : '' }}>
                                <label class="form-check-label small">Active</label>
                            </div>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item w-100">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-check me-1"></i> Save Mail Settings
        </button>
    </div>
</form>
