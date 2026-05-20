{{-- $product is null on create, Product model on edit --}}

<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title mb-0">
            <i class="icon-base ti tabler-package me-2"></i>{{ $product ? 'Edit Product' : 'Product Information' }}
        </h4>
    </div>
    <div class="card-body">
        <p class="text-muted small mb-3">
            {{ $product ? 'Update the product details below' : 'Enter the product\'s basic details' }}
        </p>

        <div class="row g-3">
            <div class="col-md-12">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror"
                    id="category_id" name="category_id">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $product?->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name"
                    value="{{ old('name', $product?->name) }}"
                    required {{ $product ? '' : 'autofocus' }}>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Slug <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center">
                    <code class="me-3 fs-6">{{ $product ? $product->slug : 'Auto-generated from name' }}</code>
                </div>
                <div class="form-text">
                    {{ $product
                        ? 'Slugs are generated automatically from the name and cannot be changed manually.'
                        : 'The slug is generated automatically from the product name.' }}
                </div>
            </div>

            <div class="col-md-6">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control @error('sku') is-invalid @enderror"
                    id="sku" name="sku" value="{{ old('sku', $product?->sku) }}">
                @error('sku')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="price" class="form-label">Price ({{ config('admin.currency_symbol') }}) <span class="text-danger">*</span></label>
                <input type="number" step="0.01" min="0"
                    class="form-control @error('price') is-invalid @enderror"
                    id="price" name="price"
                    value="{{ old('price', $product?->price) }}" required>
                @error('price')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="bv" class="form-label">BV</label>
                <input type="number" min="0" class="form-control @error('bv') is-invalid @enderror"
                    id="bv" name="bv" value="{{ old('bv', $product?->bv ?? 0) }}">
                @error('bv')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="pv" class="form-label">PV</label>
                <input type="number" min="0" class="form-control @error('pv') is-invalid @enderror"
                    id="pv" name="pv" value="{{ old('pv', $product?->pv ?? 0) }}">
                @error('pv')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="stock_quantity" class="form-label">Stock Quantity <span class="text-danger">*</span></label>
                <input type="number" min="0"
                    class="form-control @error('stock_quantity') is-invalid @enderror"
                    id="stock_quantity" name="stock_quantity"
                    value="{{ old('stock_quantity', $product?->stock_quantity ?? 0) }}" required>
                @error('stock_quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="image" class="form-label">Product Image</label>
                @if ($product?->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}" class="rounded" style="max-height: 100px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror"
                    id="image" name="image" accept="image/*">
                <div class="form-text">
                    {{ $product
                        ? 'Leave blank to keep current image. Supported: JPEG, PNG, WebP. Max 2MB.'
                        : 'Supported formats: JPEG, PNG, WebP. Max 2MB.' }}
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

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
                    id="description" name="description" rows="5">{{ old('description', $product?->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title mb-0">
            <i class="icon-base ti tabler-toggle-left me-2"></i>Product Status
        </h4>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('is_active') is-invalid @enderror"
                    id="is_active" name="is_active" required>
                    <option value="1"
                        {{ old('is_active', $product ? (int) $product->is_active : 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0"
                        {{ old('is_active', $product ? (int) $product->is_active : 1) == 0 ? 'selected' : '' }}>
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
