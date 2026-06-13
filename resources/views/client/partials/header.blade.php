<!--MG Header Start Here-->
<header>
    <div class="mg-header-outer">
        <div class="container">
            <div class="row gx-0 gx-md-2 align-items-center">
                <div class="col-md-3 col-lg-3 col-5">
                    <div class="header-logo">
                        <a class="mg-logo text-decoration-none" href="{{ route('home') }}">
                            {{ site_settings()[0]['name'] ?? 'E-commerce'}}
                        </a>
                    </div>
                </div>
                <div class="col-md-5 col-lg-6 col-2 order-3 order-md-0 d-flex d-md-block justify-content-end justify-content-md-start text-end">
                    <div>
                        <div class="mg-menu-overlay"></div>
                        <nav class="mg-menu" id="menu">
                            <div class="menu-mobile-header">
                                <button type="button" class="menu-mobile-arrow">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                </button>
                                <div class="menu-mobile-title"></div>
                                <button type="button" class="menu-mobile-close"><i class="fa fa-times" aria-hidden="true"></i></button>
                            </div>
                            <ul class="menu-section mg-menu-outer">

                                <li class="menu-item"><a href="{{ route('home') }}">HOME</a></li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">SHOP <i class="fa-solid fa-caret-down"></i></a>
                                    <div class="mg-sub-menu-outer">
                                        <div class="menu-subs">
                                            <ul>
                                                @foreach (site_marked_as() as $item)
                                                    @if (!in_array($item['slug'], ['normal', 'primary', 'grand_sale', 'best_seller']))
                                                        <li>
                                                            <a href="{{ route('products.index') }}">
                                                                {{ $item['title'] }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="menu-item"><a href="{{ route('aboutUs') }}">ABOUT US</a></li>
                                <li class="menu-item"><a href="{{ route('contactUs') }}">CONATCT</a></li>
                            </ul>
                        </nav>
                        <div>
                            <button type="button" class="menu-mobile-toggle mg-burger-menu-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-5 text-end">
                    <div class="row">
                        <div class="col-12 col-lg-12 col-md-12">
                            <div class="header-icons-outer">
                                <ul>
                                    <li>
                                        <a href="wishlist.html">
                                            <img src="{{ asset('client/images/icons/heart.svg') }}" alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="cart.html">
                                            <img src="{{ asset('client/images/icons/Icon-feather-shopping-bag.svg') }}" alt=""><span class="mg-header-icon-counter">2</span>
                                        </a>
                                    </li>
                                    <li class="mg-profile-icon">
                                        <a href="profile.html">
                                            <img src="{{ asset('client/images/icons/profile-icon.svg') }}" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header filter start here-->
    <div class="mg-header-filter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-8 col-8">
                    <div class="mg-category-filter">
                        <div class="dropdown">
                            <a class="mg-dropdown-btn btn btn-dark dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bars"></i>
                                <span>All Brands</span>
                            </a>

                            <ul class="dropdown-menu mg-dropdown-list" aria-labelledby="dropdownMenuLink">
                                @foreach (site_brands() as $brand)
                                    <li>
                                        <a class="dropdown-item mg-font-style" href="#">
                                            <i class="fa-solid fa-laptop"></i>
                                            <span>{{ $brand['title'] ?? 'N/A' }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-3 d-none d-md-block">
                    <div class="mg-search-bar-box">
                        <div class="mg-search-filed">
                            <form class="d-flex">
                                <div class="mg-search-bar-dropdwon">
                                    <select class="form-select mg-font-style">
                                        @foreach (site_categories() as $item)
                                            <option value="{{ $item['id'] }}">
                                                {{ $item['title'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <input class="form-control" type="text" placeholder="What do you need..." aria-label="Search">
                                <button class="btn btn d-flex justify-content-center align-items-center" type="submit">
                                    <img src="{{ asset('client/images/icons/Icon-feather-search.svg') }}" alt="">
                                    <span class="ms-2">Search</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 col-sm-3 d-none d-md-block">
                    <div class="mg-contact-box d-flex align-items-center justify-content-end">
                        <div class="mg-cotact-icon">
                            <img src="{{ asset('client/images/icons/headphones.svg') }}" alt="">
                        </div>
                        <div class="mg-contact-info">
                            <div class="mg-contact-info-sub-heading">Call us 24/7</div>
                            <a href="tel:+911234567890">{{ site_settings()[0]['phone_number_1'] ?? '123456789'}}</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 col-4 d-flex d-md-none justify-content-end">
                    <div class="mg-contact-search-icon">
                        <div class="mg-mobile-icons">
                            <a class="mg-mobile-search-icon" href="#" data-bs-toggle="modal" data-bs-target="#search-popup">
                                <img src="{{ asset('client/images/icons/Icon-feather-search-dark.svg') }}" alt="">
                            </a>
                        </div>
                        <div class="mg-mobile-icons">
                            <a href="tel:+911234567890"><img src="{{ asset('client/images/icons/headphones.svg') }}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--header filter end here-->
</header>
<!--MG Header End Here-->
