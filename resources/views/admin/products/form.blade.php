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
                <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                <select class="form-select @error('category_id') is-invalid @enderror"
                    id="category_id" name="category_id" required>
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
                <label for="brand_id" class="form-label">Brand <span class="text-danger">*</span></label>
                <select class="form-select @error('brand_id') is-invalid @enderror"
                    id="brand_id" name="brand_id" required>
                    <option value="">Select a brand</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}"
                            {{ old('brand_id', $product?->brand_id) == $brand->id ? 'selected' : '' }}>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>
                @error('brand_id')
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
                <label for="warranty_months" class="form-label">Warranty (Months)</label>
                <input type="number" min="0" class="form-control @error('warranty_months') is-invalid @enderror"
                    id="warranty_months" name="warranty_months"
                    value="{{ old('warranty_months', $product?->warranty_months ?? 12) }}">
                @error('warranty_months')
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
                <label class="form-label">Product Images</label>

                {{-- Existing images (edit mode only) --}}
                @if ($product && $product->media->isNotEmpty())
                    <div class="mb-3">
                        <p class="text-muted small mb-2">Current images — click <strong>×</strong> to mark for removal:</p>
                        <div class="d-flex flex-wrap gap-2" id="existing-images-container">
                            @foreach ($product->media as $media)
                                <div class="position-relative" id="existing-{{ $media->id }}">
                                    <img src="{{ Storage::url($media->file_path) }}"
                                        id="thumb-{{ $media->id }}"
                                        style="width:80px;height:80px;object-fit:cover;"
                                        class="rounded border">
                                    <button type="button"
                                        onclick="removeExistingImage({{ $media->id }})"
                                        class="btn btn-danger position-absolute top-0 end-0 rounded-circle p-0 lh-1"
                                        style="width:20px;height:20px;font-size:13px;">×</button>
                                    <input type="checkbox" name="remove_image_ids[]"
                                        value="{{ $media->id }}"
                                        id="remove-{{ $media->id }}"
                                        class="d-none">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- New image upload --}}
                <div class="mb-2">
                    <button type="button" class="btn btn-outline-secondary btn-sm"
                        onclick="document.getElementById('images-input').click()">
                        <i class="icon-base ti tabler-photo-plus me-1"></i>
                        {{ $product ? 'Add More Images' : 'Select Images' }}
                    </button>
                    <input type="file" id="images-input" name="images[]"
                        multiple accept="image/*" class="d-none">
                    <div class="form-text mt-1">Supported: JPEG, PNG, WebP. Max 2MB per image.</div>
                    @error('images.*')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- New image previews --}}
                <div id="new-image-previews" class="d-flex flex-wrap gap-2 mt-1"></div>
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

            <div class="col-md-6">
                <label for="marked_as_id" class="form-label">Mark As</label>
                <select class="form-select @error('marked_as_id') is-invalid @enderror"
                    id="marked_as_id" name="marked_as_id">
                    <option value="">— None —</option>
                    @foreach ($markedAs as $mark)
                        <option value="{{ $mark->id }}"
                            {{ old('marked_as_id', $product?->marked_as_id) == $mark->id ? 'selected' : '' }}>
                            {{ $mark->name }}
                        </option>
                    @endforeach
                </select>
                @error('marked_as_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>

<script>
(function () {
    const input   = document.getElementById('images-input');
    const preview = document.getElementById('new-image-previews');
    let selectedFiles = [];

    if (!input) return;

    input.addEventListener('change', function () {
        Array.from(this.files).forEach(function (file) {
            selectedFiles.push(file);
            const idx    = selectedFiles.length - 1;
            const reader = new FileReader();
            reader.onload = function (e) {
                const wrap = document.createElement('div');
                wrap.className = 'position-relative';
                wrap.id = 'preview-' + idx;
                wrap.innerHTML =
                    '<img src="' + e.target.result + '" style="width:80px;height:80px;object-fit:cover;" class="rounded border">' +
                    '<button type="button" onclick="removeNewPreview(' + idx + ')" ' +
                    'class="btn btn-danger position-absolute top-0 end-0 rounded-circle p-0 lh-1" ' +
                    'style="width:20px;height:20px;font-size:13px;">×</button>';
                preview.appendChild(wrap);
            };
            reader.readAsDataURL(file);
        });
        rebuildInput();
    });

    window.removeNewPreview = function (idx) {
        selectedFiles[idx] = null;
        const el = document.getElementById('preview-' + idx);
        if (el) el.remove();
        rebuildInput();
    };

    function rebuildInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(function (f) { if (f) dt.items.add(f); });
        input.files = dt.files;
    }

    window.removeExistingImage = function (id) {
        const cb    = document.getElementById('remove-' + id);
        const thumb = document.getElementById('thumb-' + id);
        const wrap  = document.getElementById('existing-' + id);
        if (!cb || !wrap) return;

        if (cb.checked) {
            cb.checked = false;
            thumb.style.opacity = '1';
            thumb.style.outline = '';
            wrap.querySelector('button').textContent = '×';
        } else {
            cb.checked = true;
            thumb.style.opacity = '0.35';
            thumb.style.outline = '2px solid #dc3545';
            wrap.querySelector('button').textContent = '↺';
        }
    };
})();
</script>
