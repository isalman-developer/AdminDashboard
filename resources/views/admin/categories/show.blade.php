@extends('admin.layouts.admin')

@section('title', $category->name)

@section('content')
    <div class="row">
        <!-- Category Info Column -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Category Details</h4>
                </div>
                <div class="card-body text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                            <i class="icon-base ti tabler-tag"></i>
                        </span>
                    </div>
                    <h5>{{ $category->name }}</h5>
                    <p class="text-muted mb-2">{{ $category->slug }}</p>
                    <div class="mb-3">
                        @if ($category->is_active)
                            <span class="badge bg-label-success">Active</span>
                        @else
                            <span class="badge bg-label-secondary">Inactive</span>
                        @endif
                    </div>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td style="width: 120px;"><strong>Products</strong></td>
                                <td><span class="badge bg-label-info">{{ $category->products_count }}</span></td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $category->created_at->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated</strong></td>
                                <td>{{ $category->updated_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-flex gap-2 justify-content-center mt-2">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-outline-primary btn-sm">
                            <i class="icon-base ti tabler-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="icon-base ti tabler-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description & Products Column -->
        <div class="col-lg-8">
            @if ($category->description)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-info-circle me-2"></i>Description
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $category->description }}</p>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Products in this Category</h4>
                    <a href="{{ route('admin.products.create', ['category_id' => $category->id]) }}"
                        class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Add Product
                    </a>
                </div>
                <div class="card-body">
                    @if ($category->products->count() > 0)
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
                                    @foreach ($category->products as $product)
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
                        <div class="card-footer py-2 px-3 border-top-0">
                            {{ $products->onEachSide(1)->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="icon-base ti tabler-package text-muted" style="font-size: 3rem;"></i>
                            </div>
                            <h5>No products yet</h5>
                            <p class="text-muted">This category has no products. Add one to get started.</p>
                            <a href="{{ route('admin.products.create', ['category_id' => $category->id]) }}"
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
