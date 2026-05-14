@extends('admin.layouts.admin')

@section('title', 'Create New Permission')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Create New Permission</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.permissions.store') }}">
                @csrf

                @include('admin.permissions.form')

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-check me-1"></i> Create Permission
                    </button>
                    <a href="{{ route('admin.permissions.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
