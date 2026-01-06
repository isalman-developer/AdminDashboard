<!-- Support Tracker -->
<div class="col-12 col-md-6">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
                <h5 class="mb-1">{{ $title ?? 'Support Tracker' }}</h5>
                <p class="card-subtitle">{{ $subtitle ?? 'Last 7 Days' }}</p>
            </div>
            <div class="dropdown">
                <button
                    class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                    type="button" id="{{ $dropdownId ?? 'supportTrackerMenu' }}" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="{{ $dropdownId ?? 'supportTrackerMenu' }}">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
            </div>
        </div>
        <div class="card-body row">
            <div class="col-12 col-sm-4">
                <div class="mt-lg-4 mt-lg-2 mb-lg-6 mb-2">
                    <h2 class="mb-0">{{ $totalTickets ?? '164' }}</h2>
                    <p class="mb-0">Total Tickets</p>
                </div>
                <ul class="p-0 m-0">
                    @foreach($stats ?? [] as $stat)
                        <li class="d-flex gap-4 align-items-center mb-lg-3 pb-1">
                            <div class="badge rounded bg-label-{{ $stat['color'] ?? 'primary' }} p-1_5">
                                <i class="icon-base ti {{ $stat['icon'] ?? 'tabler-ticket' }}"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 text-nowrap">{{ $stat['label'] ?? 'New Tickets' }}</h6>
                                <small class="text-body-secondary">{{ $stat['value'] ?? '142' }}</small>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-12 col-md-8">
                <div id="{{ $chartId ?? 'supportTracker' }}"></div>
            </div>
        </div>
    </div>
</div>
<!--/ Support Tracker -->