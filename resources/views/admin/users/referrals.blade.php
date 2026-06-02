@extends('admin.layouts.admin')

@section('title', 'Referral Tree — ' . $user->name)

@section('content')

<style>
/* ═══════════════════════════════════════════
   Referral Org-Chart
   ═══════════════════════════════════════════ */

.ref-tree {
    text-align: center;
    padding: 8px 0 24px;
}

/* ── Every row of nodes at the same depth ── */
.ref-row {
    display: flex;
    justify-content: center;
}

/* ── Each column = one branch (node + optional subtree) ── */
.ref-col {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 0 14px;
}

/* ── Vertical connector line between levels ── */
.ref-vline {
    width: 2px;
    height: 28px;
    background: #1ab5c0;
    flex-shrink: 0;
}

/* ═══════════════════════════════════════════
   Horizontal bar + vertical drops
   Applied to every direct child row
   ═══════════════════════════════════════════ */
.ref-row--children .ref-col {
    position: relative;
    padding-top: 28px;      /* space for the connector drop */
}

/* Vertical drop from the horizontal bar down to the node */
.ref-row--children .ref-col::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 2px;
    height: 28px;
    background: #1ab5c0;
}

/* Horizontal bar segment (each child contributes its own half/full) */
.ref-row--children .ref-col::after {
    content: '';
    position: absolute;
    top: 0;
    height: 2px;
    background: #1ab5c0;
}

/* First child: right half of bar */
.ref-row--children .ref-col:first-child:not(:only-child)::after {
    left: 50%;
    right: 0;
}
/* Middle children: full width */
.ref-row--children .ref-col:not(:first-child):not(:last-child)::after {
    left: 0;
    right: 0;
}
/* Last child: left half of bar */
.ref-row--children .ref-col:last-child:not(:only-child)::after {
    left: 0;
    right: 50%;
}
/* Only child: just a straight vertical (no horizontal bar) */
.ref-row--children .ref-col:only-child::after {
    display: none;
}

/* ═══════════════════════════════════════════
   Node cards
   ═══════════════════════════════════════════ */
.ref-node {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: 80px;
}

/* Circular avatar */
.ref-avatar {
    border-radius: 50%;
    background: #1ab5c0;
    color: #fff;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 3px solid rgba(26, 181, 192, .3);
    transition: transform .18s ease, box-shadow .18s ease;
    cursor: default;
    flex-shrink: 0;
    /* default = level 1 size */
    width: 58px;
    height: 58px;
    font-size: 1.25rem;
}
a .ref-avatar { cursor: pointer; }
a:hover .ref-avatar {
    transform: scale(1.1);
    box-shadow: 0 4px 16px rgba(26, 181, 192, .45);
}

/* Root (current user) */
.ref-avatar--root {
    width: 72px;
    height: 72px;
    font-size: 1.55rem;
    background: #0d6efd;
    border-color: rgba(13, 110, 253, .35);
}
a:hover .ref-avatar--root { box-shadow: 0 4px 16px rgba(13, 110, 253, .45); }

/* Level-2 (grandchildren) */
.ref-avatar--sm {
    width: 44px;
    height: 44px;
    font-size: .95rem;
    background: #4ecbd4;
    border-color: rgba(78, 203, 212, .35);
}
a:hover .ref-avatar--sm { box-shadow: 0 4px 12px rgba(78, 203, 212, .4); }

