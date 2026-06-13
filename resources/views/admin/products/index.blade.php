@extends('admin.layouts.admin')

@section('title', 'Products Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Products</h4>
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-1"></i> Add Product
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-5">
                    <form method="GET" action="{{ route('admin.products.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search products..."
                                value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-search"></i>
                            </button>
                        </div>
                        @if ($search || $categoryId || $brandId)
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
                <div class="col-md-4">
                    <form method="GET" action="{{ route('admin.products.index') }}">
                        <div class="input-group">
                            <select name="category_id" class="form-select" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $categoryId == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($search)
                                <input type="hidden" name="search" value="{{ $search }}">
                            @endif
                            @if ($brandId)
                                <input type="hidden" name="brand_id" value="{{ $brandId }}">
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form method="GET" action="{{ route('admin.products.index') }}">
                        <div class="input-group">
                            <select name="brand_id" class="form-select" onchange="this.form.submit()">
                                <option value="">All Brands</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ $brandId == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($search)
                                <input type="hidden" name="search" value="{{ $search }}">
                            @endif
                            @if ($categoryId)
                                <input type="hidden" name="category_id" value="{{ $categoryId }}">
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            @if ($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Brand</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Warranty</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th style="width: 160px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            @if ($product->media->isNotEmpty())
                                                <img src="{{ Storage::url($product->media->first()->file_path) }}"
                                                    alt="{{ $product->name }}"
                                                    class="rounded"
                                                    style="width: 40px; height: 40px; object-fit: cover; flex-shrink: 0;">
                                            @else
                                                <div class="rounded bg-label-secondary d-flex align-items-center justify-content-center"
                                                    style="width: 40px; height: 40px; flex-shrink: 0;">
                                                    <i class="icon-base ti tabler-photo text-muted" style="font-size: 1.1rem;"></i>
                                                </div>
                                            @endif
                                            <span class="fw-semibold">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $product->category?->name ?: '—' }}</td>
                                    <td>{{ $product->brand?->name ?: '—' }}</td>
                                    <td><code>{{ $product->sku ?: '—' }}</code></td>
                                    <td>{{ config('admin.currency_symbol') }}{{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->warranty_months }} mo.</td>
                                    <td>
                                        {{ $product->stock_quantity }}
                                        @if ($product->stock_quantity < config('admin.low_stock_threshold'))
                                            <span class="badge bg-label-warning ms-1">Low</span>
                                        @endif
                                    </td>
                                    <td><x-admin.status-badge :active="$product->is_active" /></td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.products.show', $product) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="View">
                                                <i class="icon-base ti tabler-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button"
                                                class="btn btn-sm btn-icon {{ $product->is_active ? 'btn-outline-warning' : 'btn-outline-success' }}"
                                                data-bs-toggle="tooltip"
                                                title="{{ $product->is_active ? 'Deactivate' : 'Activate' }}"
                                                data-toggle-url="{{ route('admin.products.toggle-status', $product) }}"
                                                onclick="toggleProductStatus(this)">
                                                <i
                                                    class="icon-base ti {{ $product->is_active ? 'tabler-pause' : 'tabler-play' }}"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-delete-name="{{ $product->name }}"
                                                data-delete-url="{{ route('admin.products.destroy', $product) }}"
                                                title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-2 px-3 border-top-0">
                    {{ $products->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-package text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No products found</h5>
                    <p class="text-muted">Try adjusting your search or filter criteria.</p>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-primary me-2">
                        <i class="icon-base ti tabler-refresh me-1"></i> Reset Filters
                    </a>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-outline-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Add Product
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('admin.partials.delete-modal')
@endsection
