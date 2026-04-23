@extends('admin.layouts.app')

@section('title', 'Edit Order #' . $order->id . ' | Organic Tea Admin')

@section('content')
<div class="container-fluid">
    <div class="page-title-head d-flex align-items-center mb-3">
        <div class="flex-grow-1">
            <h4 class="page-main-title m-0">Edit Order #{{ $order->id }}</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.ecommerce.order-show', $order) }}" class="btn btn-soft-secondary">
                <i class="ti ti-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Information</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.ecommerce.order-update', $order) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $order->name) }}" required />
                                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $order->phone) }}" required />
                                    @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $order->email) }}" />
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="city" class="form-label">City <span class="text-danger">*</span></label>
                                    <select name="city" id="city" class="form-select @error('city') is-invalid @enderror" required onchange="updateDeliveryCharge()">
                                        <option value="">Select city</option>
                                        <option value="dhaka" {{ old('city', $order->city) === 'dhaka' ? 'selected' : '' }}>Dhaka (৳60)</option>
                                        <option value="chittagong" {{ old('city', $order->city) === 'chittagong' ? 'selected' : '' }}>Chittagong (৳60)</option>
                                        <option value="outside" {{ old('city', $order->city) === 'outside' ? 'selected' : '' }}>Outside City (৳120)</option>
                                    </select>
                                    @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address <span class="text-danger">*</span></label>
                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror" required>{{ old('address', $order->address) }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="payment_method" class="form-label">Payment Method <span class="text-danger">*</span></label>
                                    <select name="payment_method" id="payment_method" class="form-select @error('payment_method') is-invalid @enderror" required>
                                        <option value="cod" {{ old('payment_method', $order->payment_method) === 'cod' ? 'selected' : '' }}>Cash on Delivery</option>
                                        <option value="bkash" {{ old('payment_method', $order->payment_method) === 'bkash' ? 'selected' : '' }}>bKash</option>
                                        <option value="nagad" {{ old('payment_method', $order->payment_method) === 'nagad' ? 'selected' : '' }}>Nagad</option>
                                    </select>
                                    @error('payment_method')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Order Status</label>
                                    <select name="status" id="status" class="form-select">
                                        @foreach(['pending', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                                            <option value="{{ $s }}" {{ old('status', $order->status) === $s ? 'selected' : '' }}>
                                                {{ ucfirst($s) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="coupon_code" class="form-label">Coupon Code</label>
                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control" value="{{ old('coupon_code', $order->coupon_code) }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea name="notes" id="notes" rows="1" class="form-control" placeholder="Optional order notes...">{{ old('notes', $order->notes) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-check me-1"></i> Update Order
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <!-- Existing Items -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order Items</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless mb-0">
                            <thead class="bg-light bg-opacity-50">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Qty</th>
                                    <th class="text-end">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>৳{{ number_format($item->unit_price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-end fw-semibold">৳{{ number_format($item->line_total, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted fs-sm">
                    To modify items, view details and manage items separately.
                </div>
            </div>

            <!-- Summary -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-3">Summary</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span>৳{{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Discount</span>
                        <span class="text-success">- ৳{{ number_format($order->discount, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Delivery</span>
                        <span>৳{{ number_format($order->delivery_charge, 2) }}</span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="fw-bold fs-5 text-primary">৳{{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Meta -->
            <div class="card">
                <div class="card-body">
                    <table class="table table-borderless table-sm mb-0">
                        <tr><td class="text-muted">Order ID</td><td>#{{ $order->id }}</td></tr>
                        <tr><td class="text-muted">Created</td><td>{{ $order->created_at->format('d M Y') }}</td></tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
