@extends('client.layouts.master')
@section('content')
    <!--page header start here-->
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
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item active">Shop</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page header end here-->
    <!--grid filter section start here-->
    <div class="mg-grid-filter-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-lg-3 col-sm-12 col-12 mb-sm-1 mt-sm-1">
                    <div class="mg-select-range">
                        <select class="form-select mg-font-style" aria-label="Default select example">
                            <option selected>PRICE: LOW TO HIGH</option>
                            <option value="PRICE:HIGH TO LOW">PRICE: HIGH TO LOW</option>
                            <option value="POPULARITY">POPULARITY</option>
                            <option value="NEWEST">NEWEST</option>
                            <option value="RELEVANCE">RELEVANCE</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-5 col-lg-5 col-sm-6 col-12 mb-sm-1 mt-sm-2">
                    <div class="mg-grid-filter-inner">
                        <form>
                            <div class="mg-filter-main">
                                <div class="mg-range-slide">
                                    <div class="mg-range-heading">
                                        <span>Filter by price</span>
                                    </div>
                                    <div class="mg-range-bar">
                                        <div class="mg-price-filter-range"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-sm-6 col-12 mb-sm-1 mt-sm-2">
                    <div class="mg-price-grid-main">
                        <div class="mg-range-price mg-font-style">
                            <span class="mg-rp-heading">Price:</span>
                            <span class="mg-min-price">$25k</span>
                            <span>-</span>
                            <span class="mg-max-price">$30k</span>
                        </div>
                        <div class="mg-grid-icons">
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('client/images/icons/list-view.jpg') }}" alt="grid-view">
                            </a>
                            <a href="{{ route('products.index') }}">
                                <img src="{{ asset('client/images/icons/grid-view.jpg') }}" alt="list-view">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--grid filter section end here-->
    <!--grid section start here-->
    <div class="mg-grid-section">
        <div class="container">
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="mg-tab-grid-box">
                            <div class="mg-tab-img-box">
                                <div class="mg-tabs-img">
                                    <a href="{{ route('products.show', $product) }}">
                                        @if ($product->media->isNotEmpty())
                                            <img src="{{ Storage::url($product->media->first()->file_path) }}"
                                                alt="{{ $product->name }}">
                                        @else
                                            <img src="{{ asset('default-image.jpg') }}" alt="{{ $product->name }}">
                                        @endif
                                    </a>
                                </div>
                                <div class="mg-atc-overlay">
                                    <form method="POST" action="{{ route('cart.add') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="qty" value="1">
                                        <button type="submit" class="mg-cart-box" style="border:none;background:none;width:100%;cursor:pointer;">ADD TO CART</button>
                                    </form>
                                </div>
                            </div>
                            <div class="mg-tab-text mt-3">
                                <div class="mg-tab-text-top d-flex justify-content-between align-items-center">
                                    <div class="mg-small-heading">
                                        <a class="text-decoration-none" href="{{ route('products.index') }}">
                                            <span>{{ $product->brand?->name ?? '' }}</span>
                                        </a>
                                    </div>
                                </div>
                                <a class="text-decoration-none" href="{{ route('products.show', $product) }}">
                                    <h5>{{ Str::limit($product->name, 30, '..') }}</h5>
                                </a>
                                <div class="mg-pricing">${{ number_format($product->price, 2) }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <p class="text-muted">No products found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    <!--grid section end here-->
    <!--pagination section start here-->
    <div class="mg-pagination-section">
        <div class="container">
            {{ $products->links('vendor.pagination.client') }}
        </div>
    </div>
    <!--pagination section end here-->
    <!--Category sidebar and top rated products section start here-->
    <div>
        <div class="container">
            <div class="mg-custom-section2">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-5 col-12">
                        <div class="mg-category">
                            <div class="mg-category-heading">
                                <h5>Brands</h5>
                            </div>
                            <ul class="list-group">
                                @foreach ($brands as $brand)
                                    <li class="list-group-item">
                                        <a href="javascript:void(0);">
                                            {{ $brand->name }}
                                            ({{ \App\Models\Product::where('is_active', true)->where('brand_id', $brand->id)->count() }})
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-5 col-sm-7 col-12">
                        <div class="mg-toprated-grid2">
                            <div class="mg-toprated-heading">
                                <h5>Top Rated Products</h5>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @php
                                        $top_rated_products = \App\Models\Product::where('is_active', true)
                                            ->select('id', 'name', 'price', 'brand_id', 'slug')
                                            ->with([
                                                'brand:id,name',
                                                'media' => fn ($q) => $q->where('file_type', 'image'),
                                            ])
                                            ->inRandomOrder()->take(3)->get();
                                    @endphp
                                    @foreach ($top_rated_products as $trproduct)
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="mg-toprated-grid">
                                                <div class="row">
                                                    <div class="col-md-4 col-sm-4 col-3">
                                                        <div class="mg-toprated-thumb-img">
                                                            <a href="{{ route('products.show', $trproduct) }}">
                                                                @if ($trproduct->media->isNotEmpty())
                                                                    <img src="{{ Storage::url($trproduct->media->first()->file_path) }}"
                                                                        alt="{{ $trproduct->name }}">
                                                                @else
                                                                    <img src="{{ asset('default-image.jpg') }}"
                                                                        alt="{{ $trproduct->name }}">
                                                                @endif
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 col-sm-8 col-9 ps-0 mt-2 mt-md-0 mt-sm-1">
                                                        <div class="mg-toprated-text">
                                                            <a href="{{ route('products.show', $trproduct) }}"
                                                                class="text-decoration-none">
                                                                <h6>{{ $trproduct->name }}</h6>
                                                            </a>
                                                            <div class="mg-pricing">${{ number_format($trproduct->price, 2) }}</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                        <div class="mg-text-bg-style3 mg-text-bg-image3">
                            <div class="mg-img-bg-text">
                                <div>
                                    @php
                                        $tdProduct = \App\Models\Product::where('is_active', true)
                                            ->with(['brand:id,name'])
                                            ->select('id', 'name', 'brand_id', 'slug')->first();
                                    @endphp
                                    @isset($tdProduct)
                                        <span>TOP DEALS</span>
                                        <h6>{{ $tdProduct->brand?->name ?? '' }} <br> {{ $tdProduct->name }}</h6>
                                        <a class="btn btn-lg" href="{{ route('products.index') }}">
                                            SHOP NOW <i class="fa-solid fa-angle-right"></i>
                                        </a>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Category sidebar and top rated products section end here-->

    @include('client.partials.features')
@endsection

@push('scripts')
    <script src="{{ asset('client/js/shop.js') }}"></script>
@endpush
