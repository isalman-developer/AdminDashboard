@extends('client.layouts.master')
@section('content')
    <!--page header start here-->
    <div class="mg-page-header-section8 mg-page-header-style">
        <div class="mg-page-header-inner">
            <div class="container">
                <div class="mg-page-header-text">
                    <div class="mg-page-header-heading">
                        <h3>Contact</h3>
                    </div>
                    <div class="mg-breadcrumb">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="index-2.html">Home</a></li>
                                <li class="breadcrumb-item active">Contact</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page header end here-->
    <!--contact us section start here-->
    <div class="mg-contact-us-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <div class="mg-contact-information-section">
                        <div class="mg-contact-info-inner">
                            <div class="mg-contact-info-heading">
                                <h5>Contact Information</h5>
                            </div>
                            <div class="mg-contact-info-content">
                                <h5>Address</h5>
                                <div>
                                    <span>
                                        {{ site_settings()[0]['address'] ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>
                            <div class="mg-contact-info-content">
                                <h5>Phone Number</h5>
                                <div>
                                    <span>
                                        Mobile: {{ site_settings()[0]['phone_number_1'] ?? '123456789' }}
                                    </span>
                                </div>
                                <div>
                                    <span>
                                        Mobile: {{ site_settings()[0]['phone_number_2'] ?? '987654321' }}
                                    </span>
                                </div>
                            </div>
                            <div class="mg-contact-info-content">
                                <h5>Email Address</h5>
                                <div>
                                    <a href="#">
                                        <span>
                                            {{ site_settings()[0]['email_1'] ?? 'N/A' }}
                                        </span>
                                    </a>
                                </div>
                                <div>
                                    <a href="#">
                                        <span>
                                            {{ site_settings()[0]['email_2'] ?? 'N/A' }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="mg-contact-info-content">
                                <div class="mg-social-link-section">
                                    <div class="mg-social-heading me-2">
                                        <span>Social Links</span>
                                    </div>
                                    <div class="mg-social-link">
                                        <ul>
                                            @if (site_settings()[0]['faceboook'])
                                                <li>
                                                    <a href="{{ site_settings()[0]['faceboook'] }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/fb.jpg') }}" alt="">
                                                    </a>
                                                </li>
                                            @endif
                                            @if (site_settings()[0]['instagram'])
                                                <li>
                                                    <a href="{{ site_settings()[0]['instagram'] }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/insta.jpg') }}" alt="">
                                                    </a>
                                                </li>
                                            @endif
                                            @if (site_settings()[0]['linkedin'])
                                                <li>
                                                    <a href="{{ site_settings()[0]['linkedin'] }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/linkedin.jpg') }}" alt="">
                                                    </a>
                                                </li>
                                            @endif
                                            @if (site_settings()[0]['twitter'])
                                                <li>
                                                    <a href="{{ site_settings()[0]['twitter'] }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/linkedin.jpg') }}" alt="">
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="mg-get-in-touch-form-section">
                        <div class="mg-git-form-heading">
                            <h5>Get in touch</h5>
                            <div>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s
                                </p>
                            </div>
                        </div>
                        <form class="mg-contact-form" action="javascript:void(0);" method="post">
                            <div class="mg-form-main">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="text" name="first_name" placeholder="First Name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="text" name="last_name" placeholder="Last Name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="text" name="email" placeholder="Email Address*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="text" name="phone_number" placeholder="Phone Number*">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="mg-form-textarea">
                                            <textarea name="message" placeholder="Type message"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mg-form-submit-btn">
                                    <button type="submit" class="btn">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
                        <div class="alert-msg" style="display:none;">
                            <div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
                                Email sent successfully.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--contact us section end here-->
@endsection
@push('scripts')
    <script src="{{ asset('client/js/jquery.ui.touch-punch.min.js') }}"></script>
    <script src="{{ asset('client/libs/Magnific-Popup-master/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('client/js/about-us.js') }}"></script>
@endpush
