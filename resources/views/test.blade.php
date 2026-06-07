@extends('client.layouts.master')
@push('styles')
    <style>
        @media (max-width: 768px) {
            .carousel-inner .carousel-item>div {
                display: none;
            }

            .carousel-inner .carousel-item>div:first-child {
                display: block;
            }
        }

        .carousel-inner .carousel-item.active,
        .carousel-inner .carousel-item-start,
        .carousel-inner .carousel-item-next,
        .carousel-inner .carousel-item-prev {
            display: flex;
            // transition-duration: 10s;
        }

        /* display 4 */
        @media (min-width: 768px) {

            .carousel-inner .carousel-item-right.active,
            .carousel-inner .carousel-item-next,
            .carousel-item-next:not(.carousel-item-start) {
                transform: translateX(25%) !important;
            }

            .carousel-inner .carousel-item-left.active,
            .carousel-item-prev:not(.carousel-item-end),
            .active.carousel-item-start,
            .carousel-item-prev:not(.carousel-item-end) {
                transform: translateX(-25%) !important;
            }

            .carousel-item-next.carousel-item-start,
            .active.carousel-item-end {
                transform: translateX(0) !important;
            }

            .carousel-inner .carousel-item-prev,
            .carousel-item-prev:not(.carousel-item-end) {
                transform: translateX(-25%) !important;
            }
        }
    </style>
@endpush
@section('content')
    <div id="myCarousel" class="carousel slide container" data-bs-ride="carousel">
        <div class="carousel-inner w-100">
            <div class="carousel-item active">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=1">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=2">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=3">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=4">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=5">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=6">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=7">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="col-md-3">
                    <div class="card card-body border-0">
                        <img class="img-fluid" src="http://placehold.it/380?text=8">
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!--Text with background image and carousel section end here-->
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.19/jquery.touchSwipe.min.js"></script>

    <script>
        var myCarousel = document.querySelector('#myCarousel');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 10000,
            touch: true
        });

        $(".carousel .carousel-inner").swipe({
            swipeLeft: function(event, direction, distance, duration, fingerCount) {
                this.parent().carousel("next");
            },
            swipeRight: function() {
                this.parent().carousel("prev");
            },
            threshold: 0,
            tap: function(event, target) {
                window.location = $(this).find(".carousel-item.active a").attr("href");
            },
            excludedElements: "label, button, input, select, textarea, .noSwipe"
        });

        $('.carousel .carousel-item').each(function() {
            var minPerSlide = 4;
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < minPerSlide; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
@endpush