/* Status modifiers */
.ref-avatar--blocked  { background: #6c757d !important; border-color: rgba(108,117,125,.3) !important; opacity: .6; }
.ref-avatar--inactive { opacity: .7; }

/* Text under avatar */
.ref-name {
    font-size: .72rem;
    font-weight: 600;
    line-height: 1.25;
    margin-top: 7px;
    max-width: 88px;
    word-break: break-word;
    text-align: center;
}
.ref-name--sm { font-size: .66rem; max-width: 70px; }

.ref-code {
    font-size: .6rem;
    color: #6c757d;
    font-family: monospace;
    margin-top: 1px;
}

.ref-badge {
    margin-top: 4px;
    display: inline-block;
    font-size: .57rem;
    font-weight: 700;
    letter-spacing: .05em;
    text-transform: uppercase;
    padding: 1px 5px;
    border-radius: 20px;
}
.ref-badge--root    { background: rgba(13,110,253,.12); color: #0d6efd; }
.ref-badge--direct  { background: rgba(26,181,192,.12); color: #0d8a91; }
.ref-badge--indirect{ background: rgba(108,117,125,.1); color: #6c757d; }
.ref-badge--blocked { background: rgba(220,53,69,.1);   color: #dc3545; }
.ref-badge--inactive{ background: rgba(108,117,125,.1); color: #6c757d; }

/* Level labels above each row */
.ref-level-lbl {
    font-size: .6rem;
    font-weight: 700;
    letter-spacing: .09em;
    text-transform: uppercase;
    color: #adb5bd;
    margin-bottom: 4px;
}
</style>

    {{-- Page header --}}
    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-1">Referral Tree</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('admin.users.edit', $user) }}">{{ $user->name }}</a>
                    </li>
                    <li class="breadcrumb-item active">Referral Tree</li>
                </ol>
            </nav>
        </div>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
            <i class="icon-base ti tabler-arrow-left me-1"></i> Back to Users
        </a>
    </div>

    <div class="row g-4">

         {{-- ── Left: User info card ── --}}
        <div class="col-lg-3">
            <div class="card h-100">
                <div class="card-body text-center pt-4">
                    <div class="avatar avatar-xl mx-auto mb-3">
                        <span class="avatar-initial bg-label-primary rounded-circle" style="font-size:2rem;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                    <h5 class="mb-1">{{ $user->name }}</h5>
                    <p class="text-muted small mb-2">{{ $user->email }}</p>

                    @if ($user->status === 'active')
                        <span class="badge bg-label-success mb-3">Active</span>
                    @elseif ($user->status === 'inactive')
                        <span class="badge bg-label-secondary mb-3">Inactive</span>
                    @elseif ($user->status === 'blocked')
                        <span class="badge bg-label-danger mb-3">Blocked</span>
                    @endif

                    <hr>

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

        <div class="col-lg-9">
            <div class="card h-100">
                <div class="card-body text-center pt-4">
                    <table class="table table-sm table-borderless text-start mb-0">
                        <tr>
                            <td class="text-muted small fw-semibold pe-2">Referral Code</td>
                            <td><code class="small">{{ $user->referral_code ?: '—' }}</code></td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Upline</td>
                            <td class="small">
                                @if ($tree['ancestors']->isNotEmpty())
                                    <a href="{{ route('admin.users.referrals', $tree['ancestors']->first()) }}"
                                       class="text-body text-decoration-none">
                                        {{ $tree['ancestors']->first()->name }}
                                    </a>
                                @else
                                    <span class="text-muted">None</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Direct Refs</td>
                            <td class="small fw-bold">{{ $tree['children']->count() }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted small fw-semibold">Indirect Refs</td>
                            <td class="small fw-bold">
                                {{ $tree['children']->sum(fn($c) => $c->children->count()) }}
                            </td>
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
                </div>
            </div>
            
        </div>

        {{-- ── Right: Tree ── --}}
        <div class="col-lg-12">

            {{-- Upline chain (only if the user has a sponsor) --}}
            @if ($tree['ancestors']->isNotEmpty())
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center gap-2 py-2">
                    <i class="icon-base ti tabler-arrow-up text-muted" style="font-size:.9rem;"></i>
                    <h6 class="mb-0 small">Upline Chain</h6>
                    <span class="badge bg-label-secondary ms-auto">{{ $tree['ancestors']->count() }} level(s)</span>
                </div>
                <div class="card-body py-3" style="overflow-x:auto;">
                    <div class="d-flex flex-nowrap align-items-center gap-2">
                        @foreach ($tree['ancestors'] as $ancestor)
                            <div class="d-flex align-items-center gap-2 border rounded px-3 py-2 flex-shrink-0">
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
                                    <span class="text-muted" style="font-size:.68rem;">{{ $ancestor->referral_code }}</span>
                                </div>
                            </div>
                            <i class="icon-base ti tabler-chevron-right text-muted flex-shrink-0"></i>
                        @endforeach

                        {{-- Current user at the end --}}
                        <div class="d-flex align-items-center gap-2 border border-primary rounded px-3 py-2 flex-shrink-0">
                            <div class="avatar avatar-sm">
                                <span class="avatar-initial bg-primary rounded-circle text-white">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </span>
                            </div>
                            <div>
                                <span class="fw-semibold small d-block text-primary">{{ $user->name }}</span>
                                <span class="text-muted" style="font-size:.68rem;">{{ $user->referral_code }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- ── Main tree card ── --}}
            <div class="card">
                <div class="card-header d-flex align-items-center gap-2 py-2">
                    <i class="icon-base ti tabler-sitemap text-muted" style="font-size:.9rem;"></i>
                    <h6 class="mb-0 small">Referral Network</h6>
                    <div class="ms-auto d-flex gap-2">
                        <span class="badge bg-label-primary">
                            {{ $tree['children']->count() }} direct
                        </span>
                        <span class="badge bg-label-secondary">
                            {{ $tree['children']->sum(fn($c) => $c->children->count()) }} indirect
                        </span>
                    </div>
                </div>

                <div class="card-body" style="overflow-x:auto; min-height:220px;">
                    <div class="ref-tree">

                        {{-- ════ LEVEL 0 — Root (current user) ════ --}}
                        <div class="ref-level-lbl">
                            {{ $tree['ancestors']->isEmpty() ? 'Root Member' : 'Indirect Advocate' }}
                        </div>
                        <div class="ref-row">
                            <div class="ref-col">
                                <div class="ref-node">
                                    <div class="ref-avatar ref-avatar--root
                                         {{ $user->status === 'blocked'  ? 'ref-avatar--blocked'  : '' }}
                                         {{ $user->status === 'inactive' ? 'ref-avatar--inactive' : '' }}">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="ref-name">{{ $user->name }}</div>
                                    <div class="ref-code">{{ $user->referral_code }}</div>
                                    <span class="ref-badge ref-badge--root">
                                        {{ $tree['ancestors']->isEmpty() ? 'Root' : 'Advocate' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        @if ($tree['children']->isNotEmpty())

                            {{-- Vertical drop from root to level-1 bar --}}
                            <div class="d-flex justify-content-center">
                                <div class="ref-vline"></div>
                            </div>

                            {{-- ════ LEVEL 1 — Direct referrals ════ --}}
                            <div class="ref-level-lbl">Direct Advocate</div>
                            <div class="ref-row ref-row--children">
                                @foreach ($tree['children'] as $child)
                                <div class="ref-col">

                                    {{-- Level-1 node --}}
                                    <div class="ref-node">
                                        <a href="{{ route('admin.users.referrals', $child) }}"
                                           title="View {{ $child->name }}'s tree">
                                            <div class="ref-avatar
                                                 {{ $child->status === 'blocked'  ? 'ref-avatar--blocked'  : '' }}
                                                 {{ $child->status === 'inactive' ? 'ref-avatar--inactive' : '' }}">
                                                {{ strtoupper(substr($child->name, 0, 1)) }}
                                            </div>
                                        </a>
                                        <div class="ref-name">{{ $child->name }}</div>
                                        <div class="ref-code">{{ $child->referral_code }}</div>
                                        @if ($child->status === 'blocked')
                                            <span class="ref-badge ref-badge--blocked">Blocked</span>
                                        @elseif ($child->status === 'inactive')
                                            <span class="ref-badge ref-badge--inactive">Inactive</span>
                                        @else
                                            <span class="ref-badge ref-badge--direct">Direct</span>
                                        @endif
                                    </div>

                                    {{-- ════ LEVEL 2 — Grandchildren (if any) ════ --}}
                                    @if ($child->children->isNotEmpty())
                                        <div class="d-flex justify-content-center">
                                            <div class="ref-vline"></div>
                                        </div>
                                        <div class="ref-level-lbl">Referral</div>
                                        <div class="ref-row ref-row--children">
                                            @foreach ($child->children as $grandchild)
                                            <div class="ref-col">
                                                <div class="ref-node">
                                                    <a href="{{ route('admin.users.referrals', $grandchild) }}"
                                                       title="View {{ $grandchild->name }}'s tree">
                                                        <div class="ref-avatar ref-avatar--sm
                                                             {{ $grandchild->status === 'blocked'  ? 'ref-avatar--blocked'  : '' }}
                                                             {{ $grandchild->status === 'inactive' ? 'ref-avatar--inactive' : '' }}">
                                                            {{ strtoupper(substr($grandchild->name, 0, 1)) }}
                                                        </div>
                                                    </a>
                                                    <div class="ref-name ref-name--sm">{{ $grandchild->name }}</div>
                                                    <div class="ref-code">{{ $grandchild->referral_code }}</div>
                                                    @if ($grandchild->status === 'blocked')
                                                        <span class="ref-badge ref-badge--blocked">Blocked</span>
                                                    @elseif ($grandchild->status === 'inactive')
                                                        <span class="ref-badge ref-badge--inactive">Inactive</span>
                                                    @else
                                                        <span class="ref-badge ref-badge--indirect">Indirect</span>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                                @endforeach
                            </div>

                        @else
                            {{-- Empty state --}}
                            <div class="text-center py-5">
                                <i class="icon-base ti tabler-user-plus text-muted mb-2" style="font-size:2.5rem;"></i>
                                <p class="text-muted mb-1 small">No referrals yet.</p>
                                <p class="text-muted small">Share the link below to grow this network.</p>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- Referral link footer --}}
                <div class="card-footer py-2 d-flex align-items-center gap-2 flex-wrap">
                    <small class="text-muted fw-semibold flex-shrink-0">Referral link:</small>
                    <code class="small flex-grow-1 text-truncate" id="ref-link-{{ $user->id }}">
                        {{ url('/register?ref=' . $user->referral_code) }}
                    </code>
                    <button class="btn btn-sm btn-outline-primary py-0 flex-shrink-0"
                            style="font-size:.75rem;"
                            onclick="
                                navigator.clipboard.writeText(document.getElementById('ref-link-{{ $user->id }}').textContent.trim());
                                this.innerHTML='<i class=\'icon-base ti tabler-check me-1\'></i>Copied';
                                setTimeout(() => this.innerHTML='<i class=\'icon-base ti tabler-copy me-1\'></i>Copy', 2000);
                            ">
                        <i class="icon-base ti tabler-copy me-1"></i>Copy
                    </button>
                </div>
            </div>

        </div>{{-- end col-lg-9 --}}
    </div>

@endsection
