@extends('admin.layouts.admin')

@section('title', 'Manage Markers')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Product Markers</h5>
                <p class="text-muted mb-0">Rename the six catalog markers below. Creating or deleting markers is disabled to keep storefront queries stable.</p>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Label</th>
                            <th scope="col" class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($markers as $marker)
                            <tr>
                                <td>{{ $marker->id }}</td>
                                <td>{{ $marker->name }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.markers.edit', $marker) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No markers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
