@extends('client.layouts.master')
@section('title', 'Thank you - Order #' . ($order->order_number ?? ''))
@push('styles')
    <link rel="stylesheet" href="{{ asset('client/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/theme.min.css') }}">
@endpush

@section('content')

    <div class="container py-lg-8 py-4">
        <div class="bg-light">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="text-center py-lg-10 py-6 px-3">
                        <div class="mb-4">
                            <svg width="182" height="133" viewBox="0 0 182 133" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.048 63C18.0487 63.0678 18.049 63.1364 18.0488 63.2057C18.1598 77.5839 29.9095 81.1849 35.898 81.1937C35.9319 81.1936 35.9659 81.1935 36 81.1935C35.9662 81.1937 35.9322 81.1938 35.898 81.1937C21.6265 81.2492 18.0566 92.9444 18.0478 98.8984C18.0479 98.9322 18.048 98.9661 18.048 99C18.0478 98.9663 18.0478 98.9325 18.0478 98.8984C17.9926 84.751 6.40572 81.216 0.310895 81.1917C0.207826 81.1929 0.104195 81.1935 0 81.1935C0.101934 81.1919 0.205595 81.1913 0.310895 81.1917C14.4807 81.0226 18.032 69.29 18.0488 63.2057C18.0483 63.1374 18.048 63.0688 18.048 63Z" fill="#16A34A"/>
                                <path d="M139.539 0C139.539 0.0546277 139.539 0.109866 139.539 0.165695C139.629 11.7481 149.094 14.6489 153.918 14.6561C153.945 14.656 153.973 14.6559 154 14.6559C153.973 14.6561 153.945 14.6561 153.918 14.6561C142.421 14.7008 139.546 24.1219 139.539 28.9182C139.539 28.9454 139.539 28.9727 139.539 29C139.539 28.9729 139.538 28.9456 139.539 28.9182C139.494 17.5216 130.16 14.674 125.25 14.6544C125.167 14.6554 125.084 14.6559 125 14.6559C125.082 14.6546 125.166 14.6541 125.25 14.6544C136.665 14.5182 139.526 5.06694 139.539 0.165695C139.539 0.11066 139.539 0.0554282 139.539 0Z" fill="#16A34A"/>
                                <path d="M178.011 70C178.011 70.0151 178.011 70.0303 178.011 70.0457C178.036 73.2409 180.647 74.0411 181.977 74.0431C181.985 74.043 181.992 74.043 182 74.043C181.992 74.0431 181.985 74.0431 181.977 74.0431C178.806 74.0554 178.013 76.6543 178.011 77.9774C178.011 77.9849 178.011 77.9925 178.011 78C178.011 77.9925 178.011 77.985 178.011 77.9774C177.998 74.8335 175.423 74.048 174.069 74.0426C174.046 74.0429 174.023 74.043 174 74.043C174.023 74.0426 174.046 74.0425 174.069 74.0426C177.218 74.005 178.007 71.3978 178.011 70.0457C178.011 70.0305 178.011 70.0153 178.011 70Z" fill="#16A34A"/>
                                <circle cx="102" cy="81" r="52" fill="#16A34A"/>
                                <path d="M94 101C95.1046 101 96 100.105 96 99C96 97.8954 95.1046 97 94 97C92.8954 97 92 97.8954 92 99C92 100.105 92.8954 101 94 101Z" stroke="white" stroke-width="3.91667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M116 101C117.105 101 118 100.105 118 99C118 97.8954 117.105 97 116 97C114.895 97 114 97.8954 114 99C114 100.105 114.895 101 116 101Z" stroke="white" stroke-width="3.91667" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M82.1016 61.1H86.1016L91.4216 85.94C91.6167 86.8497 92.1229 87.663 92.853 88.2397C93.5831 88.8165 94.4914 89.1207 95.4216 89.1H114.982C115.892 89.0985 116.775 88.7866 117.484 88.2157C118.193 87.6448 118.686 86.8491 118.882 85.96L122.182 71.1H88.2416" stroke="white" stroke-width="3.91667" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <h1 class="display-4 fw-bold mb-3">Thank you for your order!</h1>
                        <p class="mb-4">
                            Your order <span class="fw-semibold">#{{ $order->order_number }}</span> has been accepted
                            and will be processed shortly.
                        </p>
                        <a href="{{ route('products.index') }}" class="btn btn-primary">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Details --}}
    <section class="py-lg-6 py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-header px-4 py-3">
                            <h3 class="fs-5 mb-0">Order Details — #{{ $order->order_number }}</h3>
                        </div>
                        <div class="card-body px-4">
                            <div class="table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th class="text-center">Qty</th>
                                            <th class="text-end">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->product_name }}</td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-end">${{ number_format($item->subtotal, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-end">Subtotal</td>
                                            <td class="text-end">${{ number_format($order->subtotal, 2) }}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" class="text-end">Shipping</td>
                                            <td class="text-end">{{ $order->shipping == 0 ? 'Free' : '$' . number_format($order->shipping, 2) }}</td>
                                        </tr>
                                        <tr class="fw-bold">
                                            <td colspan="2" class="text-end">Total</td>
                                            <td class="text-end">${{ number_format($order->total, 2) }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <h6 class="fw-semibold mb-1">Deliver to:</h6>
                                    <p class="text-muted small mb-0">
                                        {{ $order->customer_name }}<br>
                                        {{ $order->address }}, {{ $order->city }}{{ $order->state ? ', ' . $order->state : '' }}
                                        {{ $order->zip_code }}<br>
                                        {{ $order->country }}
                                    </p>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="fw-semibold mb-1">Payment method:</h6>
                                    <p class="text-muted small mb-0">
                                        @switch($order->payment_method)
                                            @case('cod') Cash on Delivery @break
                                            @case('credit_card') Credit Card @break
                                            @case('paypal') PayPal @break
                                            @case('gpay') Google Pay @break
                                        @endswitch
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Features strip --}}
    @include('client.partials.features')

@endsection

@push('scripts')
    <script src="{{ asset('client/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/js/theme.min.js') }}"></script>
@endpush
