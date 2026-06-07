@extends('admin.layouts.admin')

@section('title', $brand->name)

@section('content')
    <div class="row">
        <!-- Brand Info Column -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Brand Details</h4>
                </div>
                <div class="card-body text-center">
                    @if ($logo)
                        <div class="avatar avatar-xl mx-auto mb-3 border rounded-circle p-2">
                            <img src="{{ asset('storage/' . $logo->file_path) }}" alt="{{ $brand->name }}"
                                class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                    @else
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                                <i class="icon-base ti tabler-barcode"></i>
                            </span>
                        </div>
                    @endif
                    <h5>{{ $brand->name }}</h5>
                    <p class="text-muted mb-2">{{ $brand->slug }}</p>
                    <div class="mb-3">
                        @if ($brand->is_active)
                            <span class="badge bg-label-success">Active</span>
                        @else
                            <span class="badge bg-label-secondary">Inactive</span>
                        @endif
                    </div>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            @if ($brand->website)
                                <tr>
                                    <td style="width: 120px;"><strong>Website</strong></td>
                                    <td><a href="{{ $brand->website }}" target="_blank" rel="noopener">{{ $brand->website }}</a></td>
                                </tr>
                            @endif
                            <tr>
                                <td><strong>Products</strong></td>
                                <td><span class="badge bg-label-info">{{ $brand->products_count }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $brand->created_at->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated</strong></td>
                                <td>{{ $brand->updated_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-flex gap-2 justify-content-center mt-2">
                        <a href="{{ route('admin.brands.edit', $brand) }}" class="btn btn-outline-primary btn-sm">
                            <i class="icon-base ti tabler-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="icon-base ti tabler-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description & Products Column -->
        <div class="col-lg-8">
            @if ($brand->description)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-info-circle me-2"></i>Description
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $brand->description }}</p>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Products in this Brand</h4>
                    <a href="{{ route('admin.products.create', ['brand_id' => $brand->id]) }}"
                        class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Add Product
                    </a>
                </div>
                <div class="card-body">
                    @if ($brand->products->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>SKU</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Status</th>
                                        <th style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($brand->products as $product)
                                        <tr>
                                            <td>
                                                <span class="fw-semibold">{{ $product->name }}</span>
                                            </td>
                                            <td><code>{{ $product->sku ?: '—' }}</code></td>
                                            <td>${{ number_format($product->price, 2) }}</td>
                                            <td>{{ $product->stock_quantity }}</td>
                                            <td>
                                                @if ($product->is_active)
                                                    <span class="badge bg-label-success">Active</span>
                                                @else
                                                    <span class="badge bg-label-secondary">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <a href="{{ route('admin.products.show', $product) }}"
                                                        class="btn btn-sm btn-icon btn-outline-primary"
                                                        data-bs-toggle="tooltip" title="View">
                                                        <i class="icon-base ti tabler-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.products.edit', $product) }}"
                                                        class="btn btn-sm btn-icon btn-outline-primary"
                                                        data-bs-toggle="tooltip" title="Edit">
                                                        <i class="icon-base ti tabler-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="icon-base ti tabler-package text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5>No products yet</h5>
                            <p class="text-muted">This brand has no products. Add one to get started.</p>
                            <a href="{{ route('admin.products.create') }}"
                                class="btn btn-primary">
                                <i class="icon-base ti tabler-plus me-1"></i> Add Product
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
