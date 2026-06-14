@extends('admin.layouts.admin')

@section('title', 'Edit Order ' . $order->order_number)

@section('content')

@php
    $statusColors = [
        'pending'    => 'warning',
        'processing' => 'info',
        'shipped'    => 'primary',
        'delivered'  => 'success',
        'cancelled'  => 'danger',
    ];
@endphp

<div class="row">

    {{-- ── Left: Order summary (read-only) ───────────────────────────────── --}}
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Order Summary</h4>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <span class="avatar avatar-lg bg-label-primary rounded mx-auto">
                        <i class="icon-base ti tabler-clipboard-list" style="font-size:1.8rem;"></i>
                    </span>
                    <h5 class="mt-3 mb-1">{{ $order->order_number }}</h5>
                    <span class="badge bg-label-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
                        {{ ucfirst($order->order_status) }}
                    </span>
                </div>

                <table class="table table-sm table-borderless">
                    <tr>
                        <td class="text-muted">Date</td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Items</td>
                        <td>{{ $order->items->count() }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Subtotal</td>
                        <td>${{ number_format($order->subtotal, 2) }}</td>
                    </tr>
                    <tr>
                        <td class="text-muted">Shipping</td>
                        <td>{{ $order->shipping == 0 ? 'Free' : '$' . number_format($order->shipping, 2) }}</td>
                    </tr>
                    <tr class="fw-bold">
                        <td>Total</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                    </tr>
                </table>

                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-secondary btn-sm w-100 mt-2">
                    <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Order
                </a>
            </div>
        </div>
    </div>

    {{-- ── Right: Edit form ────────────────────────────────────────────────── --}}
    <div class="col-lg-8">
        <form method="POST" action="{{ route('admin.orders.update', $order) }}">
            @csrf
            @method('PUT')

            {{-- Customer Information --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="icon-base ti tabler-user me-2 text-muted"></i>Customer Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label" for="customer_name">Full Name <span class="text-danger">*</span></label>
                            <input type="text" id="customer_name" name="customer_name"
                                class="form-control @error('customer_name') is-invalid @enderror"
                                value="{{ old('customer_name', $order->customer_name) }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="customer_email">Email <span class="text-danger">*</span></label>
                            <input type="email" id="customer_email" name="customer_email"
                                class="form-control @error('customer_email') is-invalid @enderror"
                                value="{{ old('customer_email', $order->customer_email) }}" required>
                            @error('customer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="customer_phone">Phone</label>
                            <input type="text" id="customer_phone" name="customer_phone"
                                class="form-control @error('customer_phone') is-invalid @enderror"
                                value="{{ old('customer_phone', $order->customer_phone) }}">
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Delivery Address --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="icon-base ti tabler-map-pin me-2 text-muted"></i>Delivery Address
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label" for="address">Street Address <span class="text-danger">*</span></label>
                            <input type="text" id="address" name="address"
                                class="form-control @error('address') is-invalid @enderror"
                                value="{{ old('address', $order->address) }}" required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                            <input type="text" id="city" name="city"
                                class="form-control @error('city') is-invalid @enderror"
                                value="{{ old('city', $order->city) }}" required>
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="state">State / Province</label>
                            <input type="text" id="state" name="state"
                                class="form-control @error('state') is-invalid @enderror"
                                value="{{ old('state', $order->state) }}">
                            @error('state')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="zip_code">ZIP / Postal Code</label>
                            <input type="text" id="zip_code" name="zip_code"
                                class="form-control @error('zip_code') is-invalid @enderror"
                                value="{{ old('zip_code', $order->zip_code) }}">
                            @error('zip_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
                            <input type="text" id="country" name="country"
                                class="form-control @error('country') is-invalid @enderror"
                                value="{{ old('country', $order->country) }}" required>
                            @error('country')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Status --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="icon-base ti tabler-adjustments me-2 text-muted"></i>Order Status
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label" for="order_status">Order Status <span class="text-danger">*</span></label>
                            <select id="order_status" name="order_status"
                                class="form-select @error('order_status') is-invalid @enderror">
                                @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                    <option value="{{ $s }}" {{ old('order_status', $order->order_status) === $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('order_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="payment_status">Payment Status <span class="text-danger">*</span></label>
                            <select id="payment_status" name="payment_status"
                                class="form-select @error('payment_status') is-invalid @enderror">
                                @foreach(['pending','paid','refunded'] as $s)
                                    <option value="{{ $s }}" {{ old('payment_status', $order->payment_status) === $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('payment_status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Notes --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="icon-base ti tabler-notes me-2 text-muted"></i>Notes
                    </h5>
                </div>
                <div class="card-body">
                    <textarea id="notes" name="notes" rows="3"
                        class="form-control @error('notes') is-invalid @enderror"
                        placeholder="Internal notes about this order...">{{ old('notes', $order->notes) }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Footer actions --}}
            <div class="d-flex justify-content-between">
                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-outline-secondary">
                    <i class="icon-base ti tabler-arrow-left me-1"></i> Cancel
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="icon-base ti tabler-device-floppy me-1"></i> Save Changes
                </button>
            </div>

        </form>
    </div>

</div>

@endsection
