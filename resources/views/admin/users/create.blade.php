@extends('admin.layouts.admin')

@section('title', 'Create User')

@section('content')
    <div class="row">
        <!-- Create Form Column -->
        <div class="col-lg-12">
            <form method="POST" action="{{ route('admin.users.store') }}">
                @csrf

                <!-- Profile Fields -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti tabler-user me-2"></i>User Information
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Enter the new user's basic details</p>

                        <div class="row g-3">
                            <!-- Name -->
                            <div class="col-md-12">
                                <label for="name" class="form-label">Full Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Username -->
                            <div class="col-md-6">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control @error('username') is-invalid @enderror"
                                    id="username" name="username" value="{{ old('username') }}">
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="col-md-6">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    id="password" name="password" required minlength="8">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password <span
                                        class="text-danger">*</span></label>
                                <input type="password"
                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                    id="password_confirmation" name="password_confirmation" required minlength="8">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-12">
                                <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select @error('status') is-invalid @enderror" id="status"
                                    name="status" required>
                                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>
                                        Active
                                    </option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                        Inactive
                                    </option>
                                    <option value="blocked" {{ old('status') === 'blocked' ? 'selected' : '' }}>
                                        Blocked
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Roles Assignment -->
                @php
                    $allRoles = \App\Models\Role::orderBy('name')->get();
                    $allPermissions = \App\Models\Permission::orderBy('name')->get()->groupBy('category');
                @endphp

                <!-- Roles Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">
                            <i class="icon-base ti ti-shield me-2"></i>Assign Roles
                        </h4>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Select one or more roles to assign to this user</p>

                        @if ($allRoles->count() > 0)
                            <div class="mb-3">
                                <div class="row g-2">
                                    @foreach ($allRoles as $role)
                                        <div class="col-md-6 col-lg-4">
                                            <div class="form-check card p-3">
                                                <input class="form-check-input" type="checkbox" name="roles[]"
                                                    id="role-{{ $role->id }}" value="{{ $role->name }}"
                                                    {{ old('roles') && in_array($role->name, old('roles')) ? 'checked' : '' }}>
                                                <label class="form-check-label w-100" for="role-{{ $role->id }}">
                                                    <span class="fw-semibold">{{ $role->name }}</span>
                                                    @if ($role->permissions->count() > 0)
                                                        <br><small class="text-muted">{{ $role->permissions->count() }}
                                                            permission(s)</small>
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No roles available. <a href="{{ route('admin.roles.create') }}">Create
                                    a role first</a>.</p>
                        @endif
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Users
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-save me-1"></i> Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
