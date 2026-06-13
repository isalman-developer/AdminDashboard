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
            <div class="mg-slide d-flex align-items-center" style="background-image: url({{ Storage::url($item->image_path) }});">
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


    <!--New arrival start-->
	<section class="py-lg-10 pt-6 mx-3 mx-lg-0">
		<div class="container">
			<div class="row mb-md-8 mb-4">
				<div class="col-lg-12">
					<div class="d-flex flex-column flex-md-row align-items-md-end justify-content-md-between gap-4">
						<!--Heading-->
						<div class="col-sm-7">
							<h2>New arrivals</h2>
							<p class="mb-0">We are inspired by the realities of life today, in which traditional divides
								between
								personal and professional space are more fluid.</p>
						</div>
						<div class="col-auto">
							<a href="#!" class="d-flex align-items-center gap-2 btn-dark-link">
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
				<div class="swiper-slide">
					<div class="product-card">
						<div class=" text-center product-card-img mb-4">
							<a href="#!"><img src="{{ asset('client/images/products/home2-product-img1.jpg') }}" alt="product image"
									class="img-fluid">
								<img src="{{ asset('client/images/products/home2-product-img3.jpg') }}" alt="product image"
									class="img-fluid product-img-hover"></a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary  btn-sm quick-add-btn"
									data-product-name="Sofa with wood legs" data-product-price="34.00"
									data-product-img="assets/images/product/product-img-1.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
									</svg>
									Quick add
								</button>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.3
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"> <a href="#!">Sofa with
									wood
									legs</a></h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">$34.00</p>
						</div>

						<div role="group" aria-label="Basic radio toggle button group">
							<input type="radio" class="btn-check" name="btnradio" id="btnradio1">
							<label class="btn-color-swatch bg-primary" for="btnradio1"></label>

							<input type="radio" class="btn-check" name="btnradio" id="btnradio2">
							<label class="btn-color-swatch bg-success" for="btnradio2"></label>

							<input type="radio" class="btn-check" name="btnradio" id="btnradio3" checked>
							<label class="btn-color-swatch bg-danger" for="btnradio3"></label>
							<input type="radio" class="btn-check" name="btnradio" id="btnradio4">
							<label class="btn-color-swatch bg-info" for="btnradio4"></label>
						</div>
					</div>
				</div>
				<div class="swiper-slide mb-5">
					<div class="product-card">
						<div class="text-center mb-4 product-card-img">
							<a href="#!">
								<img src="assets/images/product/product-img-2.jpg" alt="product image"
									class="img-fluid" />
								<img src="assets/images/product/product-img-hover-2.jpg" alt="product image"
									class="img-fluid product-img-hover" />
							</a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary btn-sm quick-add-btn"
									data-product-name="Floor Lamp" data-product-price="95.00"
									data-product-img="assets/images/product/product-img-2.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
									</svg>
									Quick add
								</button>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.2
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Floor
									Lamp</a></h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">$95.00</p>
						</div>
						<div>
							<input type="radio" class="btn-check" name="btnradio2" id="btnradio5" checked />
							<label class="btn-color-swatch bg-primary" for="btnradio5"></label>

							<input type="radio" class="btn-check" name="btnradio2" id="btnradio6" />
							<label class="btn-color-swatch bg-success" for="btnradio6"></label>
						</div>
					</div>
				</div>
				<div class="swiper-slide mb-5">
					<div class="product-card">
						<div class="text-center mb-4 product-card-img">
							<a href="#!">
								<img src="assets/images/product/product-img-3.jpg" alt="product image"
									class="img-fluid" />
								<img src="assets/images/product/product-img-hover-3.jpg" alt="product image"
									class="img-fluid product-img-hover" />
							</a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary  btn-sm quick-add-btn"
									data-product-name="Comfort Seat Chair" data-product-price="78.00"
									data-product-img="assets/images/product/product-img-3.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
									</svg>
									Quick add
								</button>
							</div>
							<div class="position-absolute top-0 p-2 px-3">
								<span class="badge bg-info">New</span>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.3
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Comfort Seat
									Chair</a></h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">$78.00</p>
						</div>
						<div>
							<input type="radio" class="btn-check" name="btnradio3" id="btnradio9" checked>
							<label class="btn-color-swatch bg-primary" for="btnradio9"></label>
						</div>
					</div>
				</div>
				<div class="swiper-slide mb-5">
					<div class="product-card">
						<div class="text-center mb-4 product-card-img">
							<a href="#!"><img src="assets/images/product/product-img-4.jpg" alt="product image"
									class="img-fluid" />
								<img src="assets/images/product/product-img-hover-4.jpg" alt="product image"
									class="img-fluid product-img-hover" /></a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary  btn-sm quick-add-btn"
									data-product-name="Armchair" data-product-price="75.00"
									data-product-img="assets/images/product/product-img-4.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
									</svg>
									Quick add
								</button>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.5
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Armchair</a>
							</h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">
								<span class="text-danger">$75.00</span>
								<span class="text-decoration-line-through">$95.00</span>
							</p>
						</div>
						<div>
							<input type="radio" class="btn-check" name="btnradio4" id="btnradio13" checked />
							<label class="btn-color-swatch bg-primary" for="btnradio13"></label>

							<input type="radio" class="btn-check" name="btnradio4" id="btnradio14" />
							<label class="btn-color-swatch bg-success" for="btnradio14"></label>

							<input type="radio" class="btn-check" name="btnradio4" id="btnradio16" />
							<label class="btn-color-swatch bg-info" for="btnradio16"></label>
						</div>
					</div>
				</div>
				<div class="swiper-slide mb-5">
					<div class="product-card">
						<div class="text-center mb-4 product-card-img">
							<a href="#!">
								<img src="assets/images/product/product-img-5.jpg" alt="product image"
									class="img-fluid" />
								<img src="assets/images/product/product-img-hover-5.jpg" alt="product image"
									class="img-fluid product-img-hover" />
							</a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary  btn-sm quick-add-btn"
									data-product-name="High Back Boss Chair" data-product-price="55.00"
									data-product-img="assets/images/product/product-img-5.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
									</svg>
									Quick add
								</button>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.2
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">High
									Back Boss
									Chair</a></h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">
								<span>$55.00</span>
							</p>
						</div>
						<div>
							<input type="radio" class="btn-check" name="btnradio5" id="btnradio17" checked />
							<label class="btn-color-swatch bg-primary" for="btnradio17"></label>

							<input type="radio" class="btn-check" name="btnradio5" id="btnradio27" />
							<label class="btn-color-swatch bg-success" for="btnradio27"></label>
						</div>
					</div>
				</div>
				<div class="swiper-slide mb-5">
					<div class="product-card">
						<div class="text-center mb-4 product-card-img">
							<a href="#!"><img src="assets/images/product/product-img-6.jpg" alt="product image"
									class="img-fluid" />
								<img src="assets/images/product/product-img-hover-6.jpg" alt="product image"
									class="img-fluid product-img-hover" /></a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary btn-sm quick-add-btn"
									data-product-name="Fancy Metal Wall Clock" data-product-price="35.00"
									data-product-img="assets/images/product/product-img-6.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
									</svg>
									Quick add
								</button>
							</div>
							<div class="position-absolute top-0 p-2 px-3">
								<span class="badge bg-danger">On Sale</span>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.5
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">
									Fancy Metal Wall
									Clock
								</a></h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">
								<span class="text-danger">$35.00</span>
								<span class="text-decoration-line-through">$45.00</span>
							</p>
						</div>
						<div>
							<input type="radio" class="btn-check" name="btnradio6" id="btnradio21" checked />
							<label class="btn-color-swatch bg-primary" for="btnradio21"></label>

							<input type="radio" class="btn-check" name="btnradio6" id="btnradio22" />
							<label class="btn-color-swatch bg-success" for="btnradio22"></label>
						</div>
					</div>
				</div>
				<div class="swiper-slide mb-5">
					<div class="product-card">
						<div class="text-center mb-4 product-card-img">
							<a href="#!">
								<img src="assets/images/product/product-img-7.jpg" alt="product image"
									class="img-fluid" />
								<img src="assets/images/product/product-img-hover-7.jpg" alt="product image"
									class="img-fluid product-img-hover" />
							</a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary  btn-sm quick-add-btn"
									data-product-name="Modern metal frame stool" data-product-price="85.00"
									data-product-img="assets/images/product/product-img-7.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
									</svg>
									Quick add
								</button>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.5
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">Modern metal
									frame stool</a></h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">
								<span>$85.00</span>
							</p>
						</div>
						<div>
							<input type="radio" class="btn-check" name="btnradio7" id="btnradio18" checked />
							<label class="btn-color-swatch bg-success" for="btnradio18"></label>

							<input type="radio" class="btn-check" name="btnradio7" id="btnradio19" />
							<label class="btn-color-swatch bg-danger" for="btnradio19"></label>
							<input type="radio" class="btn-check" name="btnradio7" id="btnradio20" />
							<label class="btn-color-swatch bg-info" for="btnradio20"></label>
						</div>
					</div>
				</div>
				<div class="swiper-slide mb-5">
					<div class="product-card">
						<div class="text-center mb-4 product-card-img">
							<a href="#!">
								<img src="assets/images/product/product-img-9.jpg" alt="product image"
									class="img-fluid" />
								<img src="assets/images/product/product-img-hover-9.jpg" alt="product image"
									class="img-fluid product-img-hover" />
							</a>
							<div class="product-card-btn">
								<button type="button" class="btn btn-primary btn-icon btn-sm animate-pulse "
									data-bs-toggle="modal" data-bs-target="#quickViewModal">

									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-eye animate-target" viewBox="0 0 16 16">
										<path
											d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
										<path
											d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
									</svg>
								</button>
								<button type="button" class="btn btn-primary btn-sm quick-add-btn"
									data-product-name="Divine Trends Table Lamp" data-product-price="70.00"
									data-product-img="assets/images/product/product-img-9.jpg">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
										class="bi bi-plus" viewBox="0 0 16 16">
										<path
											d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
									</svg>
									Quick add
								</button>
							</div>
						</div>
						<div class="d-flex justify-content-between align-items-center mb-2">
							<span class="small fw-medium text-uppercase">BRAND</span>
							<div class="d-flex gap-3 align-items-center">
								<span class="">
									4.5
									<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor"
										class="bi bi-star-fill align-baseline text-warning" viewBox="0 0 16 16">
										<path
											d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
									</svg>
								</span>
								<button type="button" class="btn btn-light bg-transparent border-0 p-0 animate-pulse">
									<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
										class="bi bi-heart animate-target" viewBox="0 0 16 16">
										<path
											d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
									</svg>
								</button>
							</div>
						</div>
						<div class="mb-3">
							<h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate"><a href="#!">
									Divine Trends
									Table Lamp
								</a></h3>
							<p class="mb-0 lh-1 text-dark fw-semibold">
								<span>$70.00</span>
							</p>
						</div>
						<div>
							<input type="radio" class="btn-check" name="btnradio8" id="btnradio23" checked />
							<label class="btn-color-swatch bg-primary" for="btnradio23"></label>

							<input type="radio" class="btn-check" name="btnradio8" id="btnradio24" />
							<label class="btn-color-swatch bg-success" for="btnradio24"></label>

							<input type="radio" class="btn-check" name="btnradio8" id="btnradio25" />
							<label class="btn-color-swatch bg-danger" for="btnradio25"></label>
						</div>
					</div>
				</div>

				<!-- Add more slides as needed -->
			</div>
			<!-- Add Pagination -->
			<div class="swiper-pagination top-100 mt-n4 start-lg-10 w-lg-75"></div>
			<!-- Add Navigation -->
			<div class="swiper-navigation position-absolute end-10 bottom-0 mb-4 d-none d-lg-block">
				<div class="swiper-button-next btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide2">
				</div>
				<div class="swiper-button-prev me-2 btn btn-icon btn-sm btn-outline-primary rounded-circle" id="slide1">
				</div>
			</div>
		</div>
	</section>
	<!--New arrival end-->


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
                        style="background-image: url('{{ Storage::url($item->image_path) }}');">
                        <div class='container mg-slider-text-box'>
                            <div class="mg-slide-text">
                                <span>{{ $item->title }}</span>
                                <h2>{{ $item->subtitle }}</h2>
                        <p>Power through work, creation, and play with premium laptops<br>engineered for speed, display quality, and all-day battery life.</p>
                                <div class="mg-price mb-3">Starting from <span>$1,000</span></div>
                                <a class="mg-shop-btn btn btn-default" href="{{ route('products.index') }}">SHOP NOW <i class="fa-solid fa-angle-right"></i></a>
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
