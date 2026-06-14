@extends('client.layouts.master')
@section('title', 'About - ' . setting('site_name', 'E-commerce'))
@section('content')
    <!--page header start here-->
    <div class="mg-page-header-section2 mg-page-header-style">
        <div class="mg-page-header-inner">
            <div class="container">
                <div class="mg-page-header-text">
                    <div class="mg-page-header-heading">
                        <h3>About {{ setting('site_name', 'E-commerce') }}</h3>
                    </div>
                    <div class="mg-breadcrumb">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">About</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page header end here-->
    <!--about us with image section start here-->
    <div class="mg-about-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="mg-about-image">
                        <img src="{{ asset('client/images/gallery/about-image.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                    <div class="mg-about-text-outer">
                        <div class="mg-about-text-inner">
                            <span>{{ setting('about_story_heading') }}</span>
                            <h5>{{ setting('about_story_sub_heading') }}</h5>
                            <p>
                                {{ setting('about_story_body') }}
                            </p>
                            <a class="mg-shop-btn btn btn-default" href="{{ route('products.index') }}">SHOP NOW <i
                                    class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 mt-md-3 mt-lg-0 mt-sm-3 mt-5">
                    <div class="row">
                        <div class="col-lg-12 col-md-6 col-sm-6 col-6">
                            <div class="mg-about-small-image1">
                                <img src="{{ asset('client/images/gallery/about-small-image.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-6 col-sm-6 col-6">
                            <div class="mg-about-small-image2">
                                <img src="{{ asset('client/images/gallery/about-small-image2.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--about us with image section end here-->
    <section class="py-lg-8 py-5">
        <div class="container">
            <div class="row g-4">
                <!--Counter-->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0" style="background: #cfedfb">
                        <div class="card-body p-5 d-flex flex-column gap-lg-10 gap-6">
                            <div class="">
                                <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 14L12.82 5.18C13.1921 4.80566 13.6346 4.50868 14.1221 4.30616C14.6095 4.10363 15.1322 3.99958 15.66 4H32.34C32.8678 3.99958 33.3905 4.10363 33.8779 4.30616C34.3654 4.50868 34.8079 4.80566 35.18 5.18L44 14"
                                        stroke="#082F49" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path
                                        d="M8 24V40C8 41.0609 8.42143 42.0783 9.17157 42.8284C9.92172 43.5786 10.9391 44 12 44H36C37.0609 44 38.0783 43.5786 38.8284 42.8284C39.5786 42.0783 40 41.0609 40 40V24"
                                        stroke="#082F49" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path
                                        d="M30 44V36C30 34.9391 29.5786 33.9217 28.8284 33.1716C28.0783 32.4214 27.0609 32 26 32H22C20.9391 32 19.9217 32.4214 19.1716 33.1716C18.4214 33.9217 18 34.9391 18 36V44"
                                        stroke="#082F49" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path d="M4 14H44" stroke="#082F49" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M44 14V20C44 21.0609 43.5786 22.0783 42.8284 22.8284C42.0783 23.5786 41.0609 24 40 24C38.8315 23.9357 37.7155 23.4935 36.82 22.74C36.5814 22.5675 36.2944 22.4747 36 22.4747C35.7056 22.4747 35.4186 22.5675 35.18 22.74C34.2845 23.4935 33.1685 23.9357 32 24C30.8315 23.9357 29.7155 23.4935 28.82 22.74C28.5814 22.5675 28.2944 22.4747 28 22.4747C27.7056 22.4747 27.4186 22.5675 27.18 22.74C26.2845 23.4935 25.1685 23.9357 24 24C22.8315 23.9357 21.7155 23.4935 20.82 22.74C20.5814 22.5675 20.2944 22.4747 20 22.4747C19.7056 22.4747 19.4186 22.5675 19.18 22.74C18.2845 23.4935 17.1685 23.9357 16 24C14.8315 23.9357 13.7155 23.4935 12.82 22.74C12.5814 22.5675 12.2944 22.4747 12 22.4747C11.7056 22.4747 11.4186 22.5675 11.18 22.74C10.2845 23.4935 9.16853 23.9357 8 24C6.93913 24 5.92172 23.5786 5.17157 22.8284C4.42143 22.0783 4 21.0609 4 20V14"
                                        stroke="#082F49" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="fs-1 fw-bold">{{ setting('about_stat_1_number', '10 Years') }}</h3>
                                <p class="mb-0 fs-5 fw-medium">{{ setting('about_stat_1_label', 'Experiences') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Counter-->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0" style="background: #fbf0ce">
                        <div class="card-body p-5 d-flex flex-column gap-lg-10 gap-6">
                            <div class="">
                                <svg width="48" height="48" viewBox="0 0 41 40" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20.7487 36.6667C29.9534 36.6667 37.4154 29.2048 37.4154 20C37.4154 10.7953 29.9534 3.33337 20.7487 3.33337C11.544 3.33337 4.08203 10.7953 4.08203 20C4.08203 29.2048 11.544 36.6667 20.7487 36.6667Z"
                                        stroke="#422006" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path
                                        d="M14.082 23.3334C14.082 23.3334 16.582 26.6667 20.7487 26.6667C24.9154 26.6667 27.4154 23.3334 27.4154 23.3334"
                                        stroke="#422006" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    </path>
                                    <path d="M15.75 15H15.7667" stroke="#422006" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M25.75 15H25.7667" stroke="#422006" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="fs-1 fw-bold">{{ setting('about_stat_2_number', '20K') }}</h3>
                                <p class="mb-0 fs-5 fw-medium">{{ setting('about_stat_2_label', 'Happy Customers') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Counter-->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0" style="background: #d0eddb">
                        <div class="card-body p-5 d-flex flex-column gap-lg-10 gap-6">
                            <div class="">
                                <svg width="48" height="48" viewBox="0 0 49 48" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M28.5 36V12C28.5 10.9391 28.0786 9.92172 27.3284 9.17157C26.5783 8.42143 25.5609 8 24.5 8H8.5C7.43913 8 6.42172 8.42143 5.67157 9.17157C4.92143 9.92172 4.5 10.9391 4.5 12V34C4.5 34.5304 4.71071 35.0391 5.08579 35.4142C5.46086 35.7893 5.96957 36 6.5 36H10.5"
                                        stroke="#052E16" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M30.5 36H18.5" stroke="#052E16" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M38.5 36H42.5C43.0304 36 43.5391 35.7893 43.9142 35.4142C44.2893 35.0391 44.5 34.5304 44.5 34V26.7C44.4992 26.2461 44.344 25.806 44.06 25.452L37.1 16.752C36.9129 16.5178 36.6756 16.3286 36.4056 16.1984C36.1356 16.0682 35.8398 16.0004 35.54 16H28.5"
                                        stroke="#052E16" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M34.5 40C36.7091 40 38.5 38.2091 38.5 36C38.5 33.7909 36.7091 32 34.5 32C32.2909 32 30.5 33.7909 30.5 36C30.5 38.2091 32.2909 40 34.5 40Z"
                                        stroke="#052E16" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M14.5 40C16.7091 40 18.5 38.2091 18.5 36C18.5 33.7909 16.7091 32 14.5 32C12.2909 32 10.5 33.7909 10.5 36C10.5 38.2091 12.2909 40 14.5 40Z"
                                        stroke="#052E16" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="fs-1 fw-bold">{{ setting('about_stat_3_number', '100+') }}</h3>
                                <p class="mb-0 fs-5 fw-medium">{{ setting('about_stat_3_label', 'Monthly Deliveries') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Counter-->
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="card border-0" style="background: #f8d4d4">
                        <div class="card-body p-5 d-flex flex-column gap-lg-10 gap-6">
                            <div class="">
                                <svg width="48" height="48" viewBox="0 0 49 48" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M43.33 30H34.25C33.1891 30 32.1717 30.4214 31.4216 31.1716C30.6714 31.9217 30.25 32.9391 30.25 34V43.08"
                                        stroke="#450A0A" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M14.25 6.68005V10.0001C14.25 11.5914 14.8821 13.1175 16.0074 14.2427C17.1326 15.3679 18.6587 16.0001 20.25 16.0001C21.3109 16.0001 22.3283 16.4215 23.0784 17.1716C23.8286 17.9218 24.25 18.9392 24.25 20.0001C24.25 22.2001 26.05 24.0001 28.25 24.0001C29.3109 24.0001 30.3283 23.5786 31.0784 22.8285C31.8286 22.0783 32.25 21.0609 32.25 20.0001C32.25 17.8001 34.05 16.0001 36.25 16.0001H42.59"
                                        stroke="#450A0A" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M22.2516 43.9V36C22.2516 34.9391 21.8301 33.9217 21.08 33.1716C20.3298 32.4214 19.3124 32 18.2516 32C17.1907 32 16.1733 31.5786 15.4231 30.8284C14.673 30.0783 14.2516 29.0609 14.2516 28V26C14.2516 24.9391 13.8301 23.9217 13.08 23.1716C12.3298 22.4214 11.3124 22 10.2516 22H4.35156"
                                        stroke="#450A0A" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M24.25 44C35.2957 44 44.25 35.0457 44.25 24C44.25 12.9543 35.2957 4 24.25 4C13.2043 4 4.25 12.9543 4.25 24C4.25 35.0457 13.2043 44 24.25 44Z"
                                        stroke="#450A0A" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="fs-1 fw-bold">{{ setting('about_stat_4_number', '20+') }}</h3>
                                <p class="mb-0 fs-5 fw-medium">{{ setting('about_stat_4_label', 'Country') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--our team section start here-->
    <section class="mg-testimonial-section">
        <div class="container pb-lg-8">
            <div class="row align-items-center">
                <!--heading-->
                <div class="col-lg-12">
                    <h2 class="fs-1 text-white mb-4">{{ setting('about_what_we_offer_heading', 'What We Offer') }}</h2>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                <p class="lead text-white">{{ setting('about_what_we_offer_body', 'We offer a wide range of quality products that blend modern trends with classic elegance. Each piece is carefully curated to ensure it meets our standards of quality, durability, and style.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--our team section end here-->
    <!--Testimonial section start here-->
    <div class="mg-testimonial-section my-5">
        <div class="mg-section-heading text-center">
            <span>TESTIMONIAL</span>
            <h5>what our Customers Says</h5>
        </div>
        <div class="container">
                        <div class="mg-testimonial-carousel">
                <div class="mg-testimonial-content">
                    <div class="mg-testimonial-image">
                        <img src="{{ asset('client/images/icons/comma.png') }}" alt="">
                    </div>
                    <div class="mg-testimonial-text text-center">
                        <p>
                            Excellent service! The delivery was on time and the packaging was secure.
                            I’m very happy with the quality. Highly recommended.
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/avatar/avatar-4.jpg') }}"
                                alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Maaz Akram</span>
                        </div>
                    </div>
                </div>
                <div class="mg-testimonial-content">
                    <div class="mg-testimonial-image">
                        <img src="{{ asset('client/images/icons/comma.png') }}" alt="">
                    </div>
                    <div class="mg-testimonial-text text-center">
                        <p>
                            Great experience from checkout to delivery. The customer support team was
                            responsive and solved my query quickly.
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/avatar/avatar-4.jpg') }}"
                                alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Qasim Adil</span>
                        </div>
                    </div>
                </div>
                <div class="mg-testimonial-content">
                    <div class="mg-testimonial-image">
                        <img src="{{ asset('client/images/icons/comma.png') }}" alt="">
                    </div>
                    <div class="mg-testimonial-text text-center">
                        <p>
                            The product quality is top-notch and looks even better in person.
                            Delivery was smooth and the return policy is reassuring.
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/avatar/avatar-4.jpg') }}"
                                alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Ahmad Ali</span>
                        </div>
                    </div>
                </div>
                <div class="mg-testimonial-content">
                    <div class="mg-testimonial-image">
                        <img src="{{ asset('client/images/icons/comma.png') }}" alt="">
                    </div>
                    <div class="mg-testimonial-text text-center">
                        <p>
                            Secure checkout and fast delivery—everything went perfectly.
                            Packaging protected the item well and everything arrived in great condition.
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/avatar/avatar-4.jpg') }}"
                                alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Asghar Sajjad</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Testimonial section end here-->
    <!--social media section start here-->
    <div class="mg-social-media-section mg-padding-lr">
        <div class="container">
            <div class="mg-section-heading text-center mb-4">
                <h5>Follow us on Instagram</h5>
                <p class="mb-3 text-muted">Stay connected with our latest projects and behind-the-scenes updates.</p>
                <div class="mg-social-media-icon d-flex justify-content-center align-items-center flex-wrap gap-3">
                    @if(setting('site_facebook'))
                    <a href="{{ setting('site_facebook') }}" target="_blank" class="d-flex justify-content-center align-items-center rounded-circle border border-light bg-white p-3 shadow-sm" style="width:64px;height:64px;font-size:20px;text-decoration:none;">
                        <i class="fab fa-facebook-f" style="color:#1877F2;"></i>
                    </a>
                    @endif
                    @if(setting('site_instagram'))
                    <a href="{{ setting('site_instagram') }}" target="_blank" class="d-flex justify-content-center align-items-center rounded-circle border border-light bg-white p-3 shadow-sm" style="width:64px;height:64px;font-size:20px;text-decoration:none;">
                        <i class="fab fa-instagram" style="color:#C13584;"></i>
                    </a>
                    @endif
                    @if(setting('site_linkedin'))
                    <a href="{{ setting('site_linkedin') }}" target="_blank" class="d-flex justify-content-center align-items-center rounded-circle border border-light bg-white p-3 shadow-sm" style="width:64px;height:64px;font-size:20px;text-decoration:none;">
                        <i class="fab fa-linkedin-in" style="color:#0077B5;"></i>
                    </a>
                    @endif
                    @if(setting('site_twitter'))
                    <a href="{{ setting('site_twitter') }}" target="_blank" class="d-flex justify-content-center align-items-center rounded-circle border border-light bg-white p-3 shadow-sm" style="width:64px;height:64px;font-size:20px;text-decoration:none;">
                        <i class="fab fa-twitter" style="color:#1DA1F2;"></i>
                    </a>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-6 mt-4">
                    <div class="mg-social-media-thumb">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('client/images/gallery/social-thumbs-5.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-6 mt-4">
                    <div class="mg-social-media-thumb">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('client/images/gallery/social-thumbs-4.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-6 mt-4">
                    <div class="mg-social-media-thumb">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('client/images/gallery/social-thumbs-3.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-6 mt-4">
                    <div class="mg-social-media-thumb">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('client/images/gallery/social-thumbs-2.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-6 mt-4">
                    <div class="mg-social-media-thumb">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('client/images/gallery/social-thumbs-1.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-6 mt-4">
                    <div class="mg-social-media-thumb">
                        <a href="javascript:void(0);">
                            <img src="{{ asset('client/images/gallery/social-thumbs-6.jpg') }}" alt="">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--social media section end here-->
    <!--Feature section 2 start here-->
    <div class="mg-feature-section-style2 mg-padding-lr">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 col-sm-6 mt-4 mg-feature-service">
                    <div class="mg-feature-box">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('client/images/icons/Icon-material-payment.svg') }}" alt="">
                                <h6 class="card-title">{{ setting('about_feature_nation_wide_delivery', 'Nationwide Delivery') }}</h6>
                                <p class="card-text">{{ setting('about_feature_nation_wide_delivery_text', 'Fast and reliable delivery to your doorstep. Track your order and enjoy safe, secure packaging for every purchase.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 mt-4 mg-feature-service">
                    <div class="mg-feature-box">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('client/images/icons/Icon-feather-shopping-bag.svg') }}" alt="">
                                <h6 class="card-title">{{ setting('about_feature_nation_help_center', '24/7 Help Center') }}</h6>
                                <p class="card-text">{{ setting('about_feature_nation_help_center_text', 'Need assistance? Our team is here for you 24/7 with order support, product questions, and fast resolutions.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 mt-4 mg-feature-service">
                    <div class="mg-feature-box">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('client/images/icons/delivery-truck.svg') }}" alt="">
                                <h6 class="card-title">{{ setting('about_feature_nation_secure_checkout', 'Secure Checkout') }}</h6>
                                <p class="card-text">{{ setting('about_feature_nation_secure_checkout_text', 'Shop with confidence using secure payments and encrypted checkout. Your information stays protected at every step.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 mt-4 mg-feature-service">
                    <div class="mg-feature-box">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('client/images/icons/Icon-ionic-ios-timer.svg') }}" alt="">
                                <h6 class="card-title">{{ setting('about_feature_nation_return', '30 Days Return') }}</h6>
                                <p class="card-text">{{ setting('about_feature_nation_return_text', 'Changed your mind? Enjoy a hassle-free 30-day return policy. Return eligible items in simple steps and get support quickly.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Feature section 2 end here-->
@endsection
@push('scripts')
    <script src="{{ asset('client/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('client/libs/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('client/js/about-us.js') }}"></script>
@endpush
