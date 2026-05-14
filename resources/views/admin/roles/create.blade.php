@extends('admin.layouts.admin')

@section('title', 'Create New Role')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create New Role</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.roles.store') }}">
                @csrf

                @include('admin.roles.form')

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-check me-1"></i> Create Role
                    </button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
