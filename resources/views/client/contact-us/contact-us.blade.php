@extends('client.layouts.master')
@section('title', 'Contact - ' . setting('site_name', 'E-commerce'))
@section('content')
    <!--page header start here-->
    <div class="mg-page-header-section8 mg-page-header-style">
        <div class="mg-page-header-inner">
            <div class="container">
                <div class="mg-page-header-text">
                    <div class="mg-page-header-heading">
                        <h3>{{ setting('contact_hero_heading', 'Contact Us') }}</h3>
                    </div>
                    <div class="mg-breadcrumb">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Home</a></li>
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
                            @if(setting('site_address'))
                            <div class="mg-contact-info-content">
                                <h5>Address</h5>
                                <div><span>{{ setting('site_address') }}</span></div>
                            </div>
                            @endif
                            @if(setting('site_phone_1'))
                            <div class="mg-contact-info-content">
                                <h5>Phone Number</h5>
                                <div><span>Mobile: <a href="tel:{{ setting('site_phone_1') }}">{{ setting('site_phone_1') }}</a></span></div>
                                @if(setting('site_phone_2'))
                                    <div><span>Mobile: <a href="tel:{{ setting('site_phone_2') }}">{{ setting('site_phone_2') }}</a></span></div>
                                @endif
                            </div>
                            @endif
                            @if(setting('site_email_1'))
                            <div class="mg-contact-info-content">
                                <h5>Email Address</h5>
                                <div><a href="mailto:{{ setting('site_email_1') }}"><span>{{ setting('site_email_1') }}</span></a></div>
                                @if(setting('site_email_2'))
                                    <div><a href="mailto:{{ setting('site_email_2') }}"><span>{{ setting('site_email_2') }}</span></a></div>
                                @endif
                            </div>
                            @endif
                            @if(setting('site_facebook') || setting('site_instagram') || setting('site_linkedin') || setting('site_twitter'))
                            <div class="mg-contact-info-content">
                                <div class="mg-social-link-section">
                                    <div class="mg-social-heading me-2">
                                        <span>Social Links</span>
                                    </div>
                                    <div class="mg-social-link">
                                        <ul>
                                            @if(setting('site_facebook'))
                                                <li>
                                                    <a href="{{ setting('site_facebook') }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/fb.jpg') }}" alt="Facebook">
                                                    </a>
                                                </li>
                                            @endif
                                            @if(setting('site_instagram'))
                                                <li>
                                                    <a href="{{ setting('site_instagram') }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/insta.jpg') }}" alt="Instagram">
                                                    </a>
                                                </li>
                                            @endif
                                            @if(setting('site_linkedin'))
                                                <li>
                                                    <a href="{{ setting('site_linkedin') }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/linkedin.jpg') }}" alt="LinkedIn">
                                                    </a>
                                                </li>
                                            @endif
                                            @if(setting('site_twitter'))
                                                <li>
                                                    <a href="{{ setting('site_twitter') }}" target="_blank">
                                                        <img src="{{ asset('client/images/icons/twitter.jpg') }}" alt="Twitter">
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-12">
                    <div class="mg-get-in-touch-form-section">
                        <div class="mg-git-form-heading">
                            <h5>{{ setting('contact_form_heading', 'Get in touch') }}</h5>
                            <div>
                                <p>{{ setting('contact_form_subtext', 'Have a question or need help with your order? Fill out the form and our team will get back to you within 24 hours.') }}</p>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="mt-2 mb-3 alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form class="mg-contact-form" action="{{ route('contact.store') }}" method="POST">
                            @csrf
                            <div class="mg-form-main">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="text" name="name" placeholder="Full Name*"
                                                value="{{ old('name') }}" required>
                                            @error('name')<span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="email" name="email" placeholder="Email Address*"
                                                value="{{ old('email') }}" required>
                                            @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="text" name="phone" placeholder="Phone Number"
                                                value="{{ old('phone') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="mg-form-input-field">
                                            <input type="text" name="subject" placeholder="Subject"
                                                value="{{ old('subject') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="mg-form-textarea">
                                            <textarea name="message" placeholder="Your message*" required>{{ old('message') }}</textarea>
                                            @error('message')<span class="text-danger small">{{ $message }}</span>@enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="mg-form-submit-btn">
                                    <button type="submit" class="btn">SEND MESSAGE</button>
                                </div>
                            </div>
                        </form>
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
