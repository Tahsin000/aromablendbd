@extends('admin.layouts.app')

@section('title', 'Create Order | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Create Order</h4>
        </div>
        <div>
            <a href="{{ route('admin.ecommerce.orders') }}" class="btn btn-soft-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back to Orders
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.ecommerce.order-store') }}" id="order-form">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required />
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" required />
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" />
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <select name="city" id="city" class="form-select @error('city') is-invalid @enderror" required onchange="updateDeliveryCharge()">
                                        <option value="">Select city</option>
                                        <option value="dhaka" {{ old('city') === 'dhaka' ? 'selected' : '' }}>Dhaka (৳60)</option>
                                        <option value="chittagong" {{ old('city') === 'chittagong' ? 'selected' : '' }}>Chittagong (৳60)</option>
                                        <option value="outside" {{ old('city') === 'outside' ? 'selected' : '' }}>Outside City (৳120)</option>
                                    </select>
                                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address') }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                                    <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                                        <option value="cod" {{ old('payment_method') === 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
                                        <option value="bkash" {{ old('payment_method') === 'bkash' ? 'selected' : '' }}>bKash</option>
                                        <option value="nagad" {{ old('payment_method') === 'nagad' ? 'selected' : '' }}>Nagad</option>
                                    </select>
                                    @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="coupon_code" class="form-label">Coupon Code</label>
                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ old('coupon_code') }}" />
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="notes" class="form-label">Notes</label>
                            <textarea name="notes" id="notes" rows="2" class="form-control" placeholder="Optional order notes...">{{ old('notes') }}</textarea>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <!-- Order Items -->
            <div class="card">
                <div class="card-header justify-content-between">
                    <h4 class="card-title">Order Items</h4>
                    <button type="button" class="btn btn-sm btn-primary" onclick="addItemRow()">
                        <i class="ti ti-plus me-1"></i> Add Item
                    </button>
                </div>
                <div class="card-body" id="items-container">
                    @error('items')<div class="alert alert-danger py-1">{{ $message }}</div>@enderror
                    <table class="table table-sm table-borderless mb-0">
                        <thead>
                            <tr class="border-bottom">
                                <th>Product</th>
                                <th style="width:70px">Qty</th>
                                <th style="width:90px">Total</th>
                                <th style="width:40px"></th>
                            </tr>
                        </thead>
                        <tbody id="items-body">
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Order Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold" id="summary-subtotal">৳0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Discount</span>
                        <span class="fw-semibold text-success" id="summary-discount">৳0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Delivery Charge</span>
                        <span class="fw-semibold" id="summary-delivery">৳0.00</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5 text-primary" id="summary-total">৳0.00</span>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" form="order-form" class="btn btn-primary w-100">
                        <i class="ti ti-check me-1"></i> Create Order
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="items" id="items-json" form="order-form" />

@push('scripts')
<script>
const products = @json($products);

function addItemRow(selectedId = '', selectedQty = 1) {
    const tbody = document.getElementById('items-body');
    const row = document.createElement('tr');
    row.classList.add('item-row');

    let options = '<option value="">Select product</option>';
    for (const [id, p] of Object.entries(products)) {
        const sel = id === selectedId ? 'selected' : '';
        options += `<option value="${id}" ${sel}>${p.name} (৳${p.price})</option>`;
    }

    row.innerHTML = `
        <td>
            <select class="form-select form-select-sm item-product" onchange="updateTotals()">${options}</select>
        </td>
        <td>
            <input type="number" class="form-control form-control-sm item-qty" value="${selectedQty}" min="1" onchange="updateTotals()" oninput="updateTotals()" />
        </td>
        <td>
            <span class="item-line-total fw-semibold">৳0.00</span>
        </td>
        <td>
            <button type="button" class="btn btn-sm btn-soft-danger" onclick="this.closest('tr').remove(); updateTotals();">
                <i class="ti ti-x"></i>
            </button>
        </td>
    `;
    tbody.appendChild(row);
    if (selectedId) updateTotals();
}

function updateTotals() {
    let subtotal = 0;
    const items = [];
    document.querySelectorAll('.item-row').forEach(row => {
        const productId = row.querySelector('.item-product').value;
        const qty = parseInt(row.querySelector('.item-qty').value) || 0;
        if (!productId || qty < 1) return;

        const product = products[productId];
        if (!product) return;

        const lineTotal = product.price * qty;
        subtotal += lineTotal;
        row.querySelector('.item-line-total').textContent = '৳' + lineTotal.toFixed(2);

        items.push({ product_id: productId, quantity: qty });
    });

    document.getElementById('summary-subtotal').textContent = '৳' + subtotal.toFixed(2);
    document.getElementById('summary-discount').textContent = '৳0.00';
    const delivery = getDeliveryCharge();
    document.getElementById('summary-delivery').textContent = '৳' + delivery.toFixed(2);
    document.getElementById('summary-total').textContent = '৳' + (subtotal + delivery).toFixed(2);

    document.getElementById('items-json').value = JSON.stringify(items);
}

function getDeliveryCharge() {
    const city = document.getElementById('city').value;
    return (city === 'dhaka' || city === 'chittagong') ? 60 : 120;
}

function updateDeliveryCharge() {
    updateTotals();
}

// Add one empty row on page load
addItemRow();
</script>
@endpush
@endsection
