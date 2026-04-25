<form method="POST" action="{{ route('admin.ecommerce.settings-update') }}" class="landing-form">
    @csrf
    <input type="hidden" name="section" value="footer">
    <input type="hidden" id="fields-json" name="fields" value="">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Footer Settings</h6>
        <div class="form-check form-switch">
            <input class="form-check-input section-status-toggle" type="checkbox" id="footer-status"
                {{ ($data['footer']['status'] ?? true) ? 'checked' : '' }}>
            <label class="form-check-label small" for="footer-status">
                {{ ($data['footer']['status'] ?? true) ? 'Enabled' : 'Disabled' }}
            </label>
        </div>
    </div>

    <input type="hidden" data-field="status" value="{{ ($data['footer']['status'] ?? true) ? '1' : '0' }}">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Brand Name</label>
            <input type="text" class="form-control" data-field="brand_name" value="{{ $data['footer']['brand_name'] ?? '' }}" />
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Brand Description</label>
            <input type="text" class="form-control" data-field="brand_description" value="{{ $data['footer']['brand_description'] ?? '' }}" />
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Quick Links Title</label>
        <input type="text" class="form-control" data-field="quick_links_title" value="{{ $data['footer']['quick_links_title'] ?? '' }}" />
    </div>

    <hr class="my-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h6 class="m-0">Quick Links</h6>
        <button type="button" class="btn btn-sm btn-outline-primary btn-add-item" data-group="quick_links">
            <i class="ti ti-plus me-1"></i> Add Link
        </button>
    </div>

    <div class="array-container" data-group="quick_links">
        @php $links = $data['footer']['quick_links'] ?? []; @endphp
        @foreach($links as $i => $link)
            <div class="card mb-2 array-item" data-group="quick_links">
                <div class="card-body py-2">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span class="badge bg-secondary link-badge">Link {{ $i + 1 }}</span>
                        <button type="button" class="btn btn-sm btn-outline-danger btn-remove-item">
                            <i class="ti ti-trash"></i>
                        </button>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-4 mb-2 mb-md-0">
                            <label class="form-label small mb-1">Label</label>
                            <input type="text" class="form-control form-control-sm" data-field="label" value="{{ $link['label'] ?? '' }}" />
                        </div>
                        <div class="col-md-8">
                            <label class="form-label small mb-1">URL</label>
                            <input type="text" class="form-control form-control-sm" data-field="href" value="{{ $link['href'] ?? '' }}" />
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="my-4">
    <h6 class="mb-3">Contact Info</h6>

    <div class="mb-3">
        <label class="form-label">Contact Title</label>
        <input type="text" class="form-control" data-field="contact_title" value="{{ $data['footer']['contact_title'] ?? '' }}" />
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" data-field="contact_phone" value="{{ $data['footer']['contact_phone'] ?? '' }}" />
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Email</label>
            <input type="text" class="form-control" data-field="contact_email" value="{{ $data['footer']['contact_email'] ?? '' }}" />
        </div>
        <div class="col-md-4 mb-3">
            <label class="form-label">Address</label>
            <input type="text" class="form-control" data-field="contact_address" value="{{ $data['footer']['contact_address'] ?? '' }}" />
        </div>
    </div>

    <div class="mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="ti ti-check me-1"></i> Save Footer
        </button>
    </div>
</form>
