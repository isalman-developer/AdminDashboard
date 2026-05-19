@extends('admin.layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="row">
        <!-- Product Info Column -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Product Information</h4>
                </div>
                <div class="card-body text-center">
                    @if ($product->image_path)
                        <div class="avatar avatar-lg mx-auto mb-3 border rounded-circle p-2">
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}"
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
                                <td><strong>BV / PV</strong></td>
                                <td>{{ $product->bv }} / {{ $product->pv }}</td>
                            </tr>
                            <tr>
                                <td><strong>Stock</strong></td>
                                <td>{{ $product->stock_quantity }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $product->created_at->format('M d, Y') }}</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Edit Form Column -->
        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Basic Info -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-package me-2"></i>Edit Product
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Update the product details below</p>

                        <div class="row g-3">
                            <!-- Category -->
                            <div class="col-md-12">
                                <label for="category_id" class="form-label">Category <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror"
                                    id="category_id" name="category_id" required>
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Name -->
                            <div class="col-md-12">
                                <label for="name" class="form-label">Product Name <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('name') is-invalid @enderror"
                                    id="name"
                                    name="name"
                                    value="{{ old('name', $product->name) }}"
                                    required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div class="col-md-12">
                                <label class="form-label">Slug <span class="text-danger">*</span></label>
                                <div class="d-flex align-items-center">
                                    <code class="me-3 fs-6">{{ $product->slug }}</code>
                                </div>
                                <div class="form-text">Slugs are generated automatically from the name and cannot be changed manually.</div>
                            </div>

                            <!-- SKU -->
                            <div class="col-md-6">
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text"
                                    class="form-control @error('sku') is-invalid @enderror"
                                    id="sku"
                                    name="sku"
                                    value="{{ old('sku', $product->sku) }}">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price ($) <span
                                        class="text-danger">*</span></label>
                                <input type="number" step="0.01" min="0"
                                    class="form-control @error('price') is-invalid @enderror"
                                    id="price"
                                    name="price"
                                    value="{{ old('price', $product->price) }}"
                                    required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- BV / PV -->
                            <div class="col-md-4">
                                <label for="bv" class="form-label">BV</label>
                                <input type="number" min="0"
                                    class="form-control @error('bv') is-invalid @enderror"
                                    id="bv"
                                    name="bv"
                                    value="{{ old('bv', $product->bv) }}">
                                @error('bv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="pv" class="form-label">PV</label>
                                <input type="number" min="0"
                                    class="form-control @error('pv') is-invalid @enderror"
                                    id="pv"
                                    name="pv"
                                    value="{{ old('pv', $product->pv) }}">
                                @error('pv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="stock_quantity" class="form-label">Stock Quantity <span
                                        class="text-danger">*</span></label>
                                <input type="number" min="0"
                                    class="form-control @error('stock_quantity') is-invalid @enderror"
                                    id="stock_quantity"
                                    name="stock_quantity"
                                    value="{{ old('stock_quantity', $product->stock_quantity) }}"
                                    required>
                                @error('stock_quantity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Image -->
                            <div class="col-md-12">
                                <label for="image_path" class="form-label">Product Image</label>
                                @if ($product->image_path)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $product->image_path) }}"
                                            alt="{{ $product->name }}" class="rounded" style="max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('image_path') is-invalid @enderror"
                                    id="image_path" name="image_path" accept="image/*">
                                <div class="form-text">Leave blank to keep current image. Supported: JPEG, PNG, WebP. Max 2MB.</div>
                                @error('image_path')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-file-text me-2"></i>Description
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control @error('description') is-invalid @enderror"
                                    id="description" name="description" rows="5">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-toggle-left me-2"></i>Product Status
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="is_active" class="form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('is_active') is-invalid @enderror"
                                    id="is_active"
                                    name="is_active"
                                    required>
                                    <option value="1"
                                        {{ old('is_active', $product->is_active) == '1' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="0"
                                        {{ old('is_active', $product->is_active) == '0' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                </select>
                                @error('is_active')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Products
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
