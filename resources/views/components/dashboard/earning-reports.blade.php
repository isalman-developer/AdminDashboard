<!-- Earning Reports -->
<div class="col-md-6">
    <div class="card h-100">
        <div class="card-header pb-0 d-flex justify-content-between">
            <div class="card-title mb-0">
                <h5 class="mb-1">{{ $title ?? 'Earning Reports' }}</h5>
                <p class="card-subtitle">{{ $subtitle ?? 'Weekly Earnings Overview' }}</p>
            </div>
            <div class="dropdown">
                <button
                    class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                    type="button" id="{{ $dropdownId ?? 'earningReportsId' }}" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="{{ $dropdownId ?? 'earningReportsId' }}">
                    <a class="dropdown-item" href="javascript:void(0);">View More</a>
                    <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row align-items-center g-md-8">
                <div class="col-12 col-md-5 d-flex flex-column">
                    <div class="d-flex gap-2 align-items-center mb-3 flex-wrap">
                        <h2 class="mb-0">{{ $earnings ?? '$468' }}</h2>
                        <div class="badge rounded bg-label-{{ $changeColor ?? 'success' }}">{{ $changePercentage ?? '+4.2%' }}</div>
                    </div>
                    <small class="text-body">{{ $description ?? 'You informed of this week compared to last week' }}</small>
                </div>
                <div class="col-12 col-md-7 ps-xl-8">
                    <div id="{{ $chartId ?? 'weeklyEarningReports' }}"></div>
                </div>
            </div>
            <div class="border rounded p-5 mt-5">
                <div class="row gap-4 gap-sm-0">
                    @foreach($metrics ?? [] as $metric)
                        <div class="col-12 col-sm-4">
                            <div class="d-flex gap-2 align-items-center">
                                <div class="badge rounded bg-label-{{ $metric['color'] ?? 'primary' }} p-1">
                                    <i class="icon-base ti {{ $metric['icon'] ?? 'tabler-currency-dollar' }}"></i>
                                </div>
                                <h6 class="mb-0 fw-normal">{{ $metric['label'] ?? 'Earnings' }}</h6>
                            </div>
                            <h4 class="my-2">{{ $metric['value'] ?? '$545.69' }}</h4>
                            <div class="progress w-75" style="height:4px">
                                <div class="progress-bar{{ isset($metric['color']) ? ' bg-' . $metric['color'] : '' }}" role="progressbar"
                                    style="width: {{ $metric['progress'] ?? '65%' }}" aria-valuenow="{{ rtrim($metric['progress'] ?? '65', '%') }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Earning Reports -->