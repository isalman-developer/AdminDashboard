@extends('client.layouts.master')

@section('title', 'Checkout')

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
                    <div class="mg-page-header-heading"><h3>Checkout</h3></div>
                    <div class="mg-breadcrumb">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('cart') }}">Cart</a></li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="pt-lg-4 pb-lg-8">
        <div class="container">
            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf
                <div class="row gx-lg-6 gy-4 gy-lg-0">

                    {{-- Left: Delivery + Payment --}}
                    <div class="col-lg-8">

                        {{-- Contact --}}
                        <h2 class="fs-5 mb-3">Contact information</h2>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label" for="customer_name">Full name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror"
                                    id="customer_name" name="customer_name" value="{{ old('customer_name') }}" required>
                                @error('customer_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_email">Email address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('customer_email') is-invalid @enderror"
                                    id="customer_email" name="customer_email" value="{{ old('customer_email') }}" required>
                                @error('customer_email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="customer_phone">Phone number <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('customer_phone') is-invalid @enderror"
                                    id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" required>
                                @error('customer_phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        {{-- Delivery address --}}
                        <h2 class="fs-5 mb-3">Delivery address</h2>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label" for="address">Street address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror"
                                    id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="state">State</label>
                                <input type="text" class="form-control" id="state" name="state" value="{{ old('state') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" for="zip_code">ZIP code</label>
                                <input type="text" class="form-control" id="zip_code" name="zip_code" value="{{ old('zip_code') }}">
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="country">Country <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror"
                                    id="country" name="country" value="{{ old('country', 'United States') }}" required>
                                @error('country')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="notes">Order notes (optional)</label>
                                <textarea class="form-control" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
                            </div>
                        </div>

                        {{-- Payment --}}
                        <div class="mt-5 mb-4">
                            <h2 class="fs-5 mb-2">Payment</h2>
                            <p class="mb-0 text-muted small">All transactions are secure and encrypted.</p>
                        </div>

                        <div id="paymentMethod">
                            {{-- Cash on Delivery --}}
                            <div class="mb-2">
                                <div class="bg-light p-3 d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#collapseCod"
                                    aria-expanded="true" aria-controls="collapseCod" style="cursor:pointer;">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="radioCod" value="cod" checked>
                                        <label class="form-check-label fw-medium" for="radioCod">Cash on Delivery</label>
                                    </div>
                                    <span class="text-muted small">Pay when you receive</span>
                                </div>
                                <div class="collapse show px-4 py-3" id="collapseCod" data-bs-parent="#paymentMethod">
                                    <p class="mb-0 text-muted">Pay with cash upon delivery. Our courier will collect payment when your order arrives.</p>
                                </div>
                            </div>

                            {{-- Credit Card --}}
                            <div class="mb-2">
                                <div class="bg-light p-3 d-flex flex-md-row flex-column justify-content-between align-items-lg-center gap-2 gap-md-0"
                                    data-bs-toggle="collapse" data-bs-target="#collapseCreditcard"
                                    aria-expanded="false" aria-controls="collapseCreditcard" style="cursor:pointer;">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="radioCard" value="credit_card">
                                        <label class="form-check-label fw-medium" for="radioCard">Credit card</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <svg width="38" height="24" viewBox="0 0 38 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#vc2)"><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z" fill="#000"/><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z" fill="#fff"/><path d="M28.3 10.1H28c-.4 1-.7 1.5-1 3.1h1.9c-.3-1.5-.3-2.2-.6-3.1Zm2.9 5.9h-1.7c-.1 0-.1 0-.2-.1l-.2-.9-.1-.2h-2.4c-.1 0-.2 0-.2.2l-.3.9c0 .1-.1.1-.1.1h-2.1l.2-.5 2.9-7.3c0-.5.3-.7.8-.7h1.5c.1 0 .2 0 .2.2l1.4 6.5c.1.4.2.7.2 1.1.1.1.1.1.1.1ZM17.8 15.7l.4-1.8c.1 0 .2.1.2.1.7.3 1.4.5 2.1.4.2 0 .5-.1.7-.2.5-.2.5-.7.1-1.1-.2-.2-.5-.3-.8-.5-.4-.2-.8-.4-1.1-.7-1.2-1-1.8-2.4-1.1-3.1.6-.4.9-.8 1.7-.8 1.2 0 2.5 0 3.1.2h.1c-.1.6-.2 1.1-.4 1.7-.5-.2-1-.4-1.5-.4-.2 0-.5 0-.8.1-.2 0-.3.1-.4.2-.2.2-.2.5 0 .7l.5.4c.4.2.8.4 1.1.6.5.3 1 .8 1.1 1.4.2.9-.1 1.7-.9 2.3-.5.4-.7.6-1.4.6-1.4 0-2.5.1-3.4-.2-.1.2-.1.2-.2.1Zm-3.5.3c.1-.7.1-.7.2-1 .5-2.2 1-4.5 1.4-6.7.1-.2.1-.3.3-.3H18c-.2 1.2-.4 2.1-.7 3.2-.3 1.5-.6 3-.9 4.5-.1.2-.1.2-.3.2M5 8.2c0-.1.2-.1.3-.1h3.4c.5 0 .9.3 1 .8l.9 4.4c0 .1 0 .1.1.2 0-.1.1-.1.1-.1L13 8.2c-.1-.1 0-.2.1-.2h2.1c0 .1 0 .1-.1.2l-3.1 7.3c-.1.2-.1.3-.2.4-.1.1-.3 0-.5 0H9.7c-.1 0-.2 0-.2-.2L7.9 9.5c-.2-.2-.5-.5-.9-.6-.6-.3-1.7-.5-1.9-.5l-.1-.2Z" fill="#142688"/></g><defs><clipPath id="vc2"><rect width="38" height="24" fill="#fff"/></clipPath></defs></svg>
                                        <svg width="38" height="24" viewBox="0 0 38 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#mc2)"><path opacity=".07" d="M35 0H3C1.3 0 0 1.3 0 3v18c0 1.7 1.4 3 3 3h32c1.7 0 3-1.3 3-3V3c0-1.7-1.4-3-3-3Z" fill="#000"/><path d="M35 1c1.1 0 2 .9 2 2v18c0 1.1-.9 2-2 2H3c-1.1 0-2-.9-2-2V3c0-1.1.9-2 2-2h32Z" fill="#fff"/><path d="M15 19c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7Z" fill="#EB001B"/><path d="M23 19c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7Z" fill="#F79E1B"/><path d="M22 12c0-2.4-1.2-4.5-3-5.7-1.8 1.3-3 3.4-3 5.7s1.2 4.5 3 5.7c1.8-1.3 3-3.4 3-5.7Z" fill="#FF5F00"/></g><defs><clipPath id="mc2"><rect width="38" height="24" fill="#fff"/></clipPath></defs></svg>
                                    </div>
                                </div>
                                <div class="collapse px-4 py-4" id="collapseCreditcard" data-bs-parent="#paymentMethod">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label">Card Number</label>
                                            <input type="text" class="form-control" placeholder="xxxx-xxxx-xxxx-xxxx">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label">Name on card</label>
                                            <input type="text" class="form-control" placeholder="Enter name">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Expiry date</label>
                                            <input type="text" class="form-control" placeholder="MM/YY">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">CVV</label>
                                            <input type="password" class="form-control" placeholder="xxx" maxlength="3">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- PayPal --}}
                            <div class="mb-2">
                                <div class="bg-light p-3 d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#collapsePaypal"
                                    aria-expanded="false" aria-controls="collapsePaypal" style="cursor:pointer;">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="radioPaypal" value="paypal">
                                        <label class="form-check-label fw-medium" for="radioPaypal">PayPal</label>
                                    </div>
                                    <span class="text-muted small">Pay with PayPal</span>
                                </div>
                                <div class="collapse px-4 py-3" id="collapsePaypal" data-bs-parent="#paymentMethod">
                                    <p class="mb-0 text-muted">After clicking "Place Order", you will be redirected to PayPal to complete your purchase securely.</p>
                                </div>
                            </div>

                            {{-- Google Pay --}}
                            <div class="mb-2">
                                <div class="bg-light p-3 d-flex justify-content-between align-items-center"
                                    data-bs-toggle="collapse" data-bs-target="#collapseGpay"
                                    aria-expanded="false" aria-controls="collapseGpay" style="cursor:pointer;">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="payment_method"
                                            id="radioGpay" value="gpay">
                                        <label class="form-check-label fw-medium" for="radioGpay">Google Pay</label>
                                    </div>
                                    <span class="text-muted small">Pay with Google Pay</span>
                                </div>
                                <div class="collapse px-4 py-3" id="collapseGpay" data-bs-parent="#paymentMethod">
                                    <p class="mb-0 text-muted">After clicking "Place Order", you will be redirected to Google Pay to complete your purchase securely.</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    {{-- Right: Order Summary --}}
                    <div class="col-lg-4">
                        <div class="card bg-light bg-opacity-25 mb-4 sticky-top" style="top: 20px;">
                            <div class="card-header px-4 py-3">
                                <h3 class="fs-5 mb-0">Order Summary</h3>
                            </div>
                            <div class="card-body px-4">
                                @foreach($cartItems as $item)
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="position-relative flex-shrink-0">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                width="60" height="60" style="object-fit:cover;border:1px solid #eee;">
                                            <span class="badge bg-dark rounded-circle position-absolute"
                                                style="top:-8px;right:-8px;width:20px;height:20px;display:flex;align-items:center;justify-content:center;font-size:11px;">{{ $item['qty'] }}</span>
                                        </div>
                                        <div class="flex-grow-1">
                                            <p class="mb-0 small fw-medium">{{ Str::limit($item['name'], 35) }}</p>
                                        </div>
                                        <div class="text-end small fw-semibold">${{ number_format($item['price'] * $item['qty'], 2) }}</div>
                                    </div>
                                @endforeach

                                <hr>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Subtotal</span>
                                    <span class="fw-medium">${{ number_format($subtotal, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span>Shipping</span>
                                    <span>{{ $shipping == 0 ? 'Free' : '$' . number_format($shipping, 2) }}</span>
                                </div>
                                <div class="d-flex justify-content-between border-top pt-3 fw-medium text-dark">
                                    <span>Total</span>
                                    <span>${{ number_format($total, 2) }} USD</span>
                                </div>
                                <div class="d-grid mt-4">
                                    <button type="submit" class="btn btn-primary btn-lg">Place Order</button>
                                </div>
                                <p class="text-center text-muted small mt-3 mb-0">
                                    <a href="{{ route('cart') }}" class="text-link">← Back to cart</a>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{ asset('client/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/js/theme.min.js') }}"></script>
@endpush
