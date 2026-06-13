{{-- $slider is null on create, Slider model on edit --}}

<div class="card mb-4">
    <div class="card-header">
        <h4 class="card-title mb-0">
            <i class="icon-base ti tabler-slideshow me-2"></i>{{ $slider ? 'Edit Slider' : 'Slider Information' }}
        </h4>
    </div>
    <div class="card-body">
        <p class="text-muted small mb-3">
            {{ $slider ? 'Update the slider details below.' : 'Enter the slider details below.' }}
        </p>

        <div class="row g-3">
            <div class="col-md-6">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror"
                    id="title" name="title"
                    value="{{ old('title', $slider?->title) }}"
                    placeholder="e.g. Latest Smartphones"
                    {{ $slider ? '' : 'autofocus' }}>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="subtitle" class="form-label">Subtitle</label>
                <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                    id="subtitle" name="subtitle"
                    value="{{ old('subtitle', $slider?->subtitle) }}"
                    placeholder="e.g. Discover the newest arrivals">
                @error('subtitle')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12">
                <label for="image" class="form-label">Banner Image</label>
                @if ($slider && $slider->image_path)
                    <div class="mb-2">
                        <img src="{{ Storage::url($slider->media->first()->file_path) }}" alt="{{ $slider->title }}"
                            class="img-thumbnail" style="max-height: 120px;">
                    </div>
                @endif
                <input type="file" class="form-control @error('image') is-invalid @enderror" @required(!isset($slider))
                    id="image" name="image" accept="image/jpeg,image/png,image/webp,image/avif">
                <div class="form-text">
                    {{ $slider && $slider->image_path
                        ? 'Upload a new image to replace the current banner. Supported: JPEG, PNG, WebP, AVIF. Max 4MB.'
                        : 'Supported formats: JPEG, PNG, WebP, AVIF. Max 4MB.' }}
                </div>
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                <select class="form-select @error('status') is-invalid @enderror"
                    id="status" name="status" required>
                    <option value="1"
                        {{ old('status', $slider ? (int) $slider->status : 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0"
                        {{ old('status', $slider ? (int) $slider->status : 1) == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
</div>
