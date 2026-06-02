@extends('admin.layouts.admin')

@section('title', 'Referral Tree — ' . $user->name)

@section('content')

    {{-- Page header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">Referral Tree</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.edit', $user) }}">{{ $user->name }}</a></li>
                    <li class="breadcrumb-item active">Referral Tree</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    <div class="row g-4">

        {{-- Left: user info card --}}
        <div class="col-lg-3">
            <div class="card h-100">
                <div class="card-body text-center pt-4">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <span class="avatar-initial bg-label-primary rounded-circle" style="font-size: 2rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-3">{{ $user->email }}</p>

                    @if ($user->status === 'active')
                        <span class="badge bg-label-success mb-3">Active</span>
                    @elseif ($user->status === 'inactive')
                        <span class="badge bg-label-secondary mb-3">Inactive</span>
                    @elseif ($user->status === 'blocked')
                        <span class="badge bg-label-danger mb-3">Blocked</span>
                    @endif

                    <hr>

                    <table class="table table-sm table-borderless text-start mb-0">
                        <tr>
                            <td class="text-muted small fw-semibold">Referral Code</td>
                            <td>
                                <code class="small">{{ $user->referral_code ?: '—' }}</code>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Upline</td>
                            <td class="small">
                                @if ($tree['ancestors']->isNotEmpty())
                                    {{ $tree['ancestors']->first()->name }}
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Direct Refs</td>
                            <td class="small">{{ $tree['children']->count() }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Upline Depth</td>
                            <td class="small">{{ $tree['ancestors']->count() }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Wallet</td>
                            <td class="small">${{ number_format($user->wallet_balance, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Joined</td>
                            <td class="small">{{ $user->created_at->format('M d, Y') }}</td>
                        </tr>
                    </table>

                    <div class="d-grid gap-2 mt-3">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary">
                            <i class="icon-base ti tabler-edit me-1"></i> Edit Profile
                        </a>
                        <a href="{{ route('admin.users.edit-roles', $user) }}" class="btn btn-sm btn-outline-info">
                            <i class="icon-base ti tabler-user-cog me-1"></i> Manage Roles
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right: tree visualization --}}
        <div class="col-lg-9">

            {{-- ── UPLINE CHAIN ── --}}
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="icon-base ti tabler-arrow-up text-muted"></i>
                    <h6 class="mb-0">Upline Chain</h6>
                    <span class="badge bg-label-secondary ms-auto">{{ $tree['ancestors']->count() }} level(s)</span>
                </div>
                <div class="card-body">
                    @if ($tree['ancestors']->isEmpty())
                        <p class="text-muted text-center mb-0 py-2">This user has no upline — they are a root member.</p>
                    @else
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            @foreach ($tree['ancestors'] as $index => $ancestor)
                                {{-- Level badge only on first --}}
                                @if ($index === 0)
                                    <span class="badge bg-label-secondary small">Direct Sponsor</span>
                                @endif

                                <div class="d-flex align-items-center gap-2 border rounded px-3 py-2 bg-light">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-initial bg-label-primary rounded-circle">
                                            {{ strtoupper(substr($ancestor->name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.users.referrals', $ancestor) }}"
                                            class="fw-semibold text-body small d-block text-decoration-none">
                                            {{ $ancestor->name }}
                                        </a>
                                        <span class="text-muted" style="font-size: 0.7rem;">{{ $ancestor->referral_code }}</span>
                                    </div>
                                    @if ($ancestor->status === 'blocked')
                                        <span class="badge bg-label-danger ms-1" style="font-size: 0.65rem;">Blocked</span>
                                    @elseif ($ancestor->status === 'inactive')
                                        <span class="badge bg-label-secondary ms-1" style="font-size: 0.65rem;">Inactive</span>
                                    @endif
                                </div>

                                {{-- Connector arrow (not after last) --}}
                                @if (! $loop->last)
                                    <i class="icon-base ti tabler-chevron-right text-muted"></i>
                                @endif
                            @endforeach

                            {{-- Final arrow pointing to current user --}}
                            <i class="icon-base ti tabler-chevron-right text-muted"></i>
                            <div class="d-flex align-items-center gap-2 border border-primary rounded px-3 py-2">
                                <div class="avatar avatar-sm">
                                    <span class="avatar-initial bg-primary rounded-circle text-white">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="fw-semibold small d-block text-primary">{{ $user->name }}</span>
                                    <span class="text-muted" style="font-size: 0.7rem;">{{ $user->referral_code }}</span>
                                </div>
                                <span class="badge bg-label-primary ms-1" style="font-size: 0.65rem;">You</span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- ── CURRENT USER NODE ── --}}
            <div class="card border-primary mb-1" style="border-width: 2px !important;">
                <div class="card-body py-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar avatar-lg">
                            <span class="avatar-initial bg-primary rounded-circle text-white" style="font-size: 1.4rem;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="mb-0 text-primary">{{ $user->name }}</h5>
                            <span class="text-muted small">{{ $user->email }}</span>
                        </div>
                        <div class="text-end">
                            <div class="mb-1">
                                <span class="badge bg-label-primary px-3 py-1">
                                    <i class="icon-base ti tabler-qrcode me-1"></i>{{ $user->referral_code }}
                                </span>
                            </div>
                            <span class="text-muted small">{{ $tree['children']->count() }} direct referral(s)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Connector line between current user and children --}}
            @if ($tree['children']->isNotEmpty())
                <div class="text-center py-1">
                    <i class="icon-base ti tabler-arrow-down text-primary" style="font-size: 1.5rem;"></i>
                </div>
            @else
                <div class="mb-4"></div>
            @endif

            {{-- ── DIRECT REFERRALS ── --}}
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2">
                    <i class="icon-base ti tabler-users text-muted"></i>
                    <h6 class="mb-0">Direct Referrals (Downline)</h6>
                    <span class="badge bg-label-primary ms-auto">{{ $tree['children']->count() }}</span>
                </div>
                <div class="card-body">
                    @if ($tree['children']->isEmpty())
                        <div class="text-center py-4">
                            <i class="icon-base ti tabler-user-plus text-muted mb-2" style="font-size: 2.5rem;"></i>
                            <p class="text-muted mb-0">No one has signed up using this user's referral code yet.</p>
                        </div>
                    @else
                        <div class="row g-3">
                            @foreach ($tree['children'] as $child)
                                <div class="col-md-6 col-xl-4">
                                    <div class="border rounded p-3 h-100 d-flex flex-column">
                                        <div class="d-flex align-items-center gap-2 mb-2">
                                            <div class="avatar avatar-sm">
                                                <span class="avatar-initial bg-label-info rounded-circle">
                                                    {{ strtoupper(substr($child->name, 0, 1)) }}
                                                </span>
                                            </div>
                                            <div class="flex-grow-1 min-w-0">
                                                <div class="fw-semibold small text-truncate">{{ $child->name }}</div>
                                                <div class="text-muted text-truncate" style="font-size: 0.72rem;">{{ $child->email }}</div>
                                            </div>
                                            @if ($child->status === 'active')
                                                <span class="badge bg-label-success" style="font-size: 0.65rem;">Active</span>
                                            @elseif ($child->status === 'inactive')
                                                <span class="badge bg-label-secondary" style="font-size: 0.65rem;">Inactive</span>
                                            @elseif ($child->status === 'blocked')
                                                <span class="badge bg-label-danger" style="font-size: 0.65rem;">Blocked</span>
                                            @endif
                                        </div>
                                        <div class="mt-auto">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <code class="small text-muted">{{ $child->referral_code }}</code>
                                                <span class="text-muted" style="font-size: 0.7rem;">{{ $child->created_at->format('M d, Y') }}</span>
                                            </div>
                                            <div class="d-flex gap-1 mt-2">
                                                <a href="{{ route('admin.users.referrals', $child) }}"
                                                    class="btn btn-sm btn-outline-primary flex-fill"
                                                    title="View their referral tree">
                                                    <i class="icon-base ti tabler-sitemap me-1"></i> Tree
                                                </a>
                                                <a href="{{ route('admin.users.edit', $child) }}"
                                                    class="btn btn-sm btn-outline-secondary"
                                                    title="Edit user">
                                                    <i class="icon-base ti tabler-edit"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
