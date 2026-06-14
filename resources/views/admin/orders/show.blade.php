@extends('admin.layouts.admin')

@section('title', 'Order ' . $order->order_number)

@section('content')

@php
    $statusColors = [
        'pending'    => 'warning',
        'processing' => 'info',
        'shipped'    => 'primary',
        'delivered'  => 'success',
        'cancelled'  => 'danger',
    ];
    $paymentLabels = [
        'cod'         => 'Cash on Delivery',
        'credit_card' => 'Credit Card',
        'paypal'      => 'PayPal',
        'gpay'        => 'Google Pay',
    ];
    $steps = ['pending', 'processing', 'shipped', 'delivered'];
    $currentStep = array_search($order->order_status, $steps);
@endphp

{{-- Page header --}}
<div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="icon-base ti tabler-arrow-left me-1"></i> Back
        </a>
        <div>
            <h4 class="mb-1">{{ $order->order_number }}</h4>
            <div class="d-flex gap-2">
                <span class="badge bg-label-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
                    {{ ucfirst($order->order_status) }}
                </span>
                <span class="badge bg-label-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
                <span class="text-muted small">
                    {{ $order->created_at->format('M d, Y h:i A') }}
                </span>
            </div>
        </div>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary btn-sm">
            <i class="icon-base ti tabler-edit me-1"></i> Edit Order
        </a>
        @if ($order->invoice)
            <a href="{{ route('admin.invoices.show', $order->invoice) }}" class="btn btn-outline-success btn-sm">
                <i class="icon-base ti tabler-file-invoice me-1"></i> View Invoice
            </a>
        @else
            <form method="POST" action="{{ route('admin.invoices.fromOrder', $order) }}">
                @csrf
                <button type="submit" class="btn btn-outline-info btn-sm">
                    <i class="icon-base ti tabler-file-plus me-1"></i> Generate Invoice
                </button>
            </form>
        @endif
        <button type="button" class="btn btn-outline-danger btn-sm"
            data-delete-name="{{ $order->order_number }}"
            data-delete-url="{{ route('admin.orders.destroy', $order) }}">
            <i class="icon-base ti tabler-trash me-1"></i> Delete Order
        </button>
    </div>
</div>

<div class="row g-4">

    {{-- ── Left column ─────────────────────────────────────────────────────── --}}
    <div class="col-lg-8">

        {{-- Order items --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Order Items</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Product</th>
                                <th class="text-end">Unit Price</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end pe-4">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td class="ps-4">
                                        <span class="fw-semibold">{{ $item->product_name }}</span>
                                        @if ($item->product)
                                            <div class="small">
                                                <a href="{{ route('admin.products.show', $item->product) }}" class="text-muted">
                                                    View product
                                                </a>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="text-end">${{ number_format($item->product_price, 2) }}</td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end pe-4">${{ number_format($item->subtotal, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex flex-column align-items-end gap-1" style="max-width:280px;margin-left:auto;">
                    <div class="d-flex justify-content-between w-100 text-muted small">
                        <span>Subtotal</span>
                        <span>${{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between w-100 text-muted small">
                        <span>Shipping</span>
                        <span>{{ $order->shipping == 0 ? 'Free' : '$' . number_format($order->shipping, 2) }}</span>
                    </div>
                    <hr class="w-100 my-1">
                    <div class="d-flex justify-content-between w-100 fw-bold">
                        <span>Total</span>
                        <span>${{ number_format($order->total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Order timeline / status steps --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Order Timeline</h5>
            </div>
            <div class="card-body">
                {{-- Step indicator --}}
                @if ($order->order_status !== 'cancelled')
                    <div class="d-flex align-items-center mb-4">
                        @foreach ($steps as $i => $step)
                            <div class="d-flex flex-column align-items-center flex-fill">
                                <div class="rounded-circle d-flex align-items-center justify-content-center mb-1
                                    {{ $currentStep !== false && $i <= $currentStep ? 'bg-primary text-white' : 'bg-label-secondary text-muted' }}"
                                    style="width:36px;height:36px;font-size:.75rem;font-weight:600;">
                                    {{ $i + 1 }}
                                </div>
                                <small class="{{ $currentStep !== false && $i <= $currentStep ? 'text-primary fw-semibold' : 'text-muted' }}">
                                    {{ ucfirst($step) }}
                                </small>
                            </div>
                            @if (!$loop->last)
                                <div class="flex-fill border-top border-2
                                    {{ $currentStep !== false && $i < $currentStep ? 'border-primary' : 'border-light' }}"
                                    style="margin-bottom:1.6rem;"></div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-danger mb-4">
                        <i class="icon-base ti tabler-x me-1"></i>
                        This order has been <strong>cancelled</strong>.
                    </div>
                @endif

                {{-- Placed entry --}}
                <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                        <span class="avatar avatar-sm bg-label-primary rounded">
                            <i class="icon-base ti tabler-shopping-bag"></i>
                        </span>
                    </div>
                    <div>
                        <p class="mb-0 fw-semibold">Order placed</p>
                        <small class="text-muted">{{ $order->created_at->format('M d, Y \a\t h:i A') }}</small>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Right column ─────────────────────────────────────────────────────── --}}
    <div class="col-lg-4">

        {{-- Customer details --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Customer</h5>
            </div>
            <div class="card-body">
                <p class="fw-semibold mb-1">{{ $order->customer_name }}</p>
                <p class="mb-1">
                    <a href="mailto:{{ $order->customer_email }}" class="text-body">
                        {{ $order->customer_email }}
                    </a>
                </p>
                @if ($order->customer_phone)
                    <p class="mb-0 text-muted">{{ $order->customer_phone }}</p>
                @endif
            </div>
        </div>

        {{-- Delivery address --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Delivery Address</h5>
            </div>
            <div class="card-body text-muted">
                <p class="mb-1">{{ $order->address }}</p>
                <p class="mb-1">
                    {{ $order->city }}{{ $order->state ? ', ' . $order->state : '' }} {{ $order->zip_code }}
                </p>
                <p class="mb-0">{{ $order->country }}</p>
            </div>
        </div>

        {{-- Payment --}}
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0">Payment</h5>
            </div>
            <div class="card-body">
                <p class="mb-2">{{ $paymentLabels[$order->payment_method] ?? $order->payment_method }}</p>
                <span class="badge bg-label-{{ $order->payment_status === 'paid' ? 'success' : 'warning' }}">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>
        </div>

        {{-- Update status --}}
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Update Status</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.orders.updateStatus', $order) }}">
                    @csrf
                    @method('PATCH')
                    <select name="order_status" class="form-select mb-3">
                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                            <option value="{{ $s }}" {{ $order->order_status === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="icon-base ti tabler-check me-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

@include('admin.partials.delete-modal')

@endsection
