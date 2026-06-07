{{-- $brand is null on create, Brand model on edit --}}

<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title mb-0">
            <i class="icon-base ti tabler-barcode me-2"></i>{{ $brand ? 'Edit Brand' : 'Brand Information' }}
        </h4>
    </div>
    <div class="card-body">
        <p class="text-muted small mb-3">
            {{ $brand ? 'Update the brand details below' : 'Enter the brand details below' }}
        </p>

        <div class="row g-3">
            <div class="col-md-12">
                <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('name') is-invalid @enderror"
                    id="name" name="name"
                    value="{{ old('name', $brand?->name) }}"
                    required {{ $brand ? '' : 'autofocus' }}>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label class="form-label">Slug <span class="text-danger">*</span></label>
                <div class="d-flex align-items-center">
                    <code class="me-3 fs-6">{{ $brand ? $brand->slug : 'Auto-generated from name' }}</code>
                </div>
                <div class="form-text">
                    {{ $brand
                        ? 'Slugs are generated automatically from the name and cannot be changed manually.'
                        : 'The slug is generated automatically from the brand name.' }}
                </div>
            </div>

            <div class="col-md-12">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror"
                    id="description" name="description" rows="3">{{ old('description', $brand?->description) }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="logo" class="form-label">Logo</label>
                @if ($brand && $brand->media->where('file_type', 'logo')->first())
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $brand->media->where('file_type', 'logo')->first()->file_path) }}"
                            alt="{{ $brand->name }}" class="rounded" style="max-height: 80px;">
                        <input type="hidden" name="existing_logo" value="1">
                    </div>
                @endif
                <input type="file" class="form-control @error('logo') is-invalid @enderror"
                    id="logo" name="logo" accept="image/*">
                <div class="form-text">
                    {{ $brand
                        ? 'Upload a new logo to replace the current one. Supported: JPEG, PNG, WebP. Max 2MB.'
                        : 'Supported formats: JPEG, PNG, WebP. Max 2MB.' }}
                </div>
                @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="website" class="form-label">Website URL</label>
                <input type="url" class="form-control @error('website') is-invalid @enderror"
                    id="website" name="website"
                    value="{{ old('website', $brand?->website) }}"
                    placeholder="https://www.example.com">
                @error('website')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="is_active" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('is_active') is-invalid @enderror"
                    id="is_active" name="is_active" required>
                    <option value="1"
                        {{ old('is_active', $brand ? (int) $brand->is_active : 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0"
                        {{ old('is_active', $brand ? (int) $brand->is_active : 1) == 0 ? 'selected' : '' }}>
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
