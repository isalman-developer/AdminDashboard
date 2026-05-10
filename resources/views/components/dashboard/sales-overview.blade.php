<!-- Sales Overview -->
<div class="col-xl-3 col-sm-6">
    <div class="card h-100">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <p class="mb-0 text-body">{{ $title ?? 'Sales Overview' }}</p>
                <p class="card-text fw-medium text-{{ $changeColor ?? 'success' }}">{{ $changePercentage ?? '+18.2%' }}</p>
            </div>
            <h4 class="card-title mb-1">{{ $amount ?? '$42.5k' }}</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <div class="d-flex gap-2 align-items-center mb-2">
                        <span class="badge bg-label-{{ $leftMetric['color'] ?? 'info' }} p-1 rounded">
                            <i class="icon-base ti {{ $leftMetric['icon'] ?? 'tabler-shopping-cart' }}"></i>
                        </span>
                        <p class="mb-0">{{ $leftMetric['label'] ?? 'Order' }}</p>
                    </div>
                    <h5 class="mb-0 pt-1">{{ $leftMetric['percentage'] ?? '62.2%' }}</h5>
                    <small class="text-body-secondary">{{ $leftMetric['count'] ?? '6,440' }}</small>
                </div>
                <div class="col-4">
                    <div class="divider divider-vertical">
                        <div class="divider-text">
                            <span class="badge-divider-bg bg-label-secondary">VS</span>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                        <p class="mb-0">{{ $rightMetric['label'] ?? 'Visits' }}</p>
                        <span class="badge bg-label-{{ $rightMetric['color'] ?? 'primary' }} p-1 rounded">
                            <i class="icon-base ti {{ $rightMetric['icon'] ?? 'tabler-link' }}"></i>
                        </span>
                    </div>
                    <h5 class="mb-0 pt-1">{{ $rightMetric['percentage'] ?? '25.5%' }}</h5>
                    <small class="text-body-secondary">{{ $rightMetric['count'] ?? '12,749' }}</small>
                </div>
            </div>
            <div class="d-flex align-items-center mt-6">
                <div class="progress w-100" style="height: 10px;">
                    <div class="progress-bar bg-{{ $leftMetric['color'] ?? 'info' }}" style="width: {{ $leftMetric['progress'] ?? '70%' }}"
                        role="progressbar" aria-valuenow="{{ rtrim($leftMetric['progress'] ?? '70', '%') }}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                    <div class="progress-bar bg-{{ $rightMetric['color'] ?? 'primary' }}" role="progressbar"
                        style="width: {{ $rightMetric['progress'] ?? '30%' }}" aria-valuenow="{{ rtrim($rightMetric['progress'] ?? '30', '%') }}" aria-valuemin="0"
                        aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Sales Overview -->