@extends('client.layouts.master')

@push('styles')
<link rel="stylesheet"
  href="{{ asset('client/libs/nouislider/dist/nouislider.min.css') }}">
@endpush

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

<!-- Breadcrumb -->
<div class="container">
  <div class="row">
    <div class="col-12 py-2">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0 fw-medium">
          <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">
            Shop
          </li>
        </ol>
      </nav>
    </div>
  </div>
</div>

<!-- Mobile Filter Button (fixed bottom, hidden on desktop) -->
<div class="position-fixed bottom-0 start-50 translate-middle
            d-block d-lg-none z-3 mb-3">
  <a class="btn btn-dark d-flex align-items-center gap-2"
     data-bs-toggle="offcanvas"
     href="#offcanvasFilters"
     role="button">
    <i class="fa-solid fa-sliders"></i>
    <span>Filter</span>
  </a>
</div>

<!-- Main Section -->
<section class="py-md-6 pb-6">
  <div class="container">
    <div class="row">

      <!-- LEFT SIDEBAR col-lg-3 -->
      <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">

        <div class="offcanvas offcanvas-start offcanvas-collapse
                    w-md-50 border-end-0"
             tabindex="-1"
             id="offcanvasFilters"
             aria-labelledby="offcanvasFiltersLabel">

          <!-- Mobile-only header -->
          <div class="offcanvas-header d-lg-none">
            <h5 class="offcanvas-title" id="offcanvasFiltersLabel">
              Filters
            </h5>
            <button type="button" class="btn-close"
                    data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
          </div>

          <div class="offcanvas-body ps-lg-2 pt-lg-0">

            <form id="filter-form"
                  method="GET"
                  action="{{ route('products.index') }}">

              <input type="hidden"
                     name="sort_by"
                     id="hidden-sort-by"
                     value="{{ request('sort_by', 'newest') }}">

              <!-- FILTER SECTION 1: CATEGORY -->
              <div class="mb-3 border-bottom pb-3">
                <a class="d-flex align-items-center
                          justify-content-between text-dark
                          text-decoration-none"
                   data-bs-toggle="collapse"
                   href="#collapseCategory"
                   role="button"
                   aria-expanded="true">
                  <h5 class="mb-0 fs-6">Category</h5>
                  <i class="fa-solid fa-chevron-down"></i>
                </a>
                <div class="collapse show" id="collapseCategory">
                  <div class="mt-3">
                    @foreach ($categories as $cat)
                      <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox"
                               type="checkbox"
                               name="category_id[]"
                               value="{{ $cat->id }}"
                               id="cat-{{ $cat->id }}"
                               {{ in_array($cat->id,
                                  request()->input('category_id', []))
                                  ? 'checked' : '' }}>
                        <label class="form-check-label"
                               for="cat-{{ $cat->id }}">
                          {{ $cat->name }}
                        </label>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!-- FILTER SECTION 2: BRAND -->
              <div class="mb-3 border-bottom pb-3">
                <a class="d-flex align-items-center
                          justify-content-between text-dark
                          text-decoration-none"
                   data-bs-toggle="collapse"
                   href="#collapseBrand"
                   role="button"
                   aria-expanded="true">
                  <h5 class="mb-0 fs-6">Brand</h5>
                  <i class="fa-solid fa-chevron-down"></i>
                </a>
                <div class="collapse show" id="collapseBrand">
                  <div class="mt-3">
                    @foreach ($brands as $brand)
                      <div class="form-check mb-2">
                        <input class="form-check-input filter-checkbox"
                               type="checkbox"
                               name="brand_id[]"
                               value="{{ $brand->id }}"
                               id="brand-{{ $brand->id }}"
                               {{ in_array($brand->id,
                                  request()->input('brand_id', []))
                                  ? 'checked' : '' }}>
                        <label class="form-check-label"
                               for="brand-{{ $brand->id }}">
                          {{ $brand->name }}
                        </label>
                      </div>
                    @endforeach
                  </div>
                </div>
              </div>

              <!-- FILTER SECTION 3: PRICE RANGE -->
              <div class="mb-3 border-bottom pb-3">
                <a class="d-flex align-items-center
                          justify-content-between text-dark
                          text-decoration-none"
                   data-bs-toggle="collapse"
                   href="#collapsePrice"
                   role="button"
                   aria-expanded="true">
                  <h5 class="mb-0 fs-6">Price</h5>
                  <i class="fa-solid fa-chevron-down"></i>
                </a>
                <div class="collapse show" id="collapsePrice">
                  <div class="mt-3">

                    <div id="price-slider"
                         data-min="{{ $priceRange['min'] }}"
                         data-max="{{ $priceRange['max'] }}"
                         data-start-min="{{ request('price_min',
                                           $priceRange['min']) }}"
                         data-start-max="{{ request('price_max',
                                           $priceRange['max']) }}">
                    </div>

                    <div class="d-flex justify-content-between mt-2 small">
                      <span>$<span id="price-min-display">
                        {{ request('price_min', $priceRange['min']) }}
                      </span></span>
                      <span>$<span id="price-max-display">
                        {{ request('price_max', $priceRange['max']) }}
                      </span></span>
                    </div>

                    <input type="hidden"
                           name="price_min"
                           id="price-min-input"
                           value="{{ request('price_min',
                                    $priceRange['min']) }}">
                    <input type="hidden"
                           name="price_max"
                           id="price-max-input"
                           value="{{ request('price_max',
                                    $priceRange['max']) }}">
                  </div>
                </div>
              </div>

              <div class="d-lg-none mt-3">
                <button type="submit" class="btn btn-dark w-100">
                  Apply Filters
                </button>
              </div>

            </form>

          </div>
        </div>

      </aside>

      <!-- RIGHT CONTENT col-lg-9 -->
      <div class="col-lg-9">

        <div class="mb-4 d-flex flex-column flex-lg-row
                    justify-content-between align-items-start gap-3">

          <div class="d-flex gap-2 flex-wrap align-items-center">

            @php
              $hasFilters = request()->hasAny([
                  'brand_id', 'category_id', 'price_min', 'price_max'
              ]);
            @endphp

            @foreach (request()->input('brand_id', []) as $bid)
              @php $b = $brands->firstWhere('id', $bid); @endphp
              @if ($b)
                <a href="{{ request()->fullUrlWithQuery(
                    ['brand_id' => array_values(
                      array_diff(request()->input('brand_id',[]),[$bid])
                    )]
                  ) }}"
                   class="btn btn-sm btn-light d-flex align-items-center gap-1 text-decoration-none">
                  {{ $b->name }}
                  <i class="fa-solid fa-xmark"></i>
                </a>
              @endif
            @endforeach

            @foreach (request()->input('category_id', []) as $cid)
              @php $c = $categories->firstWhere('id', $cid); @endphp
              @if ($c)
                <a href="{{ request()->fullUrlWithQuery(
                    ['category_id' => array_values(
                      array_diff(request()->input('category_id',[]),[$cid])
                    )]
                  ) }}"
                   class="btn btn-sm btn-light d-flex align-items-center gap-1 text-decoration-none">
                  {{ $c->name }}
                  <i class="fa-solid fa-xmark"></i>
                </a>
              @endif
            @endforeach

            @if (request()->filled('price_min') || request()->filled('price_max'))
              <a href="{{ request()->fullUrlWithQuery(
                  ['price_min' => null, 'price_max' => null]
                ) }}"
                 class="btn btn-sm btn-light d-flex align-items-center gap-1 text-decoration-none">
                ${{ request('price_min', $priceRange['min']) }}
                – ${{ request('price_max', $priceRange['max']) }}
                <i class="fa-solid fa-xmark"></i>
              </a>
            @endif

            @if ($hasFilters)
              <a href="{{ route('products.index',
                  ['sort_by' => request('sort_by')]) }}"
                 class="btn btn-sm btn-link text-decoration-none p-0">
                Clear all
              </a>
            @endif

          </div>

          <div style="min-width: 200px;">
            <select id="sort-select" class="form-select form-select-sm">
              <option value="newest"
                {{ request('sort_by','newest') === 'newest' ? 'selected':'' }}>
                Sort by: Newest
              </option>
              <option value="price_asc"
                {{ request('sort_by') === 'price_asc' ? 'selected':'' }}>
                Price: Low to High
              </option>
              <option value="price_desc"
                {{ request('sort_by') === 'price_desc' ? 'selected':'' }}>
                Price: High to Low
              </option>
              <option value="name_asc"
                {{ request('sort_by') === 'name_asc' ? 'selected':'' }}>
                Name: A → Z
              </option>
              <option value="name_desc"
                {{ request('sort_by') === 'name_desc' ? 'selected':'' }}>
                Name: Z → A
              </option>
            </select>
          </div>

        </div>

        @forelse ($products as $product)
          <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
              <div class="d-flex flex-column flex-md-row">

                <div class="text-center p-3"
                     style="width:100%; max-width:220px; flex-shrink:0;">
                  <a href="{{ route('products.show', $product) }}">
                    @if ($product->media->isNotEmpty())
                      <img src="{{ Storage::url($product->media->first()->file_path) }}"
                           alt="{{ $product->name }}"
                           class="img-fluid"
                           style="max-height:180px; object-fit:contain;">
                    @else
                      <img src="{{ asset('default-image.jpg') }}"
                           alt="{{ $product->name }}"
                           class="img-fluid"
                           style="max-height:180px; object-fit:contain;">
                    @endif
                  </a>
                </div>

                <div class="card-body d-flex flex-column justify-content-between">

                  <div>
                    <span class="small fw-semibold text-uppercase text-muted">
                      {{ $product->brand?->name ?? '' }}
                    </span>

                    <h5 class="mt-1 mb-1">
                      <a href="{{ route('products.show', $product) }}"
                         class="text-decoration-none text-dark">
                        {{ $product->name }}
                      </a>
                    </h5>

                    @if ($product->category)
                      <span class="badge bg-light text-dark border mb-2">
                        {{ $product->category->name }}
                      </span>
                    @endif

                    <div class="fw-bold fs-5 mb-3">
                      ${{ number_format($product->price, 2) }}
                    </div>
                  </div>

                  <div>
                    <form method="POST" action="{{ route('cart.add') }}">
                      @csrf
                      <input type="hidden"
                             name="product_id"
                             value="{{ $product->id }}">
                      <input type="hidden" name="qty" value="1">
                      <button type="submit"
                              class="btn btn-dark btn-sm px-4">
                        <i class="fa-solid fa-cart-plus me-1"></i>
                        Add to Cart
                      </button>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>
        @empty
          <div class="col-12 text-center py-5">
            <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
            <p class="text-muted fs-5">No products match your filters.</p>
            <a href="{{ route('products.index') }}"
               class="btn btn-outline-dark btn-sm">
              Clear Filters
            </a>
          </div>
        @endforelse

        <div class="mt-5">
          {{ $products->links('vendor.pagination.client') }}
        </div>

      </div>

    </div>
  </div>
</section>
@endsection

@push('scripts')
    <script src="{{ asset('client/libs/nouislider/dist/nouislider.min.js') }}"></script>
    <script src="{{ asset('client/js/shop.js') }}"></script>
@endpush

