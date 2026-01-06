<!-- Source Visits Card -->
<div class="col-xxl-4 col-md-6 col-12">
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between">
            <div class="card-title mb-0">
                <h5 class="mb-1">{{ $title ?? 'Source Visits' }}</h5>
                <p class="card-subtitle">{{ $subtitle ?? '38.4k Visitors' }}</p>
            </div>
            <div class="dropdown">
                <button
                    class="btn btn-text-secondary rounded-pill text-body-secondary border-0 p-2 me-n1"
                    type="button" id="{{ $dropdownId ?? 'sourceVisits' }}" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="icon-base ti tabler-dots-vertical text-body-secondary"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="{{ $dropdownId ?? 'sourceVisits' }}">
                    <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                    <a class="dropdown-item" href="javascript:void(0);">Download</a>
                    <a class="dropdown-item" href="javascript:void(0);">View All</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <ul class="list-unstyled mb-0">
                @foreach($sources ?? [] as $source)
                    <li class="{{ !$loop->last ? 'mb-6' : '' }}">
                        <div class="d-flex align-items-center">
                            <div class="badge bg-label-{{ $source['color'] ?? 'secondary' }} text-body p-2 me-4 rounded">
                                <i class="icon-base ti {{ $source['icon'] ?? 'tabler-shadow' }}"></i>
                            </div>
                            <div class="d-flex justify-content-between w-100 flex-wrap gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">{{ $source['title'] ?? 'Direct Source' }}</h6>
                                    <small class="text-body">{{ $source['description'] ?? 'Direct link click' }}</small>
                                </div>
                                <div class="d-flex align-items-center">
                                    <p class="mb-0">{{ $source['value'] ?? '1.2k' }}</p>
                                    <div class="ms-4 badge bg-label-{{ $source['changeColor'] ?? 'success' }}">{{ $source['change'] ?? '+4.2%' }}</div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!--/ Source Visits -->