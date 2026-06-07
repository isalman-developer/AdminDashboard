@extends('admin.layouts.admin')

@section('title', 'Edit Marker')

@section('content')
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Edit Marker #{{ $markedAs->id }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.markers.update', $markedAs) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label">Label</label>
                        <input
                            type="text"
                            name="name"
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $markedAs->name) }}"
                            maxlength="50"
                            required
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Must be unique and under 50 characters.</div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.markers.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
