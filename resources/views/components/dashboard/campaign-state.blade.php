<!-- Campaign State Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
                <h5 class="mb-1">{{ $title ?? 'Monthly Campaign State' }}</h5>
                <p class="card-subtitle">{{ $subtitle ?? '8.52k Social Visiters' }}</p>
            </div>
            <div class="dropdown">
                <button
                    class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                    type="button" id="{{ $dropdownId ?? 'MonthlyCampaign' }}" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="{{ $dropdownId ?? 'MonthlyCampaign' }}">
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                    <a class="dropdown-item" href="javascript:void(0);">View All</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="p-0 m-0">
                @foreach($stats ?? [] as $stat)
                    <li class="mb-{{ $loop->last ? '3' : '6' }} d-flex justify-content-between align-items-center">
                        <div class="badge bg-label-{{ $stat['color'] ?? 'success' }} rounded p-1_5">
                            <i class="icon-base ti {{ $stat['icon'] ?? 'tabler-mail' }}"></i>
                        </div>
                        <div class="d-flex justify-content-between w-100 flex-wrap">
                            <h6 class="mb-0 ms-4">{{ $stat['label'] ?? 'Emails' }}</h6>
                            <div class="d-flex">
                                <p class="mb-0">{{ $stat['value'] ?? '12,346' }}</p>
                                <p class="ms-4 text-{{ $stat['changeColor'] ?? 'success' }} mb-0">{{ $stat['change'] ?? '0.3%' }}</p>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!--/ Campaign State -->