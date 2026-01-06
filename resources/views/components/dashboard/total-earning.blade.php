<!-- Total Earning Card -->
<div class="col-12 col-md-6 col-xxl-4 order-2 order-xl-0">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 card-title">{{ $title ?? 'Total Earning' }}</h5>
                <div class="dropdown">
                    <button
                        class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                        type="button" id="{{ $dropdownId ?? 'totalEarning' }}" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <i class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="{{ $dropdownId ?? 'totalEarning' }}">
                        <a class="dropdown-item" href="javascript:void(0);">View More</a>
                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <h2 class="mb-0 me-2">{{ $percentage ?? '87%' }}</h2>
                <i class="icon-base ti tabler-chevron-up text-{{ $changeColor ?? 'success' }} me-1"></i>
                <h6 class="text-{{ $changeColor ?? 'success' }} mb-0">{{ $changeValue ?? '25.8%' }}</h6>
            </div>
        </div>
        <div class="card-body">
            <div id="{{ $chartId ?? 'totalEarningChart' }}"></div>
            @foreach($items ?? [] as $item)
                <div class="d-flex align-items-start {{ !$loop->last ? 'my-4' : '' }}">
                    <div class="badge rounded bg-label-{{ $item['color'] ?? 'primary' }} p-2 me-4 rounded">
                        <i class="icon-base ti {{ $item['icon'] ?? 'tabler-brand-paypal' }}"></i>
                    </div>
                    <div class="d-flex justify-content-between w-100 gap-2 align-items-center">
                        <div class="me-2">
                            <h6 class="mb-0">{{ $item['title'] ?? 'Total Revenue' }}</h6>
                            <small class="text-body">{{ $item['description'] ?? 'Client Payment' }}</small>
                        </div>
                        <h6 class="mb-0 text-{{ $item['valueColor'] ?? 'success' }}">{{ $item['value'] ?? '+$126' }}</h6>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!--/ Total Earning -->