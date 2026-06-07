@extends('client.layouts.master')
@section('content')
    <!--page header start here-->
    <div class="mg-page-header-section2 mg-page-header-style">
        <div class="mg-page-header-inner">
            <div class="container">
                <div class="mg-page-header-text">
                    <div class="mg-page-header-heading">
                        <h3>About {{ config('siteSetting')[0]['name'] ?? 'E-commerce'}}</h3>
                    </div>
                    <div class="mg-breadcrumb">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="index-2.html">Home</a></li>
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
                            <span>ABOUT US</span>
                            <h5>Welcome to MG WIREZ Electronic Store</h5>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                                It has survived not only five centurie
                            </p>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                Lorem Ipsum has been the industry
                            </p>
                            <a class="mg-shop-btn btn btn-default" href="shop.html">SHOP NOW <i class="fa-solid fa-angle-right"></i></a>
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
    <!--video section start here-->
    <div class="mg-video-section">
        <div class="container">
            <div class="mg-video-bg-img">
                <div class="mg-video-play-btn">
                    <a class="mg-video-popup" href="https://www.youtube.com/watch?v=Zv11L-ZfrSg">
                        <img src="{{ asset('client/images/icons/video-play.png') }}" alt=""></a>
                </div>
                <div class="mg-video-img-overtext">
                    <h5>Found your Dream Electronic?</h5>
                    <p>
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                        Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                        when an unknown printer took a galley of type and scrambled.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!--video section end here-->
    <!--our team section start here-->
    <div class="mg-team-section">
        <div class="mg-section-heading text-center">
            <span>OUR TEAM</span>
            <h5>Meet Our Crew</h5>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="mg-our-team-box">
                        <div class="mg-team-image">
                            <img src="{{ asset('client/images/team-and-testimonial/team3.png') }}" alt="">
                            <div class="mg-team-info-box-inner">
                                <div class="mg-team-info">
                                    <h5>Garbriela Matthews</h5>
                                    <span>CHIEF ADMIN</span>
                                </div>
                                <div class="mg-team-social-link">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/fb.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/insta.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/linkedin.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/twitter.jpg') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="mg-our-team-box">
                        <div class="mg-team-image">
                            <img src="{{ asset('client/images/team-and-testimonial/team3.png') }}" alt="">
                            <div class="mg-team-info-box-inner">
                                <div class="mg-team-info">
                                    <h5>Garbriela Matthews</h5>
                                    <span>CHIEF ADMIN</span>
                                </div>
                                <div class="mg-team-social-link">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/fb.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/insta.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/linkedin.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/twitter.jpg') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="mg-our-team-box">
                        <div class="mg-team-image">
                            <img src="{{ asset('client/images/team-and-testimonial/team3.png') }}" alt="">
                            <div class="mg-team-info-box-inner">
                                <div class="mg-team-info">
                                    <h5>Garbriela Matthews</h5>
                                    <span>CHIEF ADMIN</span>
                                </div>
                                <div class="mg-team-social-link">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/fb.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/insta.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/linkedin.jpg') }}" alt=""></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);">
                                                <img src="{{ asset('client/images/icons/twitter.jpg') }}" alt=""></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--our team section end here-->
    <!--Testimonial section start here-->
    <div class="mg-testimonial-section">
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
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/team-and-testimonial/testimonial-img.jpg') }}" alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Carolina Martinez</span>
                        </div>
                    </div>
                </div>
                <div class="mg-testimonial-content">
                    <div class="mg-testimonial-image">
                        <img src="{{ asset('client/images/icons/comma.png') }}" alt="">
                    </div>
                    <div class="mg-testimonial-text text-center">
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/team-and-testimonial/testimonial-img.jpg') }}" alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Carolina Martinez</span>
                        </div>
                    </div>
                </div>
                <div class="mg-testimonial-content">
                    <div class="mg-testimonial-image">
                        <img src="{{ asset('client/images/icons/comma.png') }}" alt="">
                    </div>
                    <div class="mg-testimonial-text text-center">
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/team-and-testimonial/testimonial-img.jpg') }}" alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Carolina Martinez</span>
                        </div>
                    </div>
                </div>
                <div class="mg-testimonial-content">
                    <div class="mg-testimonial-image">
                        <img src="{{ asset('client/images/icons/comma.png') }}" alt="">
                    </div>
                    <div class="mg-testimonial-text text-center">
                        <p>
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                        </p>
                    </div>
                    <div class="mg-customer-info">
                        <div class="mg-customer-img">
                            <img src="{{ asset('client/images/team-and-testimonial/testimonial-img.jpg') }}" alt="">
                        </div>
                        <div class="mg-customer-name">
                            <span>Carolina Martinez</span>
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
                                <h6 class="card-title">Worldwide Delivery</h6>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 mt-4 mg-feature-service">
                    <div class="mg-feature-box">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('client/images/icons/Icon-feather-shopping-bag.svg') }}" alt="">
                                <h6 class="card-title">24/7 Help Center</h6>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 mt-4 mg-feature-service">
                    <div class="mg-feature-box">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('client/images/icons/delivery-truck.svg') }}" alt="">
                                <h6 class="card-title">Secure Checkout</h6>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-6 mt-4 mg-feature-service">
                    <div class="mg-feature-box">
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('client/images/icons/Icon-ionic-ios-timer.svg') }}" alt="">
                                <h6 class="card-title">30 Days Return</h6>
                                <p class="card-text">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
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
