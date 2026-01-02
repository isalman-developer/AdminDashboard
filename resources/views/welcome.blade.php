<!DOCTYPE html>
<html lang="en" class=" layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-skin="default"
    data-bs-theme="light" data-assets-path="{{ asset('admin/assets/') }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Demo: Dashboard - Analytics | Vuexy - Bootstrap Dashboard PRO</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/iconify-icons.css') }}" />

    <script src="{{ asset('admin/assets/vendor/libs/@algolia/autocomplete-js.js') }}"></script>

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    <!-- endbuild -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/pages/cards-advance.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu">
                <div class="app-brand demo ">
                    <a href="index.html" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <span class="text-primary">
                                <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="currentColor" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold ms-3">Vuexy</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                        <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
                        <i class="icon-base ti tabler-x d-block d-xl-none"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboards -->
                    <li class="menu-item active open">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon menu-icon icon-base ti tabler-smart-home"></i>
                            <div data-i18n="Dashboards">Dashboards</div>
                            <div class="badge text-bg-danger rounded-pill ms-auto">5</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item active">
                                <a href="index.html" class="menu-link">
                                    <div data-i18n="Analytics">Analytics</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="dashboards-crm.html" class="menu-link">
                                    <div data-i18n="CRM">CRM</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-ecommerce-dashboard.html" class="menu-link">
                                    <div data-i18n="eCommerce">eCommerce</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-logistics-dashboard.html" class="menu-link">
                                    <div data-i18n="Logistics">Logistics</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-academy-dashboard.html" class="menu-link">
                                    <div data-i18n="Academy">Academy</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                 
                    <!-- Front Pages -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon menu-icon icon-base ti tabler-files"></i>
                            <div data-i18n="Front Pages">Front Pages</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="../front-pages/landing-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Landing">Landing</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../front-pages/pricing-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Pricing">Pricing</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../front-pages/payment-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Payment">Payment</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../front-pages/checkout-page.html" class="menu-link" target="_blank">
                                    <div data-i18n="Checkout">Checkout</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="../front-pages/help-center-landing.html" class="menu-link" target="_blank">
                                    <div data-i18n="Help Center">Help Center</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Apps & Pages -->
                    <li class="menu-header small">
                        <span class="menu-header-text" data-i18n="Apps & Pages">Apps &amp; Pages</span>
                    </li>
                    <li class="menu-item">
                        <a href="app-email.html" class="menu-link">
                            <i class="menu-icon icon-base ti tabler-mail"></i>
                            <div data-i18n="Email">Email</div>
                        </a>
                    </li>
                    <!-- e-commerce-app menu start -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon icon-base ti tabler-shopping-cart"></i>
                            <div data-i18n="eCommerce">eCommerce</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a href="app-ecommerce-dashboard.html" class="menu-link">
                                    <div data-i18n="Dashboard">Dashboard</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Products">Products</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-product-list.html" class="menu-link">
                                            <div data-i18n="Product List">Product List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-product-add.html" class="menu-link">
                                            <div data-i18n="Add Product">Add Product</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-category-list.html" class="menu-link">
                                            <div data-i18n="Category List">Category List</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Order">Order</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-order-list.html" class="menu-link">
                                            <div data-i18n="Order List">Order List</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-order-details.html" class="menu-link">
                                            <div data-i18n="Order Details">Order Details</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Customer">Customer</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-customer-all.html" class="menu-link">
                                            <div data-i18n="All Customers">All Customers</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                                            <div data-i18n="Customer Details">Customer Details</div>
                                        </a>
                                        <ul class="menu-sub">
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-overview.html"
                                                    class="menu-link">
                                                    <div data-i18n="Overview">Overview</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-security.html"
                                                    class="menu-link">
                                                    <div data-i18n="Security">Security</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-billing.html"
                                                    class="menu-link">
                                                    <div data-i18n="Address & Billing">Address & Billing</div>
                                                </a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="app-ecommerce-customer-details-notifications.html"
                                                    class="menu-link">
                                                    <div data-i18n="Notifications">Notifications</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="menu-item">
                                <a href="app-ecommerce-manage-reviews.html" class="menu-link">
                                    <div data-i18n="Manage Reviews">Manage Reviews</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="app-ecommerce-referral.html" class="menu-link">
                                    <div data-i18n="Referrals">Referrals</div>
                                </a>
                            </li>
                            <li class="menu-item">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <div data-i18n="Settings">Settings</div>
                                </a>
                                <ul class="menu-sub">
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-detail.html" class="menu-link">
                                            <div data-i18n="Store Details">Store Details</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-payments.html" class="menu-link">
                                            <div data-i18n="Payments">Payments</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-checkout.html" class="menu-link">
                                            <div data-i18n="Checkout">Checkout</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-shipping.html" class="menu-link">
                                            <div data-i18n="Shipping & Delivery">Shipping & Delivery</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-locations.html" class="menu-link">
                                            <div data-i18n="Locations">Locations</div>
                                        </a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="app-ecommerce-settings-notifications.html" class="menu-link">
                                            <div data-i18n="Notifications">Notifications</div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <!-- e-commerce-app menu end -->
                </ul>
            </aside>

            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);"
                    class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="icon-base ti menu-toggle-icon"></i>
                    <i class="icon-base ti tabler-chevron-right"></i>
                </a>
            </div>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar-detached navbar navbar-expand-xl align-items-center bg-navbar-theme"
                    id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
                            <i class="icon-base ti menu-toggle-icon"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center justify-content-end" id="navbar-collapse">
                        <ul class="navbar-nav flex-row align-items-center ms-md-auto">
                            <!-- Style Switcher -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                                    id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <i class="icon-base ti tabler-sun theme-icon-active text-heading"></i>
                                    <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
                                    <li>
                                        <button type="button" class="dropdown-item align-items-center active"
                                            data-bs-theme-value="light" aria-pressed="false">
                                            <span><i class="icon-base ti tabler-sun me-3"
                                                    data-icon="sun"></i>Light</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item align-items-center"
                                            data-bs-theme-value="dark" aria-pressed="true">
                                            <span><i class="icon-base ti tabler-moon-stars me-3"
                                                    data-icon="moon-stars"></i>Dark</span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item align-items-center"
                                            data-bs-theme-value="system" aria-pressed="false">
                                            <span><i class="icon-base ti tabler-device-desktop-analytics me-3"
                                                    data-icon="device-desktop-analytics"></i>System</span>
                                        </button>
                                    </li>
                                </ul>
                            </li>
                            <!-- / Style Switcher-->

                            <!-- Notification -->
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-2">
                                <a class="nav-link dropdown-toggle hide-arrow btn btn-icon btn-text-secondary rounded-pill"
                                    href="javascript:void(0);" data-bs-toggle="dropdown"
                                    data-bs-auto-close="outside" aria-expanded="false">
                                    <span class="position-relative">
                                        <i class="icon-base ti tabler-bell icon-22px text-heading"></i>
                                        <span
                                            class="badge rounded-pill bg-danger badge-dot badge-notifications border"></span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end p-0">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h6 class="mb-0 me-auto">Notification</h6>
                                            <div class="d-flex align-items-center h6 mb-0">
                                                <span class="badge bg-label-primary me-2">8 New</span>
                                                <a href="javascript:void(0)"
                                                    class="dropdown-notifications-all p-2 btn btn-icon"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Mark all as read"><i
                                                        class="icon-base ti tabler-mail-open text-heading"></i></a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container">
                                        <ul class="list-group list-group-flush">
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('admin/assets/img/avatars/1.png') }}"
                                                                alt class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="small mb-1">Congratulation Lettie 🎉</h6>
                                                        <small class="mb-1 d-block text-body">Won the monthly best
                                                            seller gold badge</small>
                                                        <small class="text-body-secondary">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-danger">CF</span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">Charles Franklin</h6>
                                                        <small class="mb-1 d-block text-body">Accepted your
                                                            connection</small>
                                                        <small class="text-body-secondary">12hr ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('admin/assets/img/avatars/2.png') }}"
                                                                alt class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">New Message ✉️</h6>
                                                        <small class="mb-1 d-block text-body">You have new message
                                                            from Natalie</small>
                                                        <small class="text-body-secondary">1h ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="icon-base ti tabler-shopping-cart"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">Whoo! You have new order 🛒</h6>
                                                        <small class="mb-1 d-block text-body">ACME Inc. made new order
                                                            $1,154</small>
                                                        <small class="text-body-secondary">1 day ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('admin/assets/img/avatars/9.png') }}"
                                                                alt class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">Application has been approved 🚀</h6>
                                                        <small class="mb-1 d-block text-body">Your ABC project
                                                            application has been approved.</small>
                                                        <small class="text-body-secondary">2 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-success"><i
                                                                    class="icon-base ti tabler-chart-pie"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">Monthly report is generated</h6>
                                                        <small class="mb-1 d-block text-body">July monthly financial
                                                            report is generated </small>
                                                        <small class="text-body-secondary">3 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('admin/assets/img/avatars/5.png') }}"
                                                                alt class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">Send connection request</h6>
                                                        <small class="mb-1 d-block text-body">Peter sent you
                                                            connection request</small>
                                                        <small class="text-body-secondary">4 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <img src="{{ asset('admin/assets/img/avatars/6.png') }}"
                                                                alt class="rounded-circle" />
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">New message from Jane</h6>
                                                        <small class="mb-1 d-block text-body">Your have new message
                                                            from Jane</small>
                                                        <small class="text-body-secondary">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li
                                                class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span
                                                                class="avatar-initial rounded-circle bg-label-warning"><i
                                                                    class="icon-base ti tabler-alert-triangle"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1 small">CPU is running high</h6>
                                                        <small class="mb-1 d-block text-body">CPU Utilization Percent
                                                            is currently at 88.63%,</small>
                                                        <small class="text-body-secondary">5 days ago</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-read"><span
                                                                class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                            class="dropdown-notifications-archive"><span
                                                                class="icon-base ti tabler-x"></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="border-top">
                                        <div class="d-grid p-4">
                                            <a class="btn btn-primary btn-sm d-flex" href="javascript:void(0);">
                                                <small class="align-middle">View all notifications</small>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!--/ Notification -->

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
                                    data-bs-toggle="dropdown">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('admin/assets/img/avatars/1.png') }}" alt
                                            class="rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item mt-0" href="pages-account-settings-account.html">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <div class="avatar avatar-online">
                                                        <img src="{{ asset('admin/assets/img/avatars/1.png') }}" alt
                                                            class="rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h6 class="mb-0">John Doe</h6>
                                                    <small class="text-body-secondary">Admin</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-profile-user.html">
                                            <i class="icon-base ti tabler-user me-3 icon-md"></i><span
                                                class="align-middle">My Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-account.html">
                                            <i class="icon-base ti tabler-settings me-3 icon-md"></i><span
                                                class="align-middle">Settings</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-account-settings-billing.html">
                                            <span class="d-flex align-items-center align-middle">
                                                <i
                                                    class="flex-shrink-0 icon-base ti tabler-file-dollar me-3"></i><span
                                                    class="flex-grow-1 align-middle">Billing</span>
                                                <span
                                                    class="flex-shrink-0 badge bg-danger d-flex align-items-center justify-content-center">4</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider my-1 mx-n2"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-pricing.html">
                                            <i class="icon-base ti tabler-currency-dollar me-3"></i><span
                                                class="align-middle">Pricing</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="pages-faq.html">
                                            <i class="icon-base ti tabler-question-mark me-3"></i><span
                                                class="align-middle">FAQ</span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="d-grid px-2 pt-2 pb-1">
                                            <a class="btn btn-sm btn-danger d-flex" href="auth-login-cover.html"
                                                target="_blank">
                                                <small class="align-middle">Logout</small>
                                                <i class="icon-base ti tabler-logout ms-2"></i>
                                            </a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="row g-6">
                            <!-- Website Analytics -->
                            <div class="col-xl-6 col">
                                <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
                                    id="swiper-with-pagination-cards">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="text-white mb-0">Website Analytics</h5>
                                                    <small>Total 28.5% Conversion Rate</small>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                                        <h6 class="text-white mt-0 mt-md-3 mb-4">Traffic</h6>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li class="d-flex mb-4 align-items-center">
                                                                        <p
                                                                            class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                            28%</p>
                                                                        <p class="mb-0">Sessions</p>
                                                                    </li>
                                                                    <li class="d-flex align-items-center">
                                                                        <p
                                                                            class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                            1.2k</p>
                                                                        <p class="mb-0">Leads</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-6">
                                                                <ul class="list-unstyled mb-0">
                                                                    <li class="d-flex mb-4 align-items-center">
                                                                        <p
                                                                            class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                            3.1k</p>
                                                                        <p class="mb-0">Page Views</p>
                                                                    </li>
                                                                    <li class="d-flex align-items-center">
                                                                        <p
                                                                            class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                            12%</p>
                                                                        <p class="mb-0">Conversions</p>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                                        <img src="{{ asset('admin/assets/img/illustrations/card-website-analytics-1.png') }}"
                                                            alt="Website Analytics" height="150"
                                                            class="card-website-analytics-img" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="text-white mb-0">Website Analytics</h5>
                                                    <small>Total 28.5% Conversion Rate</small>
                                                </div>
                                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Spending</h6>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex mb-4 align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        12h</p>
                                                                    <p class="mb-0">Spend</p>
                                                                </li>
                                                                <li class="d-flex align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        127</p>
                                                                    <p class="mb-0">Order</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-6">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex mb-4 align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        18</p>
                                                                    <p class="mb-0">Order Size</p>
                                                                </li>
                                                                <li class="d-flex align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        2.3k</p>
                                                                    <p class="mb-0">Items</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                                    <img src="{{ asset('admin/assets/img/illustrations/card-website-analytics-2.png') }}"
                                                        alt="Website Analytics" height="150"
                                                        class="card-website-analytics-img" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-slide">
                                            <div class="row">
                                                <div class="col-12">
                                                    <h5 class="text-white mb-0">Website Analytics</h5>
                                                    <small>Total 28.5% Conversion Rate</small>
                                                </div>
                                                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                                    <h6 class="text-white mt-0 mt-md-3 mb-4">Revenue Sources</h6>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex mb-4 align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        268</p>
                                                                    <p class="mb-0">Direct</p>
                                                                </li>
                                                                <li class="d-flex align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        62</p>
                                                                    <p class="mb-0">Referral</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-6">
                                                            <ul class="list-unstyled mb-0">
                                                                <li class="d-flex mb-4 align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        890</p>
                                                                    <p class="mb-0">Organic</p>
                                                                </li>
                                                                <li class="d-flex align-items-center">
                                                                    <p
                                                                        class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                                        1.2k</p>
                                                                    <p class="mb-0">Campaign</p>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                                    <img src="{{ asset('admin/assets/img/illustrations/card-website-analytics-3.png') }}"
                                                        alt="Website Analytics" height="150"
                                                        class="card-website-analytics-img" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-pagination"></div>
                                </div>
                            </div>
                            <!--/ Website Analytics -->

                            <!-- Average Daily Sales -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-header pb-0">
                                        <h5 class="mb-3 card-title">Average Daily Sales</h5>
                                        <p class="mb-0 text-body">Total Sales This Month</p>
                                        <h4 class="mb-0">$28,450</h4>
                                    </div>
                                    <div class="card-body px-0">
                                        <div id="averageDailySales"></div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Average Daily Sales -->

                            <!-- Sales Overview -->
                            <div class="col-xl-3 col-sm-6">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between">
                                            <p class="mb-0 text-body">Sales Overview</p>
                                            <p class="card-text fw-medium text-success">+18.2%</p>
                                        </div>
                                        <h4 class="card-title mb-1">$42.5k</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="d-flex gap-2 align-items-center mb-2">
                                                    <span class="badge bg-label-info p-1 rounded"><i
                                                            class="icon-base ti tabler-shopping-cart"></i></span>
                                                    <p class="mb-0">Order</p>
                                                </div>
                                                <h5 class="mb-0 pt-1">62.2%</h5>
                                                <small class="text-body-secondary">6,440</small>
                                            </div>
                                            <div class="col-4">
                                                <div class="divider divider-vertical">
                                                    <div class="divider-text">
                                                        <span class="badge-divider-bg bg-label-secondary">VS</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                                                    <p class="mb-0">Visits</p>
                                                    <span class="badge bg-label-primary p-1 rounded"><i
                                                            class="icon-base ti tabler-link"></i></span>
                                                </div>
                                                <h5 class="mb-0 pt-1">25.5%</h5>
                                                <small class="text-body-secondary">12,749</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center mt-6">
                                            <div class="progress w-100" style="height: 10px;">
                                                <div class="progress-bar bg-info" style="width: 70%"
                                                    role="progressbar" aria-valuenow="70" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                                <div class="progress-bar bg-primary" role="progressbar"
                                                    style="width: 30%" aria-valuenow="30" aria-valuemin="0"
                                                    aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Sales Overview -->

                            <!-- Earning Reports -->
                            <div class="col-md-6">
                                <div class="card h-100">
                                    <div class="card-header pb-0 d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1">Earning Reports</h5>
                                            <p class="card-subtitle">Weekly Earnings Overview</p>
                                        </div>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                                                type="button" id="earningReportsId" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i
                                                    class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="earningReportsId">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row align-items-center g-md-8">
                                            <div class="col-12 col-md-5 d-flex flex-column">
                                                <div class="d-flex gap-2 align-items-center mb-3 flex-wrap">
                                                    <h2 class="mb-0">$468</h2>
                                                    <div class="badge rounded bg-label-success">+4.2%</div>
                                                </div>
                                                <small class="text-body">You informed of this week compared to last
                                                    week</small>
                                            </div>
                                            <div class="col-12 col-md-7 ps-xl-8">
                                                <div id="weeklyEarningReports"></div>
                                            </div>
                                        </div>
                                        <div class="border rounded p-5 mt-5">
                                            <div class="row gap-4 gap-sm-0">
                                                <div class="col-12 col-sm-4">
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="badge rounded bg-label-primary p-1">
                                                            <i
                                                                class="icon-base ti tabler-currency-dollar"></i>
                                                        </div>
                                                        <h6 class="mb-0 fw-normal">Earnings</h6>
                                                    </div>
                                                    <h4 class="my-2">$545.69</h4>
                                                    <div class="progress w-75" style="height:4px">
                                                        <div class="progress-bar" role="progressbar"
                                                            style="width: 65%" aria-valuenow="65"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="badge rounded bg-label-info p-1">
                                                            <i class="icon-base ti tabler-chart-pie-2"></i>
                                                        </div>
                                                        <h6 class="mb-0 fw-normal">Profit</h6>
                                                    </div>
                                                    <h4 class="my-2">$256.34</h4>
                                                    <div class="progress w-75" style="height:4px">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-4">
                                                    <div class="d-flex gap-2 align-items-center">
                                                        <div class="badge rounded bg-label-danger p-1">
                                                            <i class="icon-base ti tabler-brand-paypal"></i>
                                                        </div>
                                                        <h6 class="mb-0 fw-normal">Expense</h6>
                                                    </div>
                                                    <h4 class="my-2">$74.19</h4>
                                                    <div class="progress w-75" style="height:4px">
                                                        <div class="progress-bar bg-danger" role="progressbar"
                                                            style="width: 65%" aria-valuenow="65"
                                                            aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Earning Reports -->

                            <!-- Support Tracker -->
                            <div class="col-12 col-md-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1">Support Tracker</h5>
                                            <p class="card-subtitle">Last 7 Days</p>
                                        </div>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                                                type="button" id="supportTrackerMenu" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i
                                                    class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="supportTrackerMenu">
                                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body row">
                                        <div class="col-12 col-sm-4">
                                            <div class="mt-lg-4 mt-lg-2 mb-lg-6 mb-2">
                                                <h2 class="mb-0">164</h2>
                                                <p class="mb-0">Total Tickets</p>
                                            </div>
                                            <ul class="p-0 m-0">
                                                <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                                    <div class="badge rounded bg-label-primary p-1_5">
                                                        <i class="icon-base ti tabler-ticket"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-nowrap">New Tickets</h6>
                                                        <small class="text-body-secondary">142</small>
                                                    </div>
                                                </li>
                                                <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                                                    <div class="badge rounded bg-label-info p-1_5">
                                                        <i class="icon-base ti tabler-circle-check"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-nowrap">Open Tickets</h6>
                                                        <small class="text-body-secondary">28</small>
                                                    </div>
                                                </li>
                                                <li class="d-flex gap-4 align-items-center pb-1">
                                                    <div class="badge rounded bg-label-warning p-1_5">
                                                        <i class="icon-base ti tabler-clock"></i>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-nowrap">Response Time</h6>
                                                        <small class="text-body-secondary">1 Day</small>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <div id="supportTracker"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Support Tracker -->

                            <!-- Total Earning -->
                            <div class="col-12 col-md-6 col-xxl-4 order-2 order-xl-0">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0 card-title">Total Earning</h5>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                                                    type="button" id="totalEarning" data-bs-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    <i
                                                        class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="totalEarning">
                                                    <a class="dropdown-item" href="javascript:void(0);">View
                                                        More</a>
                                                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <h2 class="mb-0 me-2">87%</h2>
                                            <i class="icon-base ti tabler-chevron-up text-success me-1"></i>
                                            <h6 class="text-success mb-0">25.8%</h6>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="totalEarningChart"></div>
                                        <div class="d-flex align-items-start my-4">
                                            <div class="badge rounded bg-label-primary p-2 me-4 rounded">
                                                <i class="icon-base ti tabler-brand-paypal"></i>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between w-100 gap-2 align-items-center">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total Revenue</h6>
                                                    <small class="text-body">Client Payment</small>
                                                </div>
                                                <h6 class="mb-0 text-success">+$126</h6>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <div class="badge rounded bg-label-secondary p-2 me-4 rounded">
                                                <i class="icon-base ti tabler-currency-dollar"></i>
                                            </div>
                                            <div
                                                class="d-flex justify-content-between w-100 gap-2 align-items-center">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total Sales</h6>
                                                    <small class="text-body">Refund</small>
                                                </div>
                                                <h6 class="mb-0 text-success">+$98</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Total Earning -->

                            <!-- Monthly Campaign State -->
                            <div class="col-xxl-4 col-md-6">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1">Monthly Campaign State</h5>
                                            <p class="card-subtitle">8.52k Social Visiters</p>
                                        </div>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                                                type="button" id="MonthlyCampaign" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i
                                                    class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="MonthlyCampaign">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                                <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="p-0 m-0">
                                            <li class="mb-6 d-flex justify-content-between align-items-center">
                                                <div class="badge bg-label-success rounded p-1_5">
                                                    <i class="icon-base ti tabler-mail"></i>
                                                </div>
                                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                                    <h6 class="mb-0 ms-4">Emails</h6>
                                                    <div class="d-flex">
                                                        <p class="mb-0">12,346</p>
                                                        <p class="ms-4 text-success mb-0">0.3%</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6 d-flex justify-content-between align-items-center">
                                                <div class="badge bg-label-info rounded p-1_5">
                                                    <i class="icon-base ti tabler-link"></i>
                                                </div>
                                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                                    <h6 class="mb-0 ms-4">Opened</h6>
                                                    <div class="d-flex">
                                                        <p class="mb-0">8,734</p>
                                                        <p class="ms-4 text-success mb-0">2.1%</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6 d-flex justify-content-between align-items-center">
                                                <div class="badge bg-label-warning rounded p-1_5">
                                                    <i class="icon-base ti tabler-mouse"></i>
                                                </div>
                                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                                    <h6 class="mb-0 ms-4">Clicked</h6>
                                                    <div class="d-flex">
                                                        <p class="mb-0">967</p>
                                                        <p class="ms-4 text-danger mb-0">1.4%</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6 d-flex justify-content-between align-items-center">
                                                <div class="badge bg-label-primary rounded p-1_5">
                                                    <i class="icon-base ti tabler-users"></i>
                                                </div>
                                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                                    <h6 class="mb-0 ms-4">Subscribe</h6>
                                                    <div class="d-flex">
                                                        <p class="mb-0">345</p>
                                                        <p class="ms-4 text-success mb-0">8.5%</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6 d-flex justify-content-between align-items-center">
                                                <div class="badge bg-label-secondary rounded p-1_5">
                                                    <i class="icon-base ti tabler-alert-triangle"></i>
                                                </div>
                                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                                    <h6 class="mb-0 ms-4">Complaints</h6>
                                                    <div class="d-flex">
                                                        <p class="mb-0">10</p>
                                                        <p class="ms-4 text-danger mb-0">1.5%</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-3 d-flex justify-content-between align-items-center">
                                                <div class="badge bg-label-danger rounded p-1_5">
                                                    <i class="icon-base ti tabler-ban"></i>
                                                </div>
                                                <div class="d-flex justify-content-between w-100 flex-wrap">
                                                    <h6 class="mb-0 ms-4">Unsubscribe</h6>
                                                    <div class="d-flex">
                                                        <p class="mb-0">86</p>
                                                        <p class="ms-4 text-success mb-0">0.8%</p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--/ Monthly Campaign State -->

                            <!-- Source Visit -->
                            <div class="col-xxl-4 col-md-6 col-12">
                                <div class="card h-100">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="card-title mb-0">
                                            <h5 class="mb-1">Source Visits</h5>
                                            <p class="card-subtitle">38.4k Visitors</p>
                                        </div>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                                                type="button" id="sourceVisits" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i
                                                    class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-end"
                                                aria-labelledby="sourceVisits">
                                                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Download</a>
                                                <a class="dropdown-item" href="javascript:void(0);">View All</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="badge bg-label-secondary text-body p-2 me-4 rounded">
                                                        <i class="icon-base ti tabler-shadow"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Direct Source</h6>
                                                            <small class="text-body">Direct link click</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">1.2k</p>
                                                            <div class="ms-4 badge bg-label-success">+4.2%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="badge bg-label-secondary text-body p-2 me-4 rounded">
                                                        <i class="icon-base ti tabler-globe"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Social Network</h6>
                                                            <small class="text-body">Social Channels</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">31.5k</p>
                                                            <div class="ms-4 badge bg-label-success">+8.2%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="badge bg-label-secondary text-body p-2 me-4 rounded">
                                                        <i class="icon-base ti tabler-mail"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Email Newsletter</h6>
                                                            <small class="text-body">Mail Campaigns</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">893</p>
                                                            <div class="ms-4 badge bg-label-success">+2.4%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="badge bg-label-secondary text-body p-2 me-4 rounded">
                                                        <i class="icon-base ti tabler-external-link"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Referrals</h6>
                                                            <small class="text-body">Impact Radius Visits</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">342</p>
                                                            <div class="ms-4 badge bg-label-danger">-0.4%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="mb-6">
                                                <div class="d-flex align-items-center">
                                                    <div class="badge bg-label-secondary text-body p-2 me-4 rounded">
                                                        <i class="icon-base ti tabler-ad"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">ADVT</h6>
                                                            <small class="text-body">Google ADVT</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">2.15k</p>
                                                            <div class="ms-4 badge bg-label-success">+9.1%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="d-flex align-items-center">
                                                    <div class="badge bg-label-secondary text-body p-2 me-4 rounded">
                                                        <i class="icon-base ti tabler-star"></i>
                                                    </div>
                                                    <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                                        <div class="me-2">
                                                            <h6 class="mb-0">Other</h6>
                                                            <small class="text-body">Many Sources</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <p class="mb-0">12.5k</p>
                                                            <div class="ms-4 badge bg-label-success">+6.2%</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--/ Source Visit -->
                        </div>
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl">
                            <div
                                class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
                                <div class="text-body">
                                    &#169;
                                    <script>
                                        document.write(new Date().getFullYear());
                                    </script>
                                    , made with ❤️ by <a href="https://pixinvent.com" target="_blank"
                                        class="footer-link">Pixinvent</a>
                                </div>
                                <div class="d-none d-lg-inline-block">
                                    <a href="https://themeforest.net/licenses/standard" class="footer-link me-4"
                                        target="_blank">License</a>
                                    <a href="https://themeforest.net/user/pixinvent/portfolio" target="_blank"
                                        class="footer-link me-4">More Themes</a>

                                    <a href="https://demos.pixinvent.com/vuexy-html-admin-template/documentation/"
                                        target="_blank" class="footer-link me-4">Documentation</a>

                                    <a href="https://pixinvent.ticksy.com/" target="_blank"
                                        class="footer-link d-none d-sm-inline-block">Support</a>
                                </div>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <script src="{{ asset('admin/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('admin/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('admin/assets/js/dashboards-analytics.js') }}"></script>
</body>

</html>
