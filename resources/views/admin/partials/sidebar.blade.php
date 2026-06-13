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
                            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                            fill="currentColor" />
                    </svg>
                </span>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-3">Dashboard</span>
        </a>

        <a href="{{ route('admin.home') }}" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="icon-base ti menu-toggle-icon d-none d-xl-block"></i>
            <i class="icon-base ti tabler-x d-block d-xl-none"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item active">
            <a href="{{ route('admin.home') }}" class="menu-link ">
                <i class="menu-icon menu-icon icon-base ti tabler-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <div class="badge text-bg-danger rounded-pill ms-auto">5</div>
            </a>
            {{-- <ul class="menu-sub">
                <li class="menu-item active">
                    <a href="index.html" class="menu-link">
                        <div data-i18n="Analytics">Analytics</div>
                    </a>
                </li>
                
                <li class="menu-item">
                    <a href="app-academy-dashboard.html" class="menu-link">
                        <div data-i18n="Academy">Academy</div>
                    </a>
                </li>
            </ul> --}}
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
                                    <a href="app-ecommerce-customer-details-overview.html" class="menu-link">
                                        <div data-i18n="Overview">Overview</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-security.html" class="menu-link">
                                        <div data-i18n="Security">Security</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-billing.html" class="menu-link">
                                        <div data-i18n="Address & Billing">Address & Billing</div>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a href="app-ecommerce-customer-details-notifications.html" class="menu-link">
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

        <!-- Product & Category Management -->
        <li class="menu-header small mt-3">
            <span class="menu-header-text" data-i18n="Catalog">Catalog</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon menu-icon icon-base ti tabler-barcode"></i>
                <div data-i18n="Brands">Brands</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/brands') }}" class="menu-link">
                        <div data-i18n="All Brands">All Brands</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.brands.create') }}" class="menu-link">
                        <div data-i18n="Add Brand">Add Brand</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon menu-icon icon-base ti tabler-tags"></i>
                <div data-i18n="Categories">Categories</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/categories') }}" class="menu-link">
                        <div data-i18n="All Categories">All Categories</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.categories.create') }}" class="menu-link">
                        <div data-i18n="Add Category">Add Category</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon menu-icon icon-base ti tabler-package"></i>
                <div data-i18n="Products">Products</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/products') }}" class="menu-link">
                        <div data-i18n="All Products">All Products</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.products.create') }}" class="menu-link">
                        <div data-i18n="Add Product">Add Product</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon menu-icon icon-base ti tabler-slideshow"></i>
                <div data-i18n="Sliders">Sliders</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/sliders') }}" class="menu-link">
                        <div data-i18n="All Sliders">All Sliders</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.sliders.create') }}" class="menu-link">
                        <div data-i18n="Add Slider">Add Slider</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Access Management -->
        <li class="menu-header small mt-3">
            <span class="menu-header-text" data-i18n="Access Management">Access Management</span>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon menu-icon icon-base ti ti-shield"></i>
                <div data-i18n="Roles & Permissions">Roles & Permissions</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/roles') }}" class="menu-link">
                        <div data-i18n="Roles">Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ url('admin/permissions') }}" class="menu-link">
                        <div data-i18n="Permissions">Permissions</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti tabler-users"></i>
                <div data-i18n="Users">Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{ url('admin/users') }}" class="menu-link">
                        <div data-i18n="All Users">All Users</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('admin.users.create') }}" class="menu-link">
                        <div data-i18n="Add User">Add User</div>
                    </a>
                </li>
            </ul>
        </li>

        <!-- Profile -->
        <li class="menu-item">
            <a href="{{ route('admin.profile') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-user"></i>
                <div data-i18n="Profile">Profile</div>
            </a>
        </li>

        <!-- App Settings -->
        <li class="menu-item">
            <a href="{{ route('admin.settings.index') }}" class="menu-link">
                <i class="menu-icon icon-base ti tabler-settings"></i>
                <div data-i18n="Settings">Settings</div>
            </a>
        </li>
    </ul>
</aside>
