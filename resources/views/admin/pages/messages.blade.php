@extends('admin.layouts.admin')

@section('title', 'Contact Messages')

@section('content')

    {{-- Stat card --}}
    <div class="row g-4 mb-4">
        <div class="col-sm-6 col-xl-3">
            <div class="card">
                <div class="card-body d-flex align-items-center gap-3">
                    <div class="avatar flex-shrink-0">
                        <span class="avatar-initial rounded bg-label-warning">
                            <i class="icon-base ti tabler-mail-opened"></i>
                        </span>
                    </div>
                    <div>
                        <small class="text-muted d-block">Unread Messages</small>
                        <h4 class="mb-0">{{ $unreadCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h4 class="card-title mb-0">Contact Messages</h4>
        </div>
        <div class="card-body p-0">

            @if ($messages->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-4">Name / Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th style="width:110px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $msg)
                                <tr class="{{ $msg->is_read ? '' : 'table-warning' }}">
                                    <td class="ps-4">
                                        <p class="fw-semibold mb-0">{{ $msg->name }}</p>
                                        <small class="text-muted">{{ $msg->email }}</small>
                                        @if ($msg->phone)
                                            <div class="small text-muted">{{ $msg->phone }}</div>
                                        @endif
                                    </td>
                                    <td>{{ $msg->subject ?: '—' }}</td>
                                    <td>
                                        <span title="{{ $msg->message }}">
                                            {{ Str::limit($msg->message, 80) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted small">{{ $msg->created_at->format('M d, Y') }}</span>
                                        <div class="small text-muted">{{ $msg->created_at->format('h:i A') }}</div>
                                    </td>
                                    <td>
                                        @if ($msg->is_read)
                                            <span class="badge bg-label-success">Read</span>
                                        @else
                                            <span class="badge bg-label-warning">Unread</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <form method="POST" action="{{ route('admin.contact-messages.markRead', $msg) }}">
                                                @csrf @method('PATCH')
                                                <button type="submit"
                                                    class="btn btn-sm btn-icon {{ $msg->is_read ? 'btn-outline-secondary' : 'btn-outline-success' }}"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ $msg->is_read ? 'Mark unread' : 'Mark read' }}">
                                                    <i class="icon-base ti {{ $msg->is_read ? 'tabler-mail' : 'tabler-mail-opened' }}"></i>
                                                </button>
                                            </form>
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-outline-danger"
                                                data-delete-name="{{ $msg->name }}"
                                                data-delete-url="{{ route('admin.contact-messages.destroy', $msg) }}"
                                                data-bs-toggle="tooltip" title="Delete">
                                                <i class="icon-base ti tabler-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    {{ $messages->onEachSide(1)->links('pagination::bootstrap-5') }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="icon-base ti tabler-mail-off" style="font-size:3rem;" class="text-muted"></i>
                    <p class="text-muted mt-3">No messages yet.</p>
                </div>
            @endif

        </div>
    </div>

@include('admin.partials.delete-modal')

@endsection
