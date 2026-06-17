@extends('client.layouts.master')

@section('title', setting('site_name', 'LaptopStore') . ' - Laptops & Computers')

@push('styles')
    <link rel="stylesheet" href="{{ asset('client/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('client/css/theme.min.css') }}">
@endpush

@section('content')
    <!--full width Slider section start here-->
    <div class="mg-slider-section">
        @foreach ($sliders as $item)
            <div class="mg-slide d-flex align-items-center" style="background-image: url({{ Storage::url($item->image_path) }});">
                <div class='container mg-slider-text-box'>
                    <div class="mg-slide-text">
                        <span>{{ $item->title }}</span>
                        <h2>{{ $item->subtitle }}</h2>
                        <div class="mg-price mb-3">Starting from <span>$1,000</span></div>
                        <a class="mg-shop-btn btn btn-default" href="{{ route('products.index') }}">SHOP NOW <i class="fa-solid fa-angle-right"></i></a>
                    </div>
                </div>
                <div></div>
            </div>
        @endforeach
    </div>
    <!--full width Slider section end here-->

    <!--New arrival start-->
    <section class="py-lg-10 pt-6 mx-3 mx-lg-0">
        <div class="container">
            <div class="row mb-md-8 mb-4">
                <div class="col-lg-12">
                    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
                        <div class="col-sm-7">
                            <h2>New arrivals</h2>
                            <p class="mb-0">We are inspired by the realities of life today, in which traditional divides
                                between personal and professional space are more fluid.</p>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('products.index') }}" class="d-flex align-items-center gap-2 btn-dark-link">
                                <span class="text-link">View all</span>
                                <span class="btn btn-outline-primary btn-icon btn-xxs rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Slider-->
        <div class="swiper-container swiper px-3" id="swiper-3" data-pagination-type="progressbar" data-speed="400"
            data-space-between="30" data-pagination="true" data-navigation="true" data-autoplay="false"
            data-effect="slides" data-autoplay-delay="3000"
            data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1024": {"slidesPerView": 6}}'>
            <div class="swiper-wrapper pb-10">
                @forelse ($data['normal_products'] as $item)
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="text-center product-card-img mb-4">
                                <a href="{{ route('products.show', $item) }}">
                                        <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" class="img-fluid">
                                        <img src="{{ Storage::url($item->image_path2) }}" alt="{{ $item->name }}" class="img-fluid product-img-hover">
                                   
                                </a>
                                <div class="product-card-btn">
                                    <a href="{{ route('products.show', $item) }}" class="btn btn-primary btn-icon btn-sm animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.show', $item) }}" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-medium text-uppercase">{{ $item->brand?->name ?? '' }}</span>
                                <div class="d-flex gap-3 align-items-center">
                                    <span>
                                        4.5
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                            class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
                                            <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                                        </svg>
                                    </span>
                                    <button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-heart animate-target" viewBox="0 0 16 16">
                                            <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                                    <a href="{{ route('products.show', $item) }}">{{ Str::limit($item->name, 30) }}</a>
                                </h3>
                                <p class="mb-0 lh-1 text-dark fw-semibold">${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback static slides when no products --}}
                    @foreach(['Sofa with wood legs' => ['product-img-1.jpg','product-img-hover-1.jpg','$34.00'], 'Floor Lamp' => ['product-img-2.jpg','product-img-hover-2.jpg','$95.00'], 'Comfort Seat Chair' => ['product-img-3.jpg','product-img-hover-3.jpg','$78.00'], 'Armchair' => ['product-img-4.jpg','product-img-hover-4.jpg','$75.00'], 'High Back Boss Chair' => ['product-img-5.jpg','product-img-hover-5.jpg','$55.00'], 'Fancy Metal Wall Clock' => ['product-img-6.jpg','product-img-hover-6.jpg','$35.00']] as $name => $imgs)
                        <div class="swiper-slide mb-5">
                            <div class="product-card">
                                <div class="text-center mb-4 product-card-img">
                                    <a href="{{ route('products.index') }}">
                                        <img src="{{ asset('client/images/product/' . $imgs[0]) }}" alt="{{ $name }}" class="img-fluid">
                                        <img src="{{ asset('client/images/product/' . $imgs[1]) }}" alt="{{ $name }}" class="img-fluid product-img-hover">
                                    </a>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="small fw-medium text-uppercase">BRAND</span>
                                </div>
                                <div class="mb-3">
                                    <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="{{ route('products.index') }}">{{ $name }}</a></h3>
                                    <p class="mb-0 lh-1 text-dark fw-semibold">{{ $imgs[2] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
            <div class="swiper-pagination top-100 mt-n4 start-lg-10 w-lg-75"></div>
            <div class="swiper-navigation position-absolute end-10 bottom-0 mb-4 d-none d-lg-block">
                <div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide2"></div>
                <div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide1"></div>
            </div>
        </div>
    </section>
    <!--New arrival end-->

    <!--Marquee start-->
    <div class="marquee mb-lg-8 py-6">
        <div class="text-track display-1 fw-bold text-primary py-lg-6" style="font-size: 128px">
            Performance. Power. Precision. Your Perfect Laptop Awaits. Performance. Power. Precision. Your Perfect Laptop Awaits. Performance. Power. Precision. Your Perfect Laptop Awaits.
        </div>
    </div>
    <!--Marquee end-->

    <!--Featured Laptops start-->
    @if($data['featured_products']->isNotEmpty())
    <section class="py-lg-10 pt-6 mx-3 mx-lg-0">
        <div class="container">
            <div class="row mb-md-8 mb-4">
                <div class="col-lg-12">
                    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
                        <div class="col-sm-7">
                            <h2>Featured laptops</h2>
                            <p class="mb-0">Hand-picked selections from our top brands — built for performance, designed for life.</p>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('products.index') }}" class="d-flex align-items-center gap-2 btn-dark-link">
                                <span class="text-link">View all</span>
                                <span class="btn btn-outline-primary btn-icon btn-xxs rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-container swiper px-3" data-pagination-type="progressbar" data-speed="400"
            data-space-between="30" data-pagination="true" data-navigation="true" data-autoplay="false"
            data-effect="slides" data-autoplay-delay="3000"
            data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1024": {"slidesPerView": 4}}'>
            <div class="swiper-wrapper pb-10">
                @foreach ($data['featured_products'] as $item)
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="text-center product-card-img mb-4">
                                <a href="{{ route('products.show', $item) }}">
                                    <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" class="img-fluid">
                                    <img src="{{ Storage::url($item->image_path2) }}" alt="{{ $item->name }}" class="img-fluid product-img-hover">
                                </a>
                                <div class="product-card-btn">
                                    <a href="{{ route('products.show', $item) }}" class="btn btn-primary btn-icon btn-sm animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.show', $item) }}" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-medium text-uppercase">{{ $item->brand?->name ?? '' }}</span>
                            </div>
                            <div class="mb-3">
                                <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                                    <a href="{{ route('products.show', $item) }}">{{ Str::limit($item->name, 30) }}</a>
                                </h3>
                                <p class="mb-0 lh-1 text-dark fw-semibold">${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination top-100 mt-n4 start-lg-10 w-lg-75"></div>
            <div class="swiper-navigation position-absolute end-10 bottom-0 mb-4 d-none d-lg-block">
                <div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle"></div>
                <div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle"></div>
            </div>
        </div>
    </section>
    @endif
    <!--Featured Laptops end-->

    <!--Explore collection start-->
    <section class="py-lg-10 py-6">
        <div class="container">
            <div class="row mb-md-8 mb-4">
                <div class="col-lg-12">
                    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
                        <div class="col-sm-7">
                            <h2 class="mb-0">Explore the collections</h2>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('products.index') }}" class="d-flex align-items-center gap-2 btn-dark-link">
                                <span class="text-link">View all</span>
                                <span class="btn btn-outline-primary btn-icon btn-xxs rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper-container swiper" id="swiper-1" data-pagination-type="bullets" data-speed="400"
                    data-space-between="30" data-pagination="true" data-navigation="false" data-autoplay="false"
                    data-effect="slides" data-autoplay-delay="3000"
                    data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1024": {"slidesPerView": 5}}'>
                    <div class="swiper-wrapper pb-8">
                        @forelse($categories as $category)
                            @php $firstProduct = $category->products->first(); @endphp
                            <div class="swiper-slide">
                                <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="text-center p-4 card-animation d-block bg-light">
                                    @if($firstProduct && $firstProduct->image_path)
                                        <img src="{{ Storage::url($firstProduct->image_path) }}" alt="{{ $category->name }}" class="mb-3 img-fluid" style="height: 140px; object-fit: contain;" />
                                    @else
                                        <div class="mb-3 d-flex align-items-center justify-content-center bg-secondary bg-opacity-10 rounded" style="height: 140px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-laptop text-secondary" viewBox="0 0 16 16">
                                                <path d="M13.5 3a.5.5 0 0 1 .5.5V11H2V3.5a.5.5 0 0 1 .5-.5zm-11-1A1.5 1.5 0 0 0 1 3.5V12h.5a.5.5 0 0 0 0 1H3v.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V13h1.5a.5.5 0 0 0 0-1H15V3.5A1.5 1.5 0 0 0 13.5 2z"/>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="d-flex align-items-center gap-2 justify-content-center link-animation">
                                        <h3 class="fs-6 mb-0">{{ $category->name }}</h3>
                                        <span class="btn btn-outline-dark btn-icon btn-xxs rounded-circle circle-chevron">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <div class="swiper-slide">
                                <a href="{{ route('products.index') }}" class="text-center p-4 card-animation d-block bg-light">
                                    <div class="d-flex align-items-center gap-2 justify-content-center link-animation">
                                        <h3 class="fs-6 mb-0">Browse all laptops</h3>
                                        <span class="btn btn-outline-dark btn-icon btn-xxs rounded-circle circle-chevron">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor"
                                                class="bi bi-chevron-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd"
                                                    d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforelse
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-navigation position-absolute start-50 bottom-0 mb-4">
                        <div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide3"></div>
                        <div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide4"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Explore collection end-->

    <!--Best Sellers start-->
    @if($data['best_seller_products']->isNotEmpty())
    <section class="pb-lg-10 py-6 mx-3 mx-lg-0">
        <div class="container">
            <div class="row mb-md-8 mb-4">
                <div class="col-lg-12">
                    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
                        <div class="col-sm-7">
                            <h2>Best sellers</h2>
                            <p class="mb-0">Our most popular laptops — loved by gamers, professionals, and everyday users alike.</p>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('products.index') }}" class="d-flex align-items-center gap-2 btn-dark-link">
                                <span class="text-link">View all</span>
                                <span class="btn btn-outline-primary btn-icon btn-xxs rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-container swiper px-3" data-pagination-type="progressbar" data-speed="400"
            data-space-between="30" data-pagination="true" data-navigation="true" data-autoplay="false"
            data-effect="slides" data-autoplay-delay="3000"
            data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 3}, "1024": {"slidesPerView": 4}}'>
            <div class="swiper-wrapper pb-10">
                @foreach ($data['best_seller_products'] as $item)
                    <div class="swiper-slide">
                        <div class="product-card">
                            <div class="text-center product-card-img mb-4">
                                <a href="{{ route('products.show', $item) }}">
                                    <img src="{{ Storage::url($item->image_path) }}" alt="{{ $item->name }}" class="img-fluid">
                                    <img src="{{ Storage::url($item->image_path2) }}" alt="{{ $item->name }}" class="img-fluid product-img-hover">
                                </a>
                                <div class="product-card-btn">
                                    <a href="{{ route('products.show', $item) }}" class="btn btn-primary btn-icon btn-sm animate-pulse">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-eye animate-target" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                        </svg>
                                    </a>
                                    <a href="{{ route('products.show', $item) }}" class="btn btn-primary btn-sm">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
                                            class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
                                        </svg>
                                        View
                                    </a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-medium text-uppercase">{{ $item->brand?->name ?? '' }}</span>
                            </div>
                            <div class="mb-3">
                                <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                                    <a href="{{ route('products.show', $item) }}">{{ Str::limit($item->name, 30) }}</a>
                                </h3>
                                <p class="mb-0 lh-1 text-dark fw-semibold">${{ number_format($item->price, 2) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination top-100 mt-n4 start-lg-10 w-lg-75"></div>
            <div class="swiper-navigation position-absolute end-10 bottom-0 mb-4 d-none d-lg-block">
                <div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle"></div>
                <div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle"></div>
            </div>
        </div>
    </section>
    @endif
    <!--Best Sellers end-->

    <!--Testimonial start-->
    <div class="py-lg-10 bg-dark px-3 py-6">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="swiper-container swiper swiper-pagination-light pb-8 pb-lg-0" id="swiper-6"
                        data-pagination-type="" data-speed="800" data-space-between="100" data-pagination="true"
                        data-navigation="true" data-autoplay="true" data-effect="slide" data-autoplay-delay="3000"
                        data-breakpoints='{"480": {"slidesPerView": 2}, "768": {"slidesPerView": 1}, "1024": {"slidesPerView": 1}}'>
                        <div class="swiper-wrapper pb-lg-10">
                            <div class="swiper-slide">
                                <div class="text-center">
                                    <p class="text-white fs-2">"Incredibly fast delivery and the gaming laptop I ordered exceeded all my expectations. The screen quality and performance are absolutely top-notch."</p>
                                    <div class="mt-6">
                                        <img src="{{ asset('client/images/avatar/avatar-13.jpg') }}" alt="Alex M."
                                            class="avatar avatar-md rounded-circle mb-2" />
                                        <p class="mb-0 lh-1 text-white">Alex M.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="text-center">
                                    <p class="text-white fs-2">"I needed a reliable business laptop and this store had exactly what I was looking for. Great pricing and excellent after-sales support."</p>
                                    <div class="mt-6">
                                        <img src="{{ asset('client/images/avatar/avatar-14.jpg') }}" alt="Sarah K."
                                            class="avatar avatar-md rounded-circle mb-2" />
                                        <p class="mb-0 lh-1 text-white">Sarah K.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="text-center">
                                    <p class="text-white fs-2">"The ultrabook I bought is whisper-quiet and incredibly light. Perfect for travel. Highly recommend this store to anyone looking for quality."</p>
                                    <div class="mt-6">
                                        <img src="{{ asset('client/images/avatar/avatar-15.jpg') }}" alt="James R."
                                            class="avatar avatar-md rounded-circle mb-2" />
                                        <p class="mb-0 lh-1 text-white">James R.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination mb-3"></div>
                        <div class="swiper-navigation position-absolute start-50 bottom-0 mb-4">
                            <div class="swiper-button-next btn btn-icon btn-sm btn-outline-white rounded-circle ms-8"></div>
                            <div class="swiper-button-prev btn btn-icon btn-sm btn-outline-white rounded-circle me-8"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Testimonial end-->

    <!--Blog start-->
    <section class="py-lg-10 py-6">
        <div class="container">
            <div class="row mb-md-8 mb-4">
                <div class="col-lg-12">
                    <div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
                        <div class="col-sm-7">
                            <h2 class="mb-0">Read our stories</h2>
                        </div>
                        <div class="col-auto">
                            <a href="#!" class="d-flex align-items-center gap-2 btn-dark-link">
                                <span class="text-link">View all Stories</span>
                                <span class="btn btn-outline-primary btn-icon btn-xxs rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
                                        class="bi bi-chevron-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <article>
                        <a href="#!" class="position-relative d-flex">
                            <figure class="img-hover mb-0">
                                <img src="{{ asset('client/images/blog/blog-img-1.jpg') }}" alt="blog image" class="img-fluid" />
                            </figure>
                            <div class="position-absolute bottom-0 p-3">
                                <span class="badge text-bg-info">Gaming</span>
                            </div>
                        </a>
                        <div class="mt-4">
                            <h3 class="fs-5"><a href="#!" class="text-inherit">Best Gaming Laptops of 2025</a></h3>
                            <p>Discover the top-performing gaming laptops this year, from budget beasts to flagship powerhouses with RTX 4090 graphics and high-refresh-rate displays.</p>
                            <p class="d-flex gap-3 align-items-center">
                                <span class="d-flex align-items-center gap-1 small">Jun 29, 2025</span>
                                <span class="d-flex align-items-center gap-1 small">1 Comment</span>
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4 col-md-6">
                    <article>
                        <a href="#!" class="position-relative d-flex">
                            <figure class="img-hover mb-0">
                                <img src="{{ asset('client/images/blog/blog-img-2.jpg') }}" alt="blog image" class="img-fluid" />
                            </figure>
                            <div class="position-absolute bottom-0 p-3">
                                <span class="badge text-bg-warning">Buying Guide</span>
                            </div>
                        </a>
                        <div class="mt-4">
                            <h3 class="fs-5"><a href="#!" class="text-inherit">How to Choose the Right Business Laptop</a></h3>
                            <p>Processor speed, battery life, security features — we break down exactly what matters most for professionals on the move.</p>
                            <p class="d-flex gap-3 align-items-center">
                                <span class="d-flex align-items-center gap-1 small">Jun 29, 2025</span>
                                <span class="d-flex align-items-center gap-1 small">1 Comment</span>
                            </p>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4 col-md-6">
                    <article>
                        <a href="#!" class="position-relative d-flex">
                            <figure class="img-hover mb-0">
                                <img src="{{ asset('client/images/blog/blog-img-3.jpg') }}" alt="blog image" class="img-fluid" />
                            </figure>
                            <div class="position-absolute bottom-0 p-3">
                                <span class="badge text-bg-success">Tips & Tricks</span>
                            </div>
                        </a>
                        <div class="mt-4">
                            <h3 class="fs-5"><a href="#!" class="text-inherit">Laptop Maintenance Tips to Extend Battery Life</a></h3>
                            <p>Simple habits that keep your laptop running fast and your battery healthy for years to come — no technical expertise required.</p>
                            <p class="d-flex gap-3 align-items-center">
                                <span class="d-flex align-items-center gap-1 small">Jun 29, 2025</span>
                                <span class="d-flex align-items-center gap-1 small">1 Comment</span>
                            </p>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
    <!--Blog end-->

    <!--Feature start-->
    <section class="border-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-12 border-end">
                    <div class="text-center py-md-6 px-md-4 py-5">
                        <div class="mb-3">
                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.2" d="M16 16.1362V29C15.832 28.9993 15.667 28.9563 15.52 28.875L4.52 22.8525C4.36293 22.7665 4.23181 22.64 4.14035 22.4861C4.04888 22.3322 4.00041 22.1565 4 21.9775V10.0225C4.0004 9.88241 4.03021 9.74401 4.0875 9.61621L16 16.1362Z" fill="#CA8A04" />
                                <path d="M27.96 8.26877L16.96 2.25002C16.6661 2.08763 16.3358 2.00244 16 2.00244C15.6642 2.00244 15.3339 2.08763 15.04 2.25002L4.04 8.27127C3.72586 8.44315 3.46363 8.69622 3.28069 9.00405C3.09775 9.31188 3.00081 9.66319 3 10.0213V21.9763C3.00081 22.3344 3.09775 22.6857 3.28069 22.9935C3.46363 23.3013 3.72586 23.5544 4.04 23.7263L15.04 29.7475C15.3339 29.9099 15.6642 29.9951 16 29.9951C16.3358 29.9951 16.6661 29.9099 16.96 29.7475L27.96 23.7263C28.2741 23.5544 28.5364 23.3013 28.7193 22.9935C28.9023 22.6857 28.9992 22.3344 29 21.9763V10.0225C28.9999 9.6638 28.9032 9.31172 28.7203 9.00317C28.5373 8.69462 28.2747 8.44096 27.96 8.26877ZM16 4.00002L26.0425 9.50002L22.3213 11.5375L12.2775 6.03752L16 4.00002ZM16 15L5.9575 9.50002L10.195 7.18002L20.2375 12.68L16 15ZM5 11.25L15 16.7225V27.4463L5 21.9775V11.25ZM27 21.9725L17 27.4463V16.7275L21 14.5388V19C21 19.2652 21.1054 19.5196 21.2929 19.7071C21.4804 19.8947 21.7348 20 22 20C22.2652 20 22.5196 19.8947 22.7071 19.7071C22.8946 19.5196 23 19.2652 23 19V13.4438L27 11.25V21.9713V21.9725Z" fill="#CA8A04" />
                            </svg>
                        </div>
                        <h3 class="fs-5">Free shipping</h3>
                        <p class="mb-0">Get free shipping on orders of <span class="fw-semibold text-dark">$100</span> or more</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 border-end">
                    <div class="text-center py-md-6 px-md-4 py-5">
                        <div class="mb-3">
                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.2" d="M28.4925 21.76C28.2983 23.2113 27.5836 24.5427 26.4813 25.5065C25.3791 26.4704 23.9642 27.0011 22.5 27C17.9913 27 13.6673 25.2089 10.4792 22.0208C7.29107 18.8327 5.5 14.5087 5.5 9.99997C5.49888 8.53573 6.0296 7.12091 6.99345 6.01864C7.95731 4.91637 9.28869 4.20167 10.74 4.00747C10.9545 3.98199 11.1716 4.02666 11.3586 4.13482C11.5456 4.24299 11.6926 4.40881 11.7775 4.60747L14.4188 10.5075C14.4836 10.659 14.5101 10.8242 14.4957 10.9885C14.4813 11.1527 14.4265 11.3108 14.3363 11.4487L11.665 14.625C11.5702 14.768 11.5142 14.9331 11.5024 15.1042C11.4906 15.2753 11.5233 15.4466 11.5975 15.6012C12.6313 17.7175 14.8188 19.8787 16.9413 20.9025C17.0967 20.9763 17.2688 21.0084 17.4404 20.9954C17.612 20.9825 17.7773 20.925 17.92 20.8287L21.045 18.1662C21.1835 18.0741 21.3428 18.0179 21.5084 18.0029C21.6741 17.9878 21.8409 18.0143 21.9938 18.08L27.8888 20.7212C28.0883 20.8056 28.2551 20.9525 28.364 21.1398C28.4729 21.3272 28.518 21.5448 28.4925 21.76Z" fill="#CA8A04" />
                                <path d="M22.5 26.0002C18.258 25.9956 14.191 24.3084 11.1914 21.3088C8.19184 18.3092 6.50464 14.2423 6.50001 10.0002C6.49531 8.7796 6.93507 7.59898 7.73718 6.67887C8.53929 5.75876 9.64889 5.16207 10.8588 5.00024L13.4838 10.8902L10.9 13.9827C10.6407 14.3676 10.5303 14.7 10.5084 15.0438C10.4865 15.3876 10.5538 15.7313 10.7038 16.0415C11.8363 18.3577 14.17 20.674 16.5113 21.8052C16.8237 21.9538 17.1694 22.0188 17.5144 21.9938C17.8595 21.9688 18.1922 21.8547 18.48 21.6627L21.6113 19.0002L27.4863 21.6327C27.3399 22.8441 26.744 23.9556 25.8237 24.7595C24.9035 25.5633 23.7219 26.0044 22.5 26.0002ZM18.5 9.00024C18.5 8.73502 18.6054 8.48066 18.7929 8.29313C18.9804 8.10559 19.2348 8.00024 19.5 8.00024H22.5V5.00024C22.5 4.73502 22.6054 4.48066 22.7929 4.29313C22.9804 4.10559 23.2348 4.00024 23.5 4.00024C23.7652 4.00024 24.0196 4.10559 24.2071 4.29313C24.3947 4.48066 24.5 4.73502 24.5 5.00024V8.00024H27.5C27.7652 8.00024 28.0196 8.10559 28.2071 8.29313C28.3947 8.48066 28.5 8.73502 28.5 9.00024C28.5 9.26545 28.3947 9.51981 28.2071 9.70734C28.0196 9.89488 27.7652 10.0002 27.5 10.0002H24.5V13.0002C24.5 13.2655 24.3947 13.5198 24.2071 13.7073C24.0196 13.8949 23.7652 14.0002 23.5 14.0002C23.2348 14.0002 22.9804 13.8949 22.7929 13.7073C22.6054 13.5198 22.5 13.2655 22.5 13.0002V10.0002H19.5C19.2348 10.0002 18.9804 9.89488 18.7929 9.70734C18.6054 9.51981 18.5 9.26545 18.5 9.00024Z" fill="#CA8A04" />
                            </svg>
                        </div>
                        <h3 class="fs-5">Customer service</h3>
                        <p class="mb-0">A question? Please contact us at <span class="fw-semibold text-dark">{{ setting('site_phone_1', '123-456-7890') }}</span></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12 border-end">
                    <div class="text-center py-md-6 px-md-4 py-5">
                        <div class="mb-3">
                            <svg width="33" height="32" viewBox="0 0 33 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.2" d="M30.2075 19.125L19.625 29.7075C19.4375 29.8949 19.1832 30.0002 18.9181 30.0002C18.653 30.0002 18.3988 29.8949 18.2113 29.7075L5.7925 17.2925C5.60532 17.1051 5.50012 16.8511 5.5 16.5863V5H17.0863C17.3511 5.00012 17.6051 5.10532 17.7925 5.2925L30.2075 17.7075C30.3009 17.8004 30.3749 17.9109 30.4255 18.0325C30.476 18.1541 30.502 18.2845 30.502 18.4163C30.502 18.548 30.476 18.6784 30.4255 18.8C30.3749 18.9216 30.3009 19.0321 30.2075 19.125Z" fill="#CA8A04" />
                                <path d="M12.5 10.5C12.5 10.7967 12.412 11.0867 12.2472 11.3334C12.0824 11.58 11.8481 11.7723 11.574 11.8858C11.2999 11.9994 10.9983 12.0291 10.7074 11.9712C10.4164 11.9133 10.1491 11.7704 9.93935 11.5607C9.72957 11.3509 9.58671 11.0836 9.52883 10.7926C9.47095 10.5017 9.50066 10.2001 9.61419 9.92598C9.72772 9.6519 9.91998 9.41763 10.1667 9.25281C10.4133 9.08798 10.7033 9.00001 11 9.00001C11.3978 9.00001 11.7794 9.15805 12.0607 9.43935C12.342 9.72065 12.5 10.1022 12.5 10.5Z" fill="#CA8A04" />
                            </svg>
                        </div>
                        <h3 class="fs-5">Refer a friend</h3>
                        <p class="mb-0">Refer a friend and get 15% off each other</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="text-center py-md-6 px-md-4 py-5">
                        <div class="mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="33" height="32" viewBox="0 0 24 24" fill="none" stroke="#CA8A04" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect>
                                <line x1="1" y1="10" x2="23" y2="10"></line>
                            </svg>
                        </div>
                        <h3 class="fs-5">Secure payment</h3>
                        <p class="mb-0">We accept all major credit and debit cards</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Feature end-->

@endsection

@push('scripts')
    <script src="{{ asset('client/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('client/js/theme.min.js') }}"></script>
@endpush
