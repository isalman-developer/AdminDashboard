@extends('client.layouts.master')

@push('styles')
<link rel="stylesheet" href="{{ asset('client/libs/bootstrap-icons/font/bootstrap-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/libs/simplebar/dist/simplebar.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/libs/nouislider/dist/nouislider.min.css') }}">
<link rel="stylesheet" href="{{ asset('client/css/theme.min.css') }}">
<style>
    /* Sidebar always visible on desktop */
    @media (min-width: 992px) {
        .offcanvas-collapse {
            background-color: transparent;
            bottom: auto !important;
            display: block;
            height: auto !important;
            left: auto !important;
            position: static;
            right: auto !important;
            top: auto !important;
            transform: none !important;
            visibility: visible;
            width: 100% !important;
        }
        .offcanvas-collapse .offcanvas-body {
            overflow-y: visible;
            padding: 0;
        }
    }

    /* Nouislider connect bar colour */
    .noUi-connect { background: #211f1c; }
    .noUi-handle { border-radius: 50%; }
    .noUi-target { border-radius: 4px; }
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="mg-page-header-section mg-page-header-style">
    <div class="mg-page-header-inner">
        <div class="container">
            <div class="mg-page-header-text">
                <div class="mg-page-header-heading">
                    <h3>Shop Our Products</h3>
                </div>
                <div class="mg-breadcrumb">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a class="text-decoration-none" href="{{ route('home') }}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Shop</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Mobile filter button (fixed bottom, desktop hidden) --}}
<div class="position-fixed bottom-0 start-50 translate-middle d-block d-lg-none z-3 mb-3">
    <a class="btn btn-dark d-flex align-items-center gap-2"
       data-bs-toggle="offcanvas"
       href="#offcanvasCategory"
       role="button"
       aria-controls="offcanvasCategory">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
             class="bi bi-sliders2" viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                  d="M10.5 1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4H1.5a.5.5 0 0 1 0-1H10V1.5a.5.5 0 0 1 .5-.5M12 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-6.5 2A.5.5 0 0 1 6 6v1.5h8.5a.5.5 0 0 1 0 1H6V10a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M1 8a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 1 8m9.5 2a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V13H1.5a.5.5 0 0 1 0-1H10v-1.5a.5.5 0 0 1 .5-.5m1.5 2.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5" />
        </svg>
        <span>Filter</span>
    </a>
</div>

{{-- Main shop section --}}
<section class="py-md-6 pb-6">
    <div class="container">
        <div class="row">

            {{-- ══════════════════════════════
                 LEFT SIDEBAR — Filter Panel
            ══════════════════════════════ --}}
            <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
                <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50 border-end-0"
                     tabindex="-1"
                     id="offcanvasCategory"
                     aria-labelledby="offcanvasCategoryLabel">

                    {{-- Mobile close header --}}
                    <div class="offcanvas-header d-lg-none">
                        <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>

                    <div class="offcanvas-body ps-lg-2 pt-lg-0">
                        <form id="filter-form" method="GET" action="{{ route('products.index') }}">

                            {{-- preserve sort across filter changes --}}
                            <input type="hidden" name="sort_by" id="hidden-sort-by"
                                   value="{{ request('sort_by', 'newest') }}">

                            {{-- ── CATEGORY ── --}}
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between"
                                   data-bs-toggle="collapse"
                                   href="#collapseCategory"
                                   role="button"
                                   aria-expanded="true"
                                   aria-controls="collapseCategory">
                                    <h5 class="mb-0 fs-6">Category</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show mt-3" id="collapseCategory">
                                    @forelse ($categories as $cat)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input filter-checkbox"
                                                   type="checkbox"
                                                   name="category_id[]"
                                                   value="{{ $cat->id }}"
                                                   id="cat-{{ $cat->id }}"
                                                   {{ in_array($cat->id, (array) request()->input('category_id', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cat-{{ $cat->id }}">
                                                {{ $cat->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p class="text-muted small mb-0">No categories found.</p>
                                    @endforelse
                                </div>
                            </div>

                            {{-- ── BRAND ── --}}
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between"
                                   data-bs-toggle="collapse"
                                   href="#collapseBrand"
                                   role="button"
                                   aria-expanded="true"
                                   aria-controls="collapseBrand">
                                    <h5 class="mb-0 fs-6">Brand</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show mt-3" id="collapseBrand">
                                    @forelse ($brands as $brand)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input filter-checkbox"
                                                   type="checkbox"
                                                   name="brand_id[]"
                                                   value="{{ $brand->id }}"
                                                   id="brand-{{ $brand->id }}"
                                                   {{ in_array($brand->id, (array) request()->input('brand_id', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="brand-{{ $brand->id }}">
                                                {{ $brand->name }}
                                            </label>
                                        </div>
                                    @empty
                                        <p class="text-muted small mb-0">No brands found.</p>
                                    @endforelse
                                </div>
                            </div>

                            {{-- ── PRICE RANGE ── --}}
                            <div class="mb-3 border-bottom pb-3">
                                <a class="d-flex align-items-center justify-content-between"
                                   data-bs-toggle="collapse"
                                   href="#collapsePrice"
                                   role="button"
                                   aria-expanded="true"
                                   aria-controls="collapsePrice">
                                    <h5 class="mb-0 fs-6">Price</h5>
                                    <i class="bi bi-chevron-down chevron-down"></i>
                                </a>
                                <div class="collapse show mt-3" id="collapsePrice">
                                    <div id="price-slider"
                                         data-min="{{ $priceRange['min'] }}"
                                         data-max="{{ $priceRange['max'] }}"
                                         data-start-min="{{ request('price_min', $priceRange['min']) }}"
                                         data-start-max="{{ request('price_max', $priceRange['max']) }}"
                                         class="mb-3">
                                    </div>
                                    <span id="priceRange-value" class="small d-flex justify-content-between text-muted">
                                        <span>$<span id="price-min-display">{{ request('price_min', $priceRange['min']) }}</span></span>
                                        <span>$<span id="price-max-display">{{ request('price_max', $priceRange['max']) }}</span></span>
                                    </span>
                                    <input type="hidden" name="price_min" id="price-min-input"
                                           value="{{ request('price_min', $priceRange['min']) }}">
                                    <input type="hidden" name="price_max" id="price-max-input"
                                           value="{{ request('price_max', $priceRange['max']) }}">
                                </div>
                            </div>

                            {{-- Mobile: Apply button --}}
                            <div class="d-lg-none mt-3">
                                <button type="submit" class="btn btn-dark w-100">Apply Filters</button>
                            </div>

                        </form>
                    </div>
                </div>
            </aside>

            {{-- ══════════════════════════════
                 RIGHT — Toolbar + Product List
            ══════════════════════════════ --}}
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-12">

                        {{-- Toolbar: active filter pills + sort --}}
                        <div class="mb-4 d-flex flex-column flex-lg-row justify-content-between gap-4">

                            {{-- Active filter pills --}}
                            <div class="d-flex gap-2 flex-wrap align-items-center">

                                @php
                                    $hasFilters = request()->hasAny(['brand_id', 'category_id', 'price_min', 'price_max']);
                                @endphp

                                @foreach ((array) request()->input('brand_id', []) as $bid)
                                    @php $b = $brands->firstWhere('id', $bid); @endphp
                                    @if ($b)
                                        <a href="{{ request()->fullUrlWithQuery(['brand_id' => array_values(array_diff((array) request()->input('brand_id', []), [$bid]))]) }}"
                                           class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                            {{ $b->name }}
                                            <i class="bi bi-x lh-1"></i>
                                        </a>
                                    @endif
                                @endforeach

                                @foreach ((array) request()->input('category_id', []) as $cid)
                                    @php $c = $categories->firstWhere('id', $cid); @endphp
                                    @if ($c)
                                        <a href="{{ request()->fullUrlWithQuery(['category_id' => array_values(array_diff((array) request()->input('category_id', []), [$cid]))]) }}"
                                           class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                            {{ $c->name }}
                                            <i class="bi bi-x lh-1"></i>
                                        </a>
                                    @endif
                                @endforeach

                                @if (request()->filled('price_min') || request()->filled('price_max'))
                                    <a href="{{ request()->fullUrlWithQuery(['price_min' => null, 'price_max' => null]) }}"
                                       class="btn btn-sm btn-light d-flex align-items-center gap-2">
                                        ${{ request('price_min', $priceRange['min']) }} – ${{ request('price_max', $priceRange['max']) }}
                                        <i class="bi bi-x lh-1"></i>
                                    </a>
                                @endif

                                @if ($hasFilters)
                                    <a href="{{ route('products.index', ['sort_by' => request('sort_by')]) }}"
                                       class="btn btn-sm btn-focus-none text-muted">
                                        Clear all
                                    </a>
                                @endif

                            </div>

                            {{-- Sort dropdown (Choices.js) --}}
                            <div class="col-sm-4 col-xxl-3">
                                <select id="sort-select" data-choices class="form-select" aria-label="Sort products">
                                    <option value="newest"    {{ request('sort_by', 'newest') === 'newest'    ? 'selected' : '' }}>Sort by: Newest</option>
                                    <option value="price_asc" {{ request('sort_by') === 'price_asc'           ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_desc"{{ request('sort_by') === 'price_desc'          ? 'selected' : '' }}>Price: High to Low</option>
                                    <option value="name_asc"  {{ request('sort_by') === 'name_asc'            ? 'selected' : '' }}>Name: A → Z</option>
                                    <option value="name_desc" {{ request('sort_by') === 'name_desc'           ? 'selected' : '' }}>Name: Z → A</option>
                                </select>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Product list --}}
                <div class="row">
                    @forelse ($products as $product)
                        @php
                            $imgSrc = $product->media->isNotEmpty()
                                ? Storage::url($product->media->first()->file_path)
                                : asset('default-image.jpg');
                        @endphp

                        <div class="col-12 mb-6">
                            <div class="product-card d-flex flex-column flex-md-row align-items-center gap-4 gap-md-0">

                                {{-- Image --}}
                                <div class="text-center product-card-img col-lg-4 col-md-5">
                                    <a href="{{ route('products.show', $product) }}">
                                        <img src="{{ $imgSrc }}"
                                             alt="{{ $product->name }}"
                                             class="img-fluid" />
                                        <img src="{{ $imgSrc }}"
                                             alt="{{ $product->name }}"
                                             class="img-fluid product-img-hover" />
                                    </a>
                                </div>

                                {{-- Details --}}
                                <div class="col-lg-8 col-md-7 ps-md-6">

                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="d-flex flex-column">
                                            <span class="small fw-medium text-uppercase">
                                                {{ $product->brand?->name ?? '' }}
                                            </span>
                                            @if ($product->category)
                                                <span class="small text-muted">{{ $product->category->name }}</span>
                                            @endif
                                        </div>
                                        <div>
                                            <button type="button"
                                                    class="btn btn-light bg-transparent border-0 p-0 animate-pulse"
                                                    title="Add to wishlist">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                     fill="currentColor" class="bi bi-heart animate-target"
                                                     viewBox="0 0 16 16">
                                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <h3 class="fs-6 mb-0 product-heading d-inline-block text-truncate">
                                            <a href="{{ route('products.show', $product) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <p class="mb-0 lh-1 text-dark fw-semibold">
                                            ${{ number_format($product->price, 2) }}
                                        </p>
                                    </div>

                                    @if ($product->description)
                                        <div class="mb-4">
                                            <p>{{ Str::limit(strip_tags($product->description), 130) }}</p>
                                        </div>
                                    @endif

                                    <div class="d-flex align-items-center gap-4">
                                        <form method="POST" action="{{ route('cart.add') }}">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <input type="hidden" name="qty" value="1">
                                            <button type="submit"
                                                    class="btn btn-primary product-card-btn quick-add-btn"
                                                    data-product-name="{{ $product->name }}"
                                                    data-product-price="{{ $product->price }}"
                                                    data-product-img="{{ $imgSrc }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                     fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                </svg>
                                                Add to Cart
                                            </button>
                                        </form>
                                        <a href="{{ route('products.show', $product) }}" class="text-link">
                                            View details
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    @empty
                        <div class="col-12 text-center py-6">
                            <i class="bi bi-box-seam fs-1 text-muted d-block mb-3"></i>
                            <p class="text-muted fs-5 mb-3">No products match your filters.</p>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-sm px-4">
                                Clear Filters
                            </a>
                        </div>
                    @endforelse

                    {{-- Pagination --}}
                    <div class="col-12 mt-8">
                        {{ $products->links('vendor.pagination.client') }}
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
    <script src="{{ asset('client/libs/nouislider/dist/nouislider.min.js') }}"></script>
    <script src="{{ asset('client/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script src="{{ asset('client/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ asset('client/js/shop.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Init Choices.js on the sort select
            var sortEl = document.getElementById('sort-select');
            if (sortEl && typeof Choices !== 'undefined') {
                new Choices(sortEl, { searchEnabled: false, itemSelectText: '' });
            }
        });
    </script>
@endpush
