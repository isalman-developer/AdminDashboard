@extends('admin.layouts.admin')

@section('title', 'Contact Page Content')

@section('content')

<form method="POST" action="{{ route('admin.pages.contact.update') }}">
    @csrf
    @method('PUT')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">Contact Page</h4>
            <p class="text-muted mb-0 small">Edit the contact info and text shown on the public Contact Us page.</p>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="icon-base ti tabler-device-floppy me-1"></i> Save Changes
        </button>
    </div>

    <div class="row g-4">

        {{-- ── Left column ──────────────────────────────────────────────────── --}}
        <div class="col-lg-8">

            {{-- Hero --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-home me-2 text-muted"></i>Hero Section</h6>
                </div>
                <div class="card-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Heading <span class="text-danger">*</span></label>
                        <input type="text" name="contact_hero_heading" class="form-control @error('contact_hero_heading') is-invalid @enderror"
                            value="{{ old('contact_hero_heading', $data['contact_hero_heading']) }}" required>
                        @error('contact_hero_heading')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    
                </div>
            </div>

            {{-- Contact Info --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-address-book me-2 text-muted"></i>Contact Information</h6>
                </div>
                <div class="card-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Address</label>
                        <input type="text" name="site_address" class="form-control @error('site_address') is-invalid @enderror"
                            value="{{ old('site_address', $data['site_address']) }}" placeholder="123 Main St, City, Country">
                        @error('site_address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone 1</label>
                        <input type="text" name="site_phone_1" class="form-control"
                            value="{{ old('site_phone_1', $data['site_phone_1']) }}" placeholder="+1 (123) 456-7890">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Phone 2</label>
                        <input type="text" name="site_phone_2" class="form-control"
                            value="{{ old('site_phone_2', $data['site_phone_2']) }}" placeholder="+1 (123) 456-7891">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email 1</label>
                        <input type="email" name="site_email_1" class="form-control @error('site_email_1') is-invalid @enderror"
                            value="{{ old('site_email_1', $data['site_email_1']) }}" placeholder="support@example.com">
                        @error('site_email_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email 2</label>
                        <input type="email" name="site_email_2" class="form-control @error('site_email_2') is-invalid @enderror"
                            value="{{ old('site_email_2', $data['site_email_2']) }}" placeholder="info@example.com">
                        @error('site_email_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Store Name</label>
                        <input type="text" name="contact_store_name" class="form-control"
                            value="{{ old('contact_store_name', $data['contact_store_name']) }}" placeholder="Your Store Name">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Store Hours</label>
                        <input type="text" name="contact_store_hours" class="form-control"
                            value="{{ old('contact_store_hours', $data['contact_store_hours']) }}" placeholder="Mon–Sat, 10 AM – 6 PM">
                    </div>
                </div>
            </div>

            {{-- Form Text --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-forms me-2 text-muted"></i>Contact Form Text</h6>
                </div>
                <div class="card-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Form Heading</label>
                        <input type="text" name="contact_form_heading" class="form-control"
                            value="{{ old('contact_form_heading', $data['contact_form_heading']) }}"
                            placeholder="e.g. Do you have any question?">
                    </div>
                    <div class="col-12">
                        <label class="form-label">Form Subtext</label>
                        <textarea name="contact_form_subtext" rows="3" class="form-control"
                            placeholder="Short paragraph shown to the left of the form">{{ old('contact_form_subtext', $data['contact_form_subtext']) }}</textarea>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── Right column ─────────────────────────────────────────────────── --}}
        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 80px;">
                <div class="card-header">
                    <h6 class="card-title mb-0"><i class="icon-base ti tabler-share me-2 text-muted"></i>Social Links</h6>
                </div>
                <div class="card-body row g-3">
                    <div class="col-12">
                        <label class="form-label">Facebook URL</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-base ti tabler-brand-facebook"></i></span>
                            <input type="url" name="site_facebook" class="form-control @error('site_facebook') is-invalid @enderror"
                                value="{{ old('site_facebook', $data['site_facebook']) }}" placeholder="https://facebook.com/...">
                            @error('site_facebook')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Instagram URL</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-base ti tabler-brand-instagram"></i></span>
                            <input type="url" name="site_instagram" class="form-control @error('site_instagram') is-invalid @enderror"
                                value="{{ old('site_instagram', $data['site_instagram']) }}" placeholder="https://instagram.com/...">
                            @error('site_instagram')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">LinkedIn URL</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-base ti tabler-brand-linkedin"></i></span>
                            <input type="url" name="site_linkedin" class="form-control @error('site_linkedin') is-invalid @enderror"
                                value="{{ old('site_linkedin', $data['site_linkedin']) }}" placeholder="https://linkedin.com/...">
                            @error('site_linkedin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Twitter / X URL</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="icon-base ti tabler-brand-x"></i></span>
                            <input type="url" name="site_twitter" class="form-control @error('site_twitter') is-invalid @enderror"
                                value="{{ old('site_twitter', $data['site_twitter']) }}" placeholder="https://x.com/...">
                            @error('site_twitter')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form>

@endsection
