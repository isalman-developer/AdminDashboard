@extends('client.layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{ asset('client/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/theme.min.css') }}">
@endpush

@section('content')

    {{-- Breadcrumb --}}
    <div class="mg-page-header-section mg-page-header-style">
        <div class="mg-page-header-inner">
            <div class="container">
                <div class="mg-page-header-text">
                    <div class="mg-page-header-heading"><h3>Shopping Cart</h3></div>
                    <div class="mg-breadcrumb">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash messages --}}
    @if(session('success'))
        <div class="container pt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        </div>
    @endif

    <section class="pt-lg-4 pb-lg-8">
        <div class="container">

            @if(empty($cartItems))
                <div class="text-center py-10">
                    <svg width="80" height="80" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-4 text-muted">
                        <path d="M22.9214 6.25781C22.7448 6.05922 22.5282 5.90019 22.2859 5.79114C22.0435 5.68208 21.7809 5.62547 21.5151 5.625H17.3742C17.2752 4.40426 16.7204 3.26548 15.8201 2.43518C14.9197 1.60487 13.7399 1.14387 12.5151 1.14387C11.2904 1.14387 10.1105 1.60487 9.21017 2.43518C8.30983 3.26548 7.75501 4.40426 7.65606 5.625H3.52262C3.25718 5.62396 2.99454 5.67929 2.75208 5.78733C2.50962 5.89537 2.29286 6.05367 2.11615 6.25174C1.93943 6.44981 1.80679 6.68315 1.72699 6.93632C1.64719 7.18948 1.62206 7.45671 1.65325 7.72031L2.98919 18.9703C3.04446 19.427 3.26522 19.8477 3.60971 20.1526C3.9542 20.4575 4.39851 20.6256 4.85856 20.625H20.1717C20.6317 20.6256 21.076 20.4575 21.4205 20.1526C21.765 19.8477 21.9858 19.427 22.0411 18.9703L23.377 7.72031C23.4083 7.4582 23.3839 7.19244 23.3054 6.94041C23.2268 6.68839 23.096 6.45578 22.9214 6.25781Z" fill="#ccc"/>
                    </svg>
                    <h3 class="fs-4 mb-3">Your cart is empty</h3>
                    <p class="text-muted mb-4">Looks like you haven't added anything to your cart yet.</p>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
                </div>
            @else
                <div class="row gx-lg-6 gy-4 gy-lg-0">

                    {{-- Cart table --}}
                    <div class="col-lg-8">
                        @php
                            $freeShippingThreshold = 100;
                            $remaining = max(0, $freeShippingThreshold - $subtotal);
                        @endphp
                        @if($remaining > 0)
                            <div class="mb-4">
                                <span>Spend <strong>${{ number_format($remaining, 2) }}</strong> more and get free shipping!</span>
                                <div class="progress mt-3" style="height: 4px">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ min(100, ($subtotal / $freeShippingThreshold) * 100) }}%"></div>
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success py-2 mb-4">You qualify for <strong>free shipping</strong>!</div>
                        @endif

                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $item)
                                                <tr>
                                                    <td class="py-4 align-middle">
                                                        <div class="d-flex align-items-start gap-4">
                                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                                class="border" width="80" style="object-fit:cover;height:80px;">
                                                            <div class="mb-2">
                                                                <h3 class="fs-6 mb-1">{{ $item['name'] }}</h3>
                                                                <p class="mb-2 text-muted">${{ number_format($item['price'], 2) }}</p>
                                                                <form method="POST" action="{{ route('cart.remove') }}">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle">
                                                        <form method="POST" action="{{ route('cart.update') }}">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                            <div class="d-inline-flex align-items-center border p-2">
                                                                <button type="button" class="btn btn-sm p-0 px-2 fs-5 lh-1"
                                                                    onclick="this.closest('form').querySelector('input[name=qty]').stepDown(); this.closest('form').submit()">-</button>
                                                                <input type="number" name="qty" class="form-control text-center mx-1 p-0 border-0"
                                                                    value="{{ $item['qty'] }}" min="1" style="width:50px;"
                                                                    onchange="this.closest('form').submit()">
                                                                <button type="button" class="btn btn-sm p-0 px-2 fs-5 lh-1"
                                                                    onclick="this.closest('form').querySelector('input[name=qty]').stepUp(); this.closest('form').submit()">+</button>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td class="align-middle fw-semibold">${{ number_format($item['price'] * $item['qty'], 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 d-flex gap-3">
                            <a href="{{ route('products.index') }}" class="text-link">Continue Shopping</a>
                        </div>

                        <div class="mt-6">
                            <h3 class="fs-6 d-flex align-items-center gap-2 mb-3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20.97 6.20158L12.72 1.68752C12.4996 1.56572 12.2518 1.50183 12 1.50183C11.7482 1.50183 11.5004 1.56572 11.28 1.68752L3.03 6.20345C2.7944 6.33236 2.59772 6.52217 2.46052 6.75304C2.32331 6.98391 2.25061 7.24739 2.25 7.51595V16.4822C2.25061 16.7508 2.32331 17.0142 2.46052 17.2451C2.59772 17.476 2.7944 17.6658 3.03 17.7947L11.28 22.3106C11.5004 22.4324 11.7482 22.4963 12 22.4963C12.2518 22.4963 12.4996 22.4324 12.72 22.3106L20.97 17.7947C21.2056 17.6658 21.4023 17.476 21.5395 17.2451C21.6767 17.0142 21.7494 16.7508 21.75 16.4822V7.51689C21.7499 7.24785 21.6774 6.98379 21.5402 6.75238C21.403 6.52096 21.206 6.33072 20.97 6.20158Z" fill="#211F1C"/>
                                </svg>
                                <span>Apply Discount Code</span>
                            </h3>
                            <form class="row g-3">
                                <div class="col-lg-4 col-md-8 col-12">
                                    <input type="text" class="form-control" placeholder="Enter discount code" />
                                </div>
                                <div class="col-lg-auto col-md-4 col-12">
                                    <button type="button" class="btn btn-primary">Apply Discount</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- Order Summary --}}
                    <div class="col-lg-4">
                        <div class="card bg-light bg-opacity-25 mb-4">
                            <div class="card-header px-4 py-3">
                                <h3 class="fs-5 mb-0">Order Summary</h3>
                            </div>
                            <div class="card-body px-4">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span>Subtotal ({{ count($cartItems) }} item{{ count($cartItems) > 1 ? 's' : '' }})</span>
                                    <span class="text-dark fw-medium">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span>Shipping</span>
                                    <span>{{ $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) }}</span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between border-top pt-3 mb-2 fw-medium text-dark">
                                    <span>Total:</span>
                                    <span>${{ number_format($total, 2) }} USD</span>
                                </div>
                                <small class="text-muted">Tax included and shipping calculated at checkout</small>
                                <div class="d-grid mt-4">
                                    <a href="{{ route('checkout') }}" class="btn btn-primary">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-body p-4">
                                <h3 class="fs-6 text-center mb-3">We accept payments</h3>
                                <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                                    {{-- Visa --}}
                                    <svg width="38" height="24" viewBox="0 0 38 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#vc1)"><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z" fill="#000"/><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z" fill="#fff"/><path d="M28.3 10.1H28c-.4 1-.7 1.5-1 3.1h1.9c-.3-1.5-.3-2.2-.6-3.1Zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5 2.9-7.3c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.1ZM17.8 15.7l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-1.8-2.4-1.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.2 0-.5 0-.8.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1Zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-.9 4.5-.1.2-.1.2-.3.2M5 8.2c0-.1.2-.1.3-.1h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1L13 8.2c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5l-.1-.2Z" fill="#142688"/></g><defs><clipPath id="vc1"><rect width="38" height="24" fill="#fff"/></clipPath></defs></svg>
                                    {{-- Mastercard --}}
                                    <svg width="38" height="24" viewBox="0 0 38 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#mc1)"><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z" fill="#000"/><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z" fill="#fff"/><path d="M15 19c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7Z" fill="#EB001B"/><path d="M23 19c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7Z" fill="#F79E1B"/><path d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.3 3-3.4 3-5.7Z" fill="#FF5F00"/></g><defs><clipPath id="mc1"><rect width="38" height="24" fill="#fff"/></clipPath></defs></svg>
                                    {{-- PayPal --}}
                                    <svg width="38" height="24" viewBox="0 0 38 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#pp1)"><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z" fill="#000"/><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z" fill="#fff"/><path d="M23.9 8.3c.2-1 0-1.7-.6-2.3-.6-.7-1.7-1-3.1-1h-4.1c-.3 0-.5.2-.6.5L14 15.6c0 .2.1.4.3.4H17l.4-3.4-.1.1c.1-.3.3-.5.6-.5h1.3c2.9 0 5.1-1.2 5.8-4.5l.3.1Z" fill="#003087"/><path d="M23.9 8.2l-.2.2c-.7 2.8-2.4 3.8-4.8 3.8h-1.3c-.3 0-.5.2-.6.5l-.8 3.9-.2 1c0 .2.1.4.3.4h2.1c.3 0 .5-.2.5-.5v-.1l.4-2.4v-.1c0-.3.2-.5.5-.5h.3c2.1 0 3.7-.8 4.1-3.2.2-1 .1-1.8-.4-2.4-.1-.1-.2-.3-.4-.4l.5.1Z" fill="#3086C8"/><path d="M23.3 8c-.1 0-.2-.1-.3-.1-.1 0-.2-.1-.3-.1-.4-.1-.8-.1-1.2-.1h-3c-.1 0-.2 0-.2.1-.2.1-.3.2-.3.4l-.7 4.4v.1c.1-.3.3-.5.6-.5h1.3c2.4 0 4.1-1 4.8-3.8l.1-.1c-.2-.1-.4-.2-.6-.2l-.2-.1Z" fill="#012169"/></g><defs><clipPath id="pp1"><rect width="38" height="24" fill="#fff"/></clipPath></defs></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('client/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/js/theme.min.js') }}"></script>
@endpush
