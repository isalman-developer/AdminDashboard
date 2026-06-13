@extends('admin.layouts.admin')

@section('title', 'Sliders Management')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Sliders</h4>
            <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                <i class="icon-base ti tabler-plus me-1"></i> Add Slider
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('admin.sliders.index') }}" class="d-flex gap-2">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search sliders..."
                                value="{{ $search }}">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="icon-base ti tabler-search"></i>
                            </button>
                        </div>
                        @if ($search)
                            <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">
                                <i class="icon-base ti tabler-x"></i>
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            @if ($sliders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Image</th>
                                <th>Title</th>
                                <th>Subtitle</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th style="width: 120px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $slider)
                                <tr>
                                    <td>
                                        @if ($slider->media->count() > 0)
                                            <img src="{{ Storage::url($slider->media->first()->file_path) }}"
                                                alt="{{ $slider->title }}" class="rounded"
                                                style="width: 64px; height: 40px; object-fit: cover;">
                                        @else
                                            <div class="rounded bg-label-secondary d-flex align-items-center justify-content-center"
                                                style="width: 64px; height: 40px;">
                                                <i class="icon-base ti tabler-photo text-muted"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td><span class="fw-semibold">{{ $slider->title ?: '—' }}</span></td>
                                    <td>{{ $slider->subtitle ?: '—' }}</td>
                                    <td><x-admin.status-badge :active="$slider->status" /></td>
                                    <td>{{ $slider->created_at->format(config('admin.date_format')) }}</td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="{{ route('admin.sliders.edit', $slider->id) }}"
                                                class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="tooltip"
                                                title="Edit">
                                                <i class="icon-base ti tabler-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger"
                                                data-delete-name="{{ $slider->title ?: 'this slider' }}"
                                                data-delete-url="{{ route('admin.sliders.destroy', $slider->id) }}"
                                                title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-2 px-3 border-top-0">
                    {{ $sliders->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="icon-base ti tabler-slideshow text-muted" style="font-size: 3rem;"></i>
                    </div>
                    <h5>No sliders found</h5>
                    <p class="text-muted">Get started by creating a new slider.</p>
                    <a href="{{ route('admin.sliders.create') }}" class="btn btn-primary">
                        <i class="icon-base ti tabler-plus me-1"></i> Add Slider
                    </a>
                </div>
            @endif
        </div>
    </div>

    @include('admin.partials.delete-modal')
@endsection
