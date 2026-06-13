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
                    @if ($product->image_path)
                        <div class="avatar avatar-xl mx-auto mb-3 border rounded-circle">
                            <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}"
                                class="rounded-circle">
                        </div>
                    @else
                        <div class="avatar avatar-xl mx-auto mb-3">
                            <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                                <i class="icon-base ti tabler-package"></i>
                            </span>
                        </div>
                    @endif
                    <h5>{{ $product->name }}</h5>
                    <p class="text-muted mb-2">{{ $product->category?->name ?: 'Uncategorized' }}</p>
                    <div class="mb-2">
                        @if ($product->is_active)
                            <span class="badge bg-label-success">Active</span>
                        @else
                            <span class="badge bg-label-secondary">Inactive</span>
                        @endif
                        <span class="badge bg-label-info ms-1">
                            <i class="icon-base ti tabler-photo me-1"></i>{{ $product->media->count() }} image(s)
                        </span>
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

        <!-- Description & Gallery Column -->
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

            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h4 class="card-title mb-0">
                        <i class="icon-base ti tabler-photos me-2"></i>Product Images
                    </h4>
                    <span class="badge bg-label-secondary">{{ $product->media->count() }} image(s)</span>
                </div>
                <div class="card-body">
                    @if ($product->media->isNotEmpty())
                        <div class="row g-3">
                            @foreach ($product->media as $media)
                                <div class="col-6 col-md-4 col-lg-3">
                                    <a href="{{ Storage::url($media->file_path) }}" target="_blank">
                                        <img src="{{ Storage::url($media->file_path) }}"
                                            alt="{{ $product->name }}"
                                            class="img-thumbnail w-100"
                                            style="height: 110px; object-fit: cover;">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="icon-base ti tabler-photo text-muted" style="font-size: 2.5rem;"></i>
                            <p class="text-muted mt-2 mb-0">No images uploaded yet.</p>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary btn-sm mt-2">
                                <i class="icon-base ti tabler-photo-plus me-1"></i> Add Images
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
