@extends('admin.layouts.admin')

@section('title', 'Settings')
@section('description', 'Manage application settings')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">General Settings</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.settings.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="site_admin_name" class="form-label">Site Admin Name <span class="text-danger">*</span></label>
                    <input type="text" name="site_admin_name" id="site_admin_name" class="form-control"
                        value="{{ old('site_admin_name', $settings['site_admin_name']) }}" required>
                    <small class="text-muted">The name displayed throughout the application</small>
                    @error('site_admin_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="site_name" class="form-label">Site Name <span class="text-danger">*</span></label>
                    <input type="text" name="site_name" id="site_name" class="form-control"
                        value="{{ old('site_name', $settings['site_name']) }}" required>
                    <small class="text-muted">The name displayed throughout the application</small>
                    @error('site_name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="site_email" class="form-label">Site Email</label>
                    <input type="email" name="site_email" id="site_email" class="form-control"
                        value="{{ old('site_email', $settings['site_email']) }}">
                    <small class="text-muted">Primary contact email for the application</small>
                    @error('site_email')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="site_description" class="form-label">Site Description</label>
                    <textarea name="site_description" id="site_description" class="form-control" rows="3">{{ old('site_description', $settings['site_description']) }}</textarea>
                    <small class="text-muted">Short description used in meta tags and headers</small>
                    @error('site_description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="items_per_page" class="form-label">Items Per Page <span class="text-danger">*</span></label>
                    <input type="number" name="items_per_page" id="items_per_page" class="form-control"
                        value="{{ old('items_per_page', $settings['items_per_page']) }}" min="5" max="100" required>
                    <small class="text-muted">Default number of items shown per page in listings (5 – 100)</small>
                    @error('items_per_page')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-device-floppy me-1"></i> Save Settings
                    </button>
                    <a href="{{ route('admin.home') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
