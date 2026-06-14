@extends('admin.layouts.admin')

@section('title', 'About Page Content')

@section('content')

<form method="POST" action="{{ route('admin.pages.about.update') }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">About Page</h4>
            <p class="text-muted mb-0 small">Edit the content displayed on the public About Us page.</p>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="icon-base ti tabler-device-floppy me-1"></i> Save Changes
        </button>
    </div>

    <div class="row g-4">

        {{-- ── Left column ──────────────────────────────────────────────────── --}}
        <div class="col-lg-8">

{{-- Hero Section --}}

            {{-- Features (Delivery / Help Center / Secure Checkout / 30 Days Return) --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-star me-2 text-muted"></i>Feature Cards</h6>
                </div>
                <div class="card-body row g-3">
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nationwide Delivery Title</label>
                        <input type="text" name="about_feature_nation_wide_delivery" class="form-control" value="{{ old('about_feature_nation_wide_delivery', $data['about_feature_nation_wide_delivery']) }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Nationwide Delivery Text</label>
                        <textarea name="about_feature_nation_wide_delivery_text" rows="3" class="form-control">{{ old('about_feature_nation_wide_delivery_text', $data['about_feature_nation_wide_delivery_text']) }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">24/7 Help Center Title</label>
                        <input type="text" name="about_feature_nation_help_center" class="form-control" value="{{ old('about_feature_nation_help_center', $data['about_feature_nation_help_center']) }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">24/7 Help Center Text</label>
                        <textarea name="about_feature_nation_help_center_text" rows="3" class="form-control">{{ old('about_feature_nation_help_center_text', $data['about_feature_nation_help_center_text']) }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">Secure Checkout Title</label>
                        <input type="text" name="about_feature_nation_secure_checkout" class="form-control" value="{{ old('about_feature_nation_secure_checkout', $data['about_feature_nation_secure_checkout']) }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">Secure Checkout Text</label>
                        <textarea name="about_feature_nation_secure_checkout_text" rows="3" class="form-control">{{ old('about_feature_nation_secure_checkout_text', $data['about_feature_nation_secure_checkout_text']) }}</textarea>
                    </div>

                    <div class="col-12 col-md-6">
                        <label class="form-label">30 Days Return Title</label>
                        <input type="text" name="about_feature_nation_return" class="form-control" value="{{ old('about_feature_nation_return', $data['about_feature_nation_return']) }}">
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label">30 Days Return Text</label>
                        <textarea name="about_feature_nation_return_text" rows="3" class="form-control">{{ old('about_feature_nation_return_text', $data['about_feature_nation_return_text']) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Hero Section --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-home me-2 text-muted"></i>Hero Section</h6>
                </div>
                <div class="card-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="about_story_heading" class="form-control @error('about_story_heading') is-invalid @enderror"
                            value="{{ old('about_story_heading', $data['about_story_heading']) }}" required>
                        @error('about_story_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Subheading</label>
                        <textarea name="about_story_sub_heading" rows="3" class="form-control @error('about_story_sub_heading') is-invalid @enderror"
                            placeholder="Short mission statement shown under the heading">{{ old('about_story_sub_heading', $data['about_story_sub_heading']) }}</textarea>
                        @error('about_story_sub_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Our Story --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-book me-2 text-muted"></i>Our Story Section</h6>
                </div>
                <div class="card-body row g-3">
                   
                    <div class="col-12">
                        <label class="form-label">Story Content</label>
                        <textarea name="about_story_body" rows="6" class="form-control @error('about_story_body') is-invalid @enderror"
                            placeholder="The main body text for your company story">{{ old('about_story_body', $data['about_story_body']) }}</textarea>
                        @error('about_story_body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Stats --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-chart-bar me-2 text-muted"></i>Statistics (4 Stat Cards)</h6>
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-2 d-none d-md-flex">
                        <div class="col-md-3"><small class="text-muted fw-semibold">#</small></div>
                        <div class="col-md-4"><small class="text-muted fw-semibold">NUMBER / VALUE</small></div>
                        <div class="col-md-5"><small class="text-muted fw-semibold">LABEL</small></div>
                    </div>
                    @for ($i = 1; $i <= 4; $i++)
                        <div class="row g-2 mb-2 align-items-center">
                            <div class="col-md-3">
                                <span class="badge bg-label-primary">Stat {{ $i }}</span>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="about_stat_{{ $i }}_number"
                                    class="form-control"
                                    placeholder="e.g. 1000+"
                                    value="{{ old('about_stat_'.$i.'_number', $data['about_stat_'.$i.'_number']) }}">
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="about_stat_{{ $i }}_label"
                                    class="form-control"
                                    placeholder="e.g. Happy customers"
                                    value="{{ old('about_stat_'.$i.'_label', $data['about_stat_'.$i.'_label']) }}">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>


            {{-- What We Offer --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-sparkles me-2 text-muted"></i>What We Offer Section</h6>
                </div>
                <div class="card-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Section Heading</label>
                        <input type="text" name="about_what_we_offer_heading" class="form-control"
                            value="{{ old('about_what_we_offer_heading', $data['about_what_we_offer_heading']) }}">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Body Text</label>
                        <textarea name="about_what_we_offer_body" rows="4" class="form-control"
                            placeholder="Paragraph shown under the heading">{{ old('about_what_we_offer_body', $data['about_what_we_offer_body']) }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── Right column ─────────────────────────────────────────────────── --}}
        <div class="col-lg-4">

            {{-- Hero Images --}}
            <div class="card sticky-top" style="top: 80px;">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-photo me-2 text-muted"></i>Hero Images (3 Photos)</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted small mb-3">These appear in the staggered 3-image grid at the top of the page. Leave blank to keep the current image.</p>

                    @foreach ([1, 2, 3] as $i)
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">Image {{ $i }}</label>
                            @if ($data["about_img_{$i}"])
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $data["about_img_{$i}"]) }}"
                                        class="img-thumbnail" style="height:80px;object-fit:cover;" alt="Image {{ $i }}">
                                </div>
                            @else
                                <div class="mb-2">
                                    <img src="{{ asset('client/images/about/about-img-'.$i.'.jpg') }}"
                                        class="img-thumbnail opacity-50" style="height:80px;object-fit:cover;" alt="Default image {{ $i }}">
                                    <div class="small text-muted mt-1">Default image</div>
                                </div>
                            @endif
                            <input type="file" name="about_img_{{ $i }}" class="form-control form-control-sm" accept="image/*">
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>


</form>

@endsection
