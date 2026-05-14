@extends('admin.layouts.admin')

@section('title', 'Edit Role')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Edit Role: {{ $role->name }}</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                @csrf
                @method('PUT')

                @include('admin.roles.form')

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-check me-1"></i> Update Role
                    </button>
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
@endsection
