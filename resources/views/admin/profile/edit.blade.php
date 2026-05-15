@extends('admin.layouts.admin')

@section('title', 'Edit Profile')
@section('description', 'Update your profile information')

@section('content')
    <div class="row mb-6">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Profile</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control"
                                value="{{ old('name', $user->name) }}" required>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control"
                                value="{{ old('email', $user->email) }}" required>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" name="username" id="username" class="form-control"
                                value="{{ old('username', $user->username) }}">
                            <small class="text-muted">Letters, numbers, dashes, and underscores only.</small>
                            @error('username')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">Change Password <span class="text-muted fw-normal small">(leave blank to keep current)</span></h5>

                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control">
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon-base ti tabler-device-floppy me-1"></i> Save Changes
                            </button>
                            <a href="{{ route('admin.profile') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
