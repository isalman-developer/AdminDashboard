@extends('client.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('client/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/theme.min.css') }}">
@endpush

@section('content')

    {{-- Hero --}}
    <section class="bg-light py-lg-10 py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <h1 class="display-5 fw-bold mb-3">Order tracking</h1>
                    <p class="mb-0 text-muted">
                        To track your order please enter your Order ID in the box below and press the
                        "Track" button. This was given to you on your receipt and in the confirmation
                        email you should have received.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Track form --}}
    <div class="py-lg-10 py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5">

                    @isset($error)
                        <div class="alert alert-danger mb-4">{{ $error }}</div>
                    @endisset

                    <div class="card bg-light mb-6">
                        <div class="card-body p-5">
                            <form method="POST" action="{{ route('order.trackOrder') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="order_number" class="form-label">Order ID</label>
                                    <input type="text" name="order_number" id="order_number" class="form-control @error('order_number') is-invalid @enderror"
                                        placeholder="e.g. ORD-ABCD1234" value="{{ old('order_number', isset($result) ? $result->order_number : '') }}" required>
                                    @error('order_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Billing email</label>
                                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                        placeholder="Email you used during checkout." value="{{ old('email') }}" required>
                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary">Track</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    @isset($result)
                        <div class="card">
                            <div class="card-header px-4 py-3 d-flex align-items-center justify-content-between">
                                <h3 class="fs-5 mb-0">Order #{{ $result->order_number }}</h3>
                                @php
                                    $statusColors = [
                                        'pending'    => 'warning',
                                        'processing' => 'info',
                                        'shipped'    => 'primary',
                                        'delivered'  => 'success',
                                        'cancelled'  => 'danger',
                                    ];
                                @endphp
                                <span class="badge bg-{{ $statusColors[$result->order_status] ?? 'secondary' }}">
                                    {{ ucfirst($result->order_status) }}
                                </span>
                            </div>
                            <div class="card-body px-4">
                                <div class="table-responsive mb-3">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-end">Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($result->items as $item)
                                                <tr>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-end">${{ number_format($item->subtotal, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="2" class="text-end">Shipping</td>
                                                <td class="text-end">{{ $result->shipping == 0 ? 'Free' : '$' . number_format($result->shipping, 2) }}</td>
                                            </tr>
                                            <tr class="fw-bold">
                                                <td colspan="2" class="text-end">Total</td>
                                                <td class="text-end">${{ number_format($result->total, 2) }}</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <p class="small text-muted mb-1">
                                    <strong>Placed:</strong> {{ $result->created_at->format('M d, Y') }}
                                </p>
                                <p class="small text-muted mb-1">
                                    <strong>Payment:</strong>
                                    @switch($result->payment_method)
                                        @case('cod') Cash on Delivery @break
                                        @case('credit_card') Credit Card @break
                                        @case('paypal') PayPal @break
                                        @case('gpay') Google Pay @break
                                    @endswitch
                                </p>
                                <p class="small text-muted mb-0">
                                    <strong>Deliver to:</strong>
                                    {{ $result->address }}, {{ $result->city }}{{ $result->state ? ', ' . $result->state : '' }}, {{ $result->country }}
                                </p>
                            </div>
                        </div>
                    @endisset

                </div>
            </div>
        </div>
    </div>

    {{-- Features strip --}}
    @include('client.partials.features')

@endsection

@push('scripts')
    <script src="{{ asset('client/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/js/theme.min.js') }}"></script>
@endpush
