@extends('client.layouts.master')
@push('styles')
    <style>
        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-start,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
            // transition-duration: 10s;
        }

        /* display 4 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next,
            .carousel-item-next:not(.carousel-item-start) {
                transform: translateX(25%) !important;
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-item-prev:not(.carousel-item-end),
            .active.carousel-item-start,
            .carousel-item-prev:not(.carousel-item-end) {
                transform: translateX(-25%) !important;
            }

            .carousel-item-next.carousel-item-start,
            .active.carousel-item-end {
                transform: translateX(0) !important;
            }

            .carousel-inner .carousel-item-prev,
            .carousel-item-prev:not(.carousel-item-end) {
                transform: translateX(-25%) !important;
            }
        }
    </style>
@endpush
@section('content')
    <!--full width Slider section start here-->
    <div class="mg-slider-section">

        @foreach ($sliders as $item)
            <div class="mg-slide d-flex align-items-center" style="background-image: url({{ asset($item->image_path) }});">
                <div class='container mg-slider-text-box'>
                    <div class="mg-slide-text">
                        <span>{{ $item->title }}</span>
                        <h2>{{ $item->subtitle }}</h2>
                        <div class="mg-price mb-3">Starting from <span>$1,000</span></div>
                        <a class="mg-shop-btn btn btn-default" href="{{ route('products.index') }}">SHOP NOW <i
                                class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
                <div></div>
            </div>
        @endforeach
    </div>
    <!--full width Slider section end here-->

    <!--Feature section start here-->
    @include('client.partials.features')
    <!--Feature section end here-->

    <!--image with text overlay section start here-->
    <div class="mg-img-overlay-section mg-section-padding mg-padding-lr">
        <div class="container">
            <div class="row">
                @foreach ($data['sale_item_products'] as $item)
                    <div class="col-md-6 mt-sm-3 mb-sm-3">
                        <div class="mg-img-overlay-inner">
                            <div class="mg-img-box">
                                <img src="{{ asset($item->files[0]->path) }}" alt="">
                            </div>
                            <div class="mg-overlay-text">
                                <div>
                                    <span>GET 50% OFF</span>
                                    <h6 class="mb-0">
                                        {{ $item->title }}
                                    </h6>

                                    <strong class="text-primary">
                                        {{ $item->brand->title }}
                                    </strong>
                                    <br>
                                    <a class="btn btn-lg mt-4" href="shop.html">Shop Now <i
                                            class="fa-solid fa-angle-right"></i></a>
                                </div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--image with text overlay section end here-->

    <!--tabs section start here-->
    <div class="mg-tabs-section mg-section-padding">
        <div class="container">
            <div class="mg-section-heading text-center">
                <h5>Top Deals Of The Day</h5>
                <span>
                    Experience incredible savings with our "Top Deals of the Day." Discover handpicked discounts on fashion,
                    electronics, home decor, and more. Don't miss out on limited-time offers,
                    ensuring you get the best products at unbeatable prices. Shop now and indulge in a rewarding shopping
                    experience on our ecommerce website.
                </span>
            </div>
            <div class="mg-tabs-box mt-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="Featured-tab" data-bs-toggle="tab" data-bs-target="#Featured"
                            type="button" role="tab" aria-controls="Featured" aria-selected="true">FEATURED</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Toprated-tab" data-bs-toggle="tab" data-bs-target="#Top-rated"
                            type="button" role="tab" aria-controls="Top-rated" aria-selected="false">TOP RATED</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="Bestseller-tab" data-bs-toggle="tab" data-bs-target="#Bestseller"
                            type="button" role="tab" aria-controls="Bestseller"
                            aria-selected="false">BESTSELLER</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="Featured" role="tabpanel" aria-labelledby="Featured">
                        <div class="mg-tab-content">
                            <div class="container">
                                <div class="row">
                                    @foreach ($data['featured_products'] as $item)
                                        <div class="col-md-4 col-sm-6 col-6">
                                            <div class="mg-tab-grid-box">
                                                <div class="mg-tab-img-box">
                                                    <div class="mg-tabs-img">
                                                        <a href="single-product.html">
                                                            <img src="{{ asset($item->files[0]->path) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="mg-atc-overlay">
                                                        <a href="cart.html">
                                                            <div class="mg-cart-box">
                                                                ADD TO CART
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mg-tab-text mt-3">
                                                    <div
                                                        class="mg-tab-text-top d-flex justify-content-between align-items-center">
                                                        <div class="mg-small-heading">
                                                            <a class="text-decoration-none" href="shop.html">
                                                                <span>
                                                                    {{ $item->brand->title }} - {{ $item->series }}
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <a class="text-decoration-none" href="single-product.html">
                                                        <h5>
                                                            {{ Str::limit($item->title, 40, '...') }}
                                                        </h5>
                                                    </a>
                                                    <div class="mg-pricing">
                                                        {{ $item->price }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Top-rated" role="tabpanel">
                        <div class="mg-tab-content">
                            <div class="container">
                                <div class="row">
                                    @foreach ($data['top_rated_products'] as $item)
                                        <div class="col-md-4 col-sm-6 col-6">
                                            <div class="mg-tab-grid-box">
                                                <div class="mg-tab-img-box">
                                                    <div class="mg-tabs-img">
                                                        <a href="single-product.html">
                                                            <img src="{{ asset($item->files[0]->path) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="mg-atc-overlay">
                                                        <a href="cart.html">
                                                            <div class="mg-cart-box">
                                                                ADD TO CART
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mg-tab-text mt-3">
                                                    <div
                                                        class="mg-tab-text-top d-flex justify-content-between align-items-center">
                                                        <div class="mg-small-heading">
                                                            <a class="text-decoration-none" href="shop.html">
                                                                <span>
                                                                    {{ $item->brand->title }} - {{ $item->series }}
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <a class="text-decoration-none" href="single-product.html">
                                                        <h5>
                                                            {{ Str::limit($item->title, 40, '...') }}
                                                        </h5>
                                                    </a>
                                                    <div class="mg-pricing">
                                                        {{ $item->price }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="Bestseller" role="tabpanel">
                        <div class="mg-tab-content">
                            <div class="container">
                                <div class="row">
                                    @foreach ($data['best_seller_products'] as $item)
                                        <div class="col-md-4 col-sm-6 col-6">
                                            <div class="mg-tab-grid-box">
                                                <div class="mg-tab-img-box">
                                                    <div class="mg-tabs-img">
                                                        <a href="single-product.html">
                                                            <img src="{{ asset($item->files[0]->path) }}" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="mg-atc-overlay">
                                                        <a href="cart.html">
                                                            <div class="mg-cart-box">
                                                                ADD TO CART
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="mg-tab-text mt-3">
                                                    <div
                                                        class="mg-tab-text-top d-flex justify-content-between align-items-center">
                                                        <div class="mg-small-heading">
                                                            <a class="text-decoration-none" href="shop.html">
                                                                <span>
                                                                    {{ $item->brand->title }} - {{ $item->series }}
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <a class="text-decoration-none" href="single-product.html">
                                                        <h5>
                                                            {{ Str::limit($item->title, 40, '...') }}
                                                        </h5>
                                                    </a>
                                                    <div class="mg-pricing">
                                                        {{ $item->price }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--tabs section end here-->

    <!--Container slider section start here-->
    <div class="mg-container-fit-slider">
        <div class="container">
            <div class="mg-slider-section mg-padding-lr">
                @foreach ($sliders as $item)
                    <div class="mg-slide d-flex align-items-center"
                        style="background-image: url('{{ asset($item->image_path) }}');">
                        <div class='container mg-slider-text-box'>
                            <div class="mg-slide-text">
                                {{-- <span>I PHONE PRO</span>
                                <h2>And then the pro comes</h2>
                        <p>Power through work, creation, and play with premium laptops<br>engineered for speed, display quality, and all-day battery life.</p>
                                <div class="mg-price mb-3">Starting from <span>$1,089</span></div>
                                <a class="mg-shop-btn btn btn-default" href="shop.html">SHOP NOW <i class="fa-solid fa-angle-right"></i></a> --}}
                            </div>
                        </div>
                        <div></div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--Container slider section end here-->

    <!--Text with background image and carousel section start here-->
    <div id="myCarousel" class="carousel slide container" data-bs-ride="carousel">
        <div class="carousel-inner w-100">
            @foreach (site_brands() as $key => $item)
                <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                    <div class="col-md-3">
                        <div class="card card-body border-0">
                            <img class="img-fluid" src="{{ asset($item['path']) }}">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--Text with background image and carousel section end here-->

    <!--Grid with small thumb and Text with background image section start here-->
    <?php
    if (count($data['top_deal_products']) > 0) {
        $top_deal = $data['top_deal_products'][0];
    }
    ?>
    @isset($top_deal)
        <div class="mg-toprated-section mg-padding-lr">
            <div class="container">
                <div class="mg-toprated-heading">
                    <h5>Top Rated Products</h5>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">

                        </div>
                    </div>

                    <div class="col-md-4 mg-margin-tb">
                        <div class="mg-text-bg-style2"
                            style="background-image: url({{ showImage($top_deal->files[0]->path) }})">
                            <div class="mg-img-bg-text">
                                <div>
                                    <span>TOP DEALS</span>
                                    <h6 class="mb-0">
                                        {{ $top_deal->title }}
                                    </h6>

                                    <strong class="text-primary">
                                        {{ $top_deal->brand->title }}
                                    </strong>
                                    <br>
                                    <a class="btn btn-lg" href="shop.html">
                                        SHOP NOW <i class="fa-solid fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endisset
    <!--Grid with small thumb and Text with background image section end here-->
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

    <script>
        var myCarousel = document.querySelector('#myCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 1000,
            touch: true
        });

        $(".carousel .carousel-inner").swipe({
            swipeLeft: function(event, direction, distance, duration, fingerCount) {
                this.parent().carousel("next");
            },
            swipeRight: function() {
                this.parent().carousel("prev");
            },
            threshold: 0,
            tap: function(event, target) {
                window.location = $(this).find(".carousel-item.active a").attr("href");
            },
            excludedElements: "label, button, input, select, textarea, .noSwipe"
        });

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }
                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
@endpush
