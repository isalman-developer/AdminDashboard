@extends('client.layouts.master')

@push('styles')
<style>
    /* ── Product gallery ───────────────────────────────────── */
    .mg-product-main-img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        transition: opacity .2s ease;
    }

    .mg-thumb-strip {
        display: flex;
        gap: 10px;
        margin-top: 12px;
        flex-wrap: wrap;
    }

    .mg-thumb-item {
        width: 72px;
        height: 72px;
        border: 2px solid transparent;
        border-radius: 4px;
        overflow: hidden;
        cursor: pointer;
        transition: border-color .15s;
    }

    .mg-thumb-item:hover,
    .mg-thumb-item.active {
        border-color: #222;
    }

    .mg-thumb-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* ── Product info ─────────────────────────────────────── */
    .mg-product-title {
        font-size: 1.6rem;
        font-weight: 700;
        line-height: 1.2;
    }

    .mg-product-brand {
        font-size: .85rem;
        color: #888;
        margin-bottom: .5rem;
    }

    .mg-product-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: #222;
    }

    .mg-badge-stock {
        font-size: .75rem;
        padding: .3rem .65rem;
        border-radius: 20px;
    }

    .mg-badge-stock.in-stock  { background: #d4edda; color: #155724; }
    .mg-badge-stock.out-stock { background: #f8d7da; color: #721c24; }

    /* ── Tabs ─────────────────────────────────────────────── */
    .mg-product-tabs .nav-link {
        color: #555;
        font-weight: 600;
        border: none;
        border-bottom: 2px solid transparent;
        padding: .6rem 1.1rem;
        background: transparent;
    }

    .mg-product-tabs .nav-link.active {
        color: #222;
        border-bottom-color: #222;
    }

    /* ── Related products ─────────────────────────────────── */
    .mg-related-section {
        padding: 50px 0;
        background: #f8f9fa;
    }

    .mg-related-section .mg-tab-grid-box {
        background: #fff;
        border-radius: 6px;
        overflow: hidden;
        transition: box-shadow .2s;
    }

    .mg-related-section .mg-tab-grid-box:hover {
        box-shadow: 0 4px 18px rgba(0,0,0,.1);
    }

    .mg-related-img-box {
        position: relative;
        overflow: hidden;
        aspect-ratio: 1 / 1;
        background: #f5f5f5;
    }

    .mg-related-img-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .3s;
    }

    .mg-related-img-box:hover img {
        transform: scale(1.04);
    }

    .mg-related-info {
        padding: 12px;
    }

    .mg-related-info h6 {
        font-size: .9rem;
        font-weight: 600;
        margin-bottom: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .mg-related-info .mg-pricing {
        font-weight: 700;
        color: #222;
    }

    /* ── no-image placeholder ─────────────────────────────── */
    .mg-no-image {
        width: 100%;
        aspect-ratio: 1 / 1;
        background: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        color: #aaa;
        font-size: 4rem;
    }
</style>
@endpush

@section('content')

    {{-- ── Breadcrumb ───────────────────────────────────────────── --}}
    <div class="mg-page-header-section mg-page-header-style">
        <div class="mg-page-header-inner">
            <div class="container">
                <div class="mg-page-header-text">
                    <div class="mg-page-header-heading">
                        <h3>{{ $product->name }}</h3>
                    </div>
                    <div class="mg-breadcrumb">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none" href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-decoration-none" href="{{ route('products.index') }}">Shop</a>
                                </li>
                                <li class="breadcrumb-item active">{{ Str::limit($product->name, 30) }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ── Main product section ─────────────────────────────────── --}}
    <section class="py-5">
        <div class="container">
            <div class="row g-5">

                {{-- Left: image gallery --}}
                <div class="col-lg-6">
                    @php $images = $product->media @endphp

                    @if ($images->isNotEmpty())
                        <img id="mg-main-img"
                            src="{{ Storage::url($images->first()->file_path) }}"
                            alt="{{ $product->name }}"
                            class="mg-product-main-img">

                        @if ($images->count() > 1)
                            <div class="mg-thumb-strip" id="mg-thumb-strip">
                                @foreach ($images as $img)
                                    <div class="mg-thumb-item {{ $loop->first ? 'active' : '' }}"
                                        onclick="mgSwapImage(this, '{{ Storage::url($img->file_path) }}')">
                                        <img src="{{ Storage::url($img->file_path) }}" alt="thumb {{ $loop->iteration }}">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    @else
                        <div class="mg-no-image">
                            <i class="fa-regular fa-image"></i>
                        </div>
                    @endif
                </div>

                {{-- Right: product info --}}
                <div class="col-lg-6">
                    <p class="mg-product-brand">
                        {{ $product->brand?->name ?: '' }}
                        @if ($product->category?->name)
                            &nbsp;·&nbsp; {{ $product->category->name }}
                        @endif
                    </p>

                    <h1 class="mg-product-title mb-3">{{ $product->name }}</h1>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="mg-product-price">
                            ${{ number_format($product->price, 2) }}
                        </span>
                        @if ($product->stock_quantity > 0)
                            <span class="mg-badge-stock in-stock">
                                <i class="fa-solid fa-circle-check me-1"></i> In Stock
                            </span>
                        @else
                            <span class="mg-badge-stock out-stock">
                                <i class="fa-solid fa-circle-xmark me-1"></i> Out of Stock
                            </span>
                        @endif
                    </div>

                    @if ($product->description)
                        <p class="text-muted mb-4" style="line-height:1.7;">
                            {{ Str::limit($product->description, 220) }}
                        </p>
                    @endif

                    <hr>

                    {{-- Quantity + CTA --}}
                    <form method="POST" action="{{ route('cart.add') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="d-flex align-items-center gap-3 mb-4">
                            <div class="d-flex align-items-center border rounded px-2 py-1">
                                <button type="button" class="btn btn-link p-0 text-dark text-decoration-none fs-5 lh-1"
                                    onclick="mgQty(-1)">−</button>
                                <input type="number" id="mg-qty" name="qty" value="1" min="1"
                                    max="{{ $product->stock_quantity ?: 99 }}"
                                    class="form-control form-control-sm border-0 text-center p-0 mx-2"
                                    style="width:42px;">
                                <button type="button" class="btn btn-link p-0 text-dark text-decoration-none fs-5 lh-1"
                                    onclick="mgQty(1)">+</button>
                            </div>
                        </div>
                        <div class="d-flex gap-2 flex-wrap">
                            @if($product->stock_quantity > 0)
                                <button type="submit" class="btn btn-dark px-4" style="min-width:150px;">
                                    <i class="fa-solid fa-cart-shopping me-2"></i>Add to Cart
                                </button>
                            @else
                                <button type="button" class="btn btn-secondary px-4" disabled style="min-width:150px;">
                                    Out of Stock
                                </button>
                            @endif
                        </div>
                    </form>

                    <hr class="mt-4">

                    {{-- Quick specs --}}
                    <dl class="row mb-0 small text-muted">
                        @if ($product->sku)
                            <dt class="col-5">SKU</dt>
                            <dd class="col-7"><code>{{ $product->sku }}</code></dd>
                        @endif
                        @if ($product->warranty_months)
                            <dt class="col-5">Warranty</dt>
                            <dd class="col-7">{{ $product->warranty_months }} months</dd>
                        @endif
                        <dt class="col-5">Category</dt>
                        <dd class="col-7">{{ $product->category?->name ?: '—' }}</dd>
                    </dl>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Tabs: Description / Details ────────────────────────── --}}
    <section class="py-5 border-top">
        <div class="container">
            <ul class="nav mg-product-tabs mb-4" id="productTabNav" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="desc-tab" data-bs-toggle="tab"
                        data-bs-target="#desc-pane" type="button" role="tab">
                        Description
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="details-tab" data-bs-toggle="tab"
                        data-bs-target="#details-pane" type="button" role="tab">
                        Details
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="productTabContent">
                <div class="tab-pane fade show active" id="desc-pane" role="tabpanel">
                    @if ($product->description)
                        <p style="max-width:720px;line-height:1.8;">{{ $product->description }}</p>
                    @else
                        <p class="text-muted">No description provided for this product.</p>
                    @endif
                </div>

                <div class="tab-pane fade" id="details-pane" role="tabpanel">
                    <table class="table table-bordered table-sm" style="max-width:500px;">
                        <tbody>
                            <tr>
                                <th style="width:160px;">Product Name</th>
                                <td>{{ $product->name }}</td>
                            </tr>
                            @if ($product->sku)
                                <tr>
                                    <th>SKU</th>
                                    <td><code>{{ $product->sku }}</code></td>
                                </tr>
                            @endif
                            <tr>
                                <th>Price</th>
                                <td>${{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <th>Stock</th>
                                <td>{{ $product->stock_quantity }} units</td>
                            </tr>
                            @if ($product->warranty_months)
                                <tr>
                                    <th>Warranty</th>
                                    <td>{{ $product->warranty_months }} months</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Brand</th>
                                <td>{{ $product->brand?->name ?: '—' }}</td>
                            </tr>
                            <tr>
                                <th>Category</th>
                                <td>{{ $product->category?->name ?: '—' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Related Products ────────────────────────────────────── --}}
    @if ($related->isNotEmpty())
        <section class="mg-related-section">
            <div class="container">
                <div class="mg-section-heading text-center mb-4">
                    <h5>You May Also Like</h5>
                </div>
                <div class="row g-3">
                    @foreach ($related as $item)
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="mg-tab-grid-box">
                                <div class="mg-related-img-box">
                                    <a href="{{ route('products.show', $item) }}">
                                        @if ($item->media->isNotEmpty())
                                            <img src="{{ Storage::url($item->media->first()->file_path) }}"
                                                alt="{{ $item->name }}">
                                        @else
                                            <div style="width:100%;height:100%;background:#eee;display:flex;align-items:center;justify-content:center;color:#bbb;font-size:2rem;">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                                <div class="mg-related-info">
                                    @if ($item->brand?->name)
                                        <div class="small text-muted mb-1">{{ $item->brand->name }}</div>
                                    @endif
                                    <h6>
                                        <a class="text-decoration-none text-dark"
                                            href="{{ route('products.show', $item) }}">
                                            {{ $item->name }}
                                        </a>
                                    </h6>
                                    <div class="mg-pricing">${{ number_format($item->price, 2) }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('client.partials.features')

@endsection

@push('scripts')
<script>
    function mgSwapImage(thumbEl, src) {
        var mainImg = document.getElementById('mg-main-img');
        if (!mainImg) return;
        mainImg.style.opacity = '0.6';
        setTimeout(function () {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 120);
        document.querySelectorAll('.mg-thumb-item').forEach(function (t) {
            t.classList.remove('active');
        });
        thumbEl.classList.add('active');
    }

    function mgQty(delta) {
        var input = document.getElementById('mg-qty');
        if (!input) return;
        var val = parseInt(input.value, 10) + delta;
        var min = parseInt(input.min, 10) || 1;
        var max = parseInt(input.max, 10) || 9999;
        input.value = Math.min(Math.max(val, min), max);
    }
</script>
@endpush
