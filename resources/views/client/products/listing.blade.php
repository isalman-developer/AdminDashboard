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
                                <li class="breadcrumb-item"><a class="text-decoration-none" href="index-2.html">Home</a></li>
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
                            <a href="shop-list.html">
                                <img src="{{ asset('client/images/icons/list-view.jpg') }}" alt="grid-view">
                            </a>
                            <a href="shop.html">
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
                {{-- products listig --}}
                @forelse ($products as $product)
                    <div class="col-md-4 col-sm-6 col-6">
                        <div class="mg-tab-grid-box">
                            <div class="mg-tab-img-box">
                                <div class="mg-tabs-img">
                                                            <a href="{{ route('products.show', $product) }}">
                                                                                                <img src="{{ showImage($product->files[0]->path) }}" alt="{{ $product->id . '-pic' }}">
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
                                <div class="mg-tab-text-top d-flex justify-content-between align-items-center">
                                    <div class="mg-small-heading">
                                        <a class="text-decoration-none" href="shop.html">
                                            <span>{{ $product->brand->title ?? '' }} - {{ $product->series ?? '' }}</span>
                                        </a>
                                    </div>
                                </div>
                                                                <a class="text-decoration-none" href="{{ route('products.show', $product) }}">
                                                                    <h5>{{ Str::limit($product->title ?? '', 20, '..') }}</h5>
                                </a>
                                <div class="mg-pricing">{{ $product->price }}</div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        No Products Found..
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
    <!--Category top rated products and text overlay section start here-->
    <div>
        <div class="container">
            <div class="mg-custom-section2">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-sm-5 col-12">
                        <div class="mg-category">
                            <div class="mg-category-heading">
                                <h5>Category</h5>
                            </div>
                            <ul class="list-group">
                                @foreach ($brands as $brand)
                                    <li class="list-group-item">
                                                                        <a href="javascript:void(0);">{{ $brand['title'] ?? '' }}
                                                                            ({{ \App\Models\Product::whereStatus(true)->where('brand_id', $brand['id'])->count() }})
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
                                        $top_rated_products = App\Models\Product::where(['status' => true, 'marked_as_id' => '5'])
                                        ->select('id','title','price','series','brand_id')
                                        ->with(['brand:id,title','media' => function($media){
                                            $media->select('id','mediable_id','file_path');
                                        }])
                                        ->inRandomOrder()->take(3)->get();
                                    @endphp
                                    @foreach ($top_rated_products as $trproduct)
                                    <div class="col-md-12 col-sm-12 col-12">
                                        <div class="mg-toprated-grid">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4 col-3">
                                                    <div class="mg-toprated-thumb-img">
                                                                <a href="{{ route('products.show', $trproduct) }}">
                                                                     <img src="{{ showImage($trproduct->media->first()->file_path ?? '') }}" alt="{{ $trproduct->id.'top-rated' }}">
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 col-sm-8 col-9 ps-0 mt-2 mt-md-0 mt-sm-1">
                                                    <div class="mg-toprated-text">
                                                        <a href="shop.html"><span>
                                                            {{ $trproduct->brand->title .'-'.$trproduct->series }}
                                                        </span></a>
                                                                <a class="text-decoration-none" href="{{ route('products.show', $trproduct) }}">
                                                                    <h6>{{ $trproduct->title }} (9th Gen)</h6>
                                                        </a>
                                                        <div class="mg-pricing">{{ $trproduct->price }}</div>
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
                                        $tdProduct = App\Models\Product::whereStatus(true)
                                        ->with(['brand:id,title', 'media' => function($media){
                                            $media->select('id','file_path');
                                        }])
                                        ->select('id','title','series','brand_id')->first();
                                    @endphp
                                    @isset($tdProduct )
                                    <span>TOP DEALS</span>
                                        <h6>{{ $tdProduct->brand->title ?? ''  }} - {{ $tdProduct->series }} <br>
                                            {{$tdProduct->title }}
                                        </h6>
                                        <a class="btn btn-lg" href="shop.html">
                                            SHOP NOW
                                            <i class="fa-solid fa-angle-right"></i>
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
    <!--Category top rated products and text overlay section end here-->
    <!--Feature section 2 start here-->
    @include('client.partials.features')

    <!--Feature section 2 end here-->
@endsection

@push('scripts')
    <script src="{{ asset('client/js/shop.js') }}"></script>
@endpush
