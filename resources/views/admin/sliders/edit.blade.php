@extends('admin.layouts.admin')

@section('title', 'Edit Slider')

@section('content')
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Slider Information</h4>
                </div>
                <div class="card-body text-center">
                    <div class="avatar avatar-lg mx-auto mb-3">
                        <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2.5rem;">
                            <i class="icon-base ti tabler-slideshow"></i>
                        </span>
                    </div>
                    <h5>{{ $slider->title ?: 'Untitled Slider' }}</h5>
                    <p class="text-muted mb-3">{{ $slider->subtitle ?: '—' }}</p>

                    <div class="text-start">
                        <table class="table table-sm table-borderless">
                            <tr>
                                <td style="width: 100px;"><strong>Status</strong></td>
                                <td><x-admin.status-badge :active="$slider->status" /></td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $slider->created_at->format(config('admin.date_format')) }}</td>
                            </tr>
                        </table>
                    </div>

                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Sliders
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <form method="POST" action="{{ route('admin.sliders.update', $slider->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.sliders.form', ['slider' => $slider])

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.sliders.index') }}" class="btn btn-outline-secondary">
                        <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Sliders
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="icon-base ti tabler-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
