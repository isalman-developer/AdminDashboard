<!-- Average Daily Sales -->
<div class="col-xl-3 col-sm-6">
    <div class="card h-100">
        <div class="card-header pb-0">
            <h5 class="mb-3 card-title">{{ $title ?? 'Average Daily Sales' }}</h5>
            <p class="mb-0 text-body">{{ $subtitle ?? 'Total Sales This Month' }}</p>
            <h4 class="mb-0">{{ $amount ?? '$28,450' }}</h4>
        </div>
        <div class="card-body px-0">
            <div id="{{ $chartId ?? 'averageDailySales' }}"></div>
        </div>
    </div>
</div>
<!--/ Average Daily Sales -->