@extends('admin.layouts.admin')

@section('title', 'Orders')

@section('content')

    {{-- Stat cards --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="icon-base ti tabler-clock"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Pending</small>
                        <h4 class="mb-0">{{ $stats['pending'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-success">
                            <i class="icon-base ti tabler-checks"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Delivered</small>
                        <h4 class="mb-0">{{ $stats['delivered'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-danger">
                            <i class="icon-base ti tabler-x"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Cancelled</small>
                        <h4 class="mb-0">{{ $stats['cancelled'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-secondary">
                            <i class="icon-base ti tabler-shopping-bag"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Total Orders</small>
                        <h4 class="mb-0">{{ $stats['total'] }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Orders</h4>
        </div>
        <div class="card-body">

            {{-- Search / filter --}}
            <div class="row mb-4">
                <div class="col-md-8">
                    <form method="GET" action="{{ route('admin.orders.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Order # or customer name / email"
                                value="{{ request('search') }}">
                            <select name="status" class="form-select" style="max-width:170px;">
                                <option value="">All Statuses</option>
                                @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                    <option value="{{ $s }}" {{ request('status') === $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                @endforeach
                            </select>
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-filter"></i> Filter
                            </button>
                        </div>
                        @if(request('search') || request('status'))
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

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
            @endphp

            @if ($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th style="width:120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration + ($orders->currentPage() - 1) * $orders->perPage() }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="fw-semibold text-body">
                                            {{ $order->order_number }}
                                        </a>
                                        <div class="small text-muted">{{ $order->items->count() }} item(s)</div>
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <span class="fw-semibold">{{ $order->customer_name }}</span>
                                        <div class="small text-muted">{{ $order->customer_email }}</div>
                                    </td>
                                    <td class="fw-semibold">${{ number_format($order->total, 2) }}</td>
                                    <td>
                                        <span class="badge bg-label-{{ $statusColors[$order->order_status] ?? 'secondary' }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td>{{ $paymentLabels[$order->payment_method] ?? $order->payment_method }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.orders.show', $order) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary"
                                                data-bs-toggle="tooltip" title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.orders.edit', $order) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary"
                                                data-bs-toggle="tooltip" title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-delete-name="{{ $order->order_number }}"
                                                data-delete-url="{{ route('admin.orders.destroy', $order) }}"
                                                title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-2 px-3 border-top-0">
                    {{ $orders->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-clipboard-list text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No orders found</h5>
                    <p class="text-muted">Orders placed from the storefront will appear here.</p>
                </div>
            @endif

        </div>
    </div>

    @include('admin.partials.delete-modal')

@endsection
