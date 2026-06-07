@extends('admin.layouts.admin')

@section('title', $product->name)

@section('content')
    <div class="row">
        <!-- Product Info Column -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Product Details</h4>
                </div>
                <div class="card-body text-center">
                    @if ($product->image)
                        <div class="avatar avatar-lg mx-auto mb-3 border rounded-circle p-2">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                    @else
                        <div class="avatar avatar-lg mx-auto mb-3">
                            <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                                <i class="icon-base ti tabler-package"></i>
                            </span>
                        </div>
                    @endif
                    <h5>{{ $product->name }}</h5>
                    <p class="text-muted mb-2">{{ $product->category?->name ?: 'Uncategorized' }}</p>
                    <div class="mb-3">
                        @if ($product->is_active)
                            <span class="badge bg-label-success">Active</span>
                        @else
                            <span class="badge bg-label-secondary">Inactive</span>
                        @endif
                    </div>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td style="width: 100px;"><strong>SKU</strong></td>
                                <td><code>{{ $product->sku ?: '—' }}</code></td>
                            </tr>
                            <tr>
                                <td><strong>Price</strong></td>
                                <td>${{ number_format($product->price, 2) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Warranty</strong></td>
                                <td>{{ $product->warranty_months }} months</td>
                            </tr>
                            <tr>
                                <td><strong>Stock</strong></td>
                                <td>{{ $product->stock_quantity }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $product->created_at->format('M d, Y') }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated</strong></td>
                                <td>{{ $product->updated_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="d-flex gap-2 justify-content-center mt-2">
                        <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary btn-sm">
                            <i class="icon-base ti tabler-edit me-1"></i> Edit
                        </a>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="icon-base ti tabler-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Column -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">
                        <i class="icon-base ti tabler-file-text me-2"></i>Description
                    </h4>
                </div>
                <div class="card-body">
                    @if ($product->description)
                        <p class="mb-0">{{ $product->description }}</p>
                    @else
                        <p class="text-muted mb-0">No description provided.</p>
                    @endif
                </div>
            </div>

            @if ($product->image)
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-image me-2"></i>Product Image
                        </h4>
                    </div>
                    <div class="card-body text-center">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                            class="rounded" style="max-width: 300px; max-height: 300px;">
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
