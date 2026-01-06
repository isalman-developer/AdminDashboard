<!-- Website Analytics Card -->
<div class="col-xl-6 col">
    <div class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg" id="swiper-with-pagination-cards">
        <div class="swiper-wrapper">
            @foreach($slides ?? [] as $index => $slide)
                <div class="swiper-slide">
                    <div class="row">
                        <div class="col-12">
                            <h5 class="text-white mb-0">{{ $slide['title'] ?? 'Website Analytics' }}</h5>
                            <small>{{ $slide['subtitle'] ?? 'Total 28.5% Conversion Rate' }}</small>
                        </div>
                        <div class="row">
                            <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1 pt-md-9">
                                <h6 class="text-white mt-0 mt-md-3 mb-4">{{ $slide['section_title'] ?? 'Traffic' }}</h6>
                                <div class="row">
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            @foreach(($slide['left_stats'] ?? []) as $stat)
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ $stat['value'] }}
                                                    </p>
                                                    <p class="mb-0">{{ $stat['label'] }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <ul class="list-unstyled mb-0">
                                            @foreach(($slide['right_stats'] ?? []) as $stat)
                                                <li class="d-flex mb-4 align-items-center">
                                                    <p class="mb-0 fw-medium me-2 website-analytics-text-bg">
                                                        {{ $stat['value'] }}
                                                    </p>
                                                    <p class="mb-0">{{ $stat['label'] }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                                <img src="{{ asset($slide['image'] ?? 'admin/assets/img/illustrations/card-website-analytics-1.png') }}"
                                    alt="{{ $slide['title'] ?? 'Website Analytics' }}" height="150"
                                    class="card-website-analytics-img" />
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!--/ Website Analytics -->