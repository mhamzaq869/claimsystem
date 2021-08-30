@extends('frontend.layouts.master')

@section('main-content')

    <link rel="icon" href="https://marketplace.exertiowp.com/wp-content/uploads/2021/02/cropped-80x80-1-32x32.png"
        sizes="32x32" />
    <link rel="icon" href="https://marketplace.exertiowp.com/wp-content/uploads/2021/02/cropped-80x80-1-192x192.png"
        sizes="192x192" />

    <link rel='dns-prefetch' href='http://kit.fontawesome.com/' />
    <link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
    <link rel='dns-prefetch' href='http://s.w.org/' />
    <link rel='preconnect' href='https://fonts.gstatic.com/' crossorigin />
    <link rel="alternate" type="application/rss+xml" title="Exertio WordPress Theme &raquo; Feed"
        href="https://marketplace.exertiowp.com/feed/" />
    <link rel="alternate" type="application/rss+xml" title="Exertio WordPress Theme &raquo; Comments Feed"
        href="https://marketplace.exertiowp.com/comments/feed/" />

    <link rel='stylesheet' id='pretty-checkbox-css'
        href='https://marketplace.exertiowp.com/wp-content/themes/exertio/css/pretty-checkbox.min.css?ver=5.6.2'
        type='text/css' media='all' />
    <link rel='stylesheet' id='exertio-style-css'
        href='https://marketplace.exertiowp.com/wp-content/themes/exertio/css/theme.css?ver=5.6.2' type='text/css'
        media='all' />

    <style>
        @media (min-width: 768px) {

            /* show 3 items */
            .carousel-inner .active,
            .carousel-inner .active+.carousel-item,
            .carousel-inner .active+.carousel-item+.carousel-item,
            .carousel-inner .active+.carousel-item+.carousel-item+.carousel-item {
                display: block;
            }

            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left),
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item,
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item+.carousel-item,
            .carousel-inner .carousel-item.active:not(.carousel-item-right):not(.carousel-item-left)+.carousel-item+.carousel-item+.carousel-item {
                transition: none;
            }

            .carousel-inner .carousel-item-next,
            .carousel-inner .carousel-item-prev {
                position: relative;
                transform: translate3d(0, 0, 0);
            }

            .carousel-inner .active.carousel-item+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
                position: absolute;
                top: 0;
                right: -25%;
                z-index: -1;
                display: block;
                visibility: visible;
            }

            /* left or forward direction */
            .active.carousel-item-left+.carousel-item-next.carousel-item-left,
            .carousel-item-next.carousel-item-left+.carousel-item,
            .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item,
            .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item+.carousel-item,
            .carousel-item-next.carousel-item-left+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(-100%, 0, 0);
                visibility: visible;
            }

            /* farthest right hidden item must be abso position for animations */
            .carousel-inner .carousel-item-prev.carousel-item-right {
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
                display: block;
                visibility: visible;
            }

            /* right or prev direction */
            .active.carousel-item-right+.carousel-item-prev.carousel-item-right,
            .carousel-item-prev.carousel-item-right+.carousel-item,
            .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item,
            .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item+.carousel-item,
            .carousel-item-prev.carousel-item-right+.carousel-item+.carousel-item+.carousel-item+.carousel-item {
                position: relative;
                transform: translate3d(100%, 0, 0);
                visibility: visible;
                display: block;
                visibility: visible;
            }

        }

        /* Bootstrap Lightbox using Modal */

        #profile-grid {
            overflow: auto;
            white-space: normal;
        }

        #profile-grid .profile {
            padding-bottom: 40px;
        }

        #profile-grid .panel {
            padding: 0
        }

        #profile-grid .panel-body {
            padding: 15px
        }

        #profile-grid .profile-name {
            font-weight: bold;
        }

        #profile-grid .thumbnail {
            margin-bottom: 6px;
        }

        #profile-grid .panel-thumbnail {
            overflow: hidden;
        }

        #profile-grid .img-rounded {
            border-radius: 4px 4px 0 0;
        }

    </style>

    <section class="fr-project-details section-padding actionbar_space">
        <div class="container">
            @foreach (['success', 'danger'] as $msg)
                @if (Session::has($msg))
                    <div class="alert alert-{{ $msg }} alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ Session::get($msg) }}
                    </div>
                @endif
            @endforeach
            <div class="row">
                <div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 col-xs-12">
                    <div class="fr-project-content">
                        <div class="fr-project-list">
                            <div class="fr-project-container">
                                <ul class="fr-project-meta">

                                    <li> <i class="fal fa-clock"></i>
                                        {{ date('M d, Y', strtotime($project->created_at)) }} </li>
                                </ul>
                                <h2>{{ $project->title }}</h2>
                            </div>

                        </div>

                        <div class="fr-project-f-des">
                            <div class="fr-project-des">
                                <h3>Description</h3>
                                {!! $project->description !!}
                            </div>
                            @php $images = json_decode($project->images); @endphp

                            <div class="container-fluid">
                                <div id="carouselExample" class="carousel slide" data-ride="carousel" data-interval="9000">
                                    <div class="carousel-inner row w-100 mx-auto" role="listbox">
                                        @if($images)
                                            @foreach ($images as $image)
                                            <div class="carousel-item col-md-3">
                                                <div class="panel panel-default">
                                                    <div class="panel-thumbnail">
                                                        <a href="javascript:void(0)" onclick="imgModal('{{ asset($image) }}')">
                                                            <img src="{{ asset($image) }}" style="max-width:100%;">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <a class="carousel-control-prev" href="#carouselExample" role="button"
                                        data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="carousel-control-next text-faded" href="#carouselExample" role="button"
                                        data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                            </div>


                            @php $keywords = explode(',',$project->keywords); @endphp

                            <div class="fr-project-skills">
                                <h3> Skills Required</h3>
                                @foreach ($keywords as $keyword)
                                    <a href="javascript:void(0)">{{ Str::ucfirst($keyword) }}</a>
                                @endforeach
                            </div>

                        </div>
                    </div>

                    @if ($project->user_id != Auth::user()->id && $project->status == 1)
                        <div class="fr-project-lastest-product">
                            <div class="fr-project-place" id="fr-bid-form">
                                <h3> Send Your Proposal</h3>
                                <form id="bid_form" action="{{ route('vendor.biding.project') }}" method="POST"
                                    data-smk-icon="glyphicon-remove-sign">
                                    @csrf

                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <div class="row g-3">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Your Price</label>
                                                <div class="input-group">
                                                    <input type="text" name="price" class="form-control" id="bidding-price"
                                                        name="bid_price" required
                                                        data-smk-msg="Provide your price in numbers only"
                                                        data-smk-type="number">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">$</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label> Days to complete</label>
                                                <div class="input-group">
                                                    <input type="text" name="days" class="form-control" name="bid_days"
                                                        required data-smk-msg="Dasy to complete in numbers only"
                                                        data-smk-type="number">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text">Days</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-12 price-section" style="display:@if (Session::has('display')) {{ Session::get('display') }} @endif">
                                            <div class="pricing-section">
                                                <ul>
                                                    <li>
                                                        <div> Your Biding Price <p class="pricing-desc">The total project
                                                                cost.</p>
                                                        </div>
                                                        <div>
                                                            <p id="total-price">${{ Session::get('price') }}</p>
                                                        </div>
                                                    </li>
                                                    @if (Session::has('price'))
                                                    <li>
                                                        <div> Service Fee <small>(20%)</small>
                                                            <p class="pricing-desc">The service fee that will be deducted
                                                                from your proposed amount.</p>
                                                        </div>
                                                        <div> $<p>{{ Session::get('price') * 0.2 }}</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div> Your Earning <p class="pricing-desc">Total amount you will
                                                                earn.</p>
                                                        </div>
                                                        <div> $<p>
                                                                {{ Session::get('price') * 0.8 }}</p>
                                                        </div>
                                                    </li>
                                                   @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-12">
                                            <label> Cover Letter<a href="javascript:void(0)" class="price-breakdown">Price
                                                    breakdown</a> </label>
                                            <textarea class="form-control" id="bid-textarea" name="cover_letter"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="fr-project-ad-content">

                                        <div class="form-row">
                                            <div class="col-12">
                                                <div class="button-bid">
                                                    <button type="submit" class="btn btn-theme btn-loading"
                                                        id="btn_project_bid" data-post-id='225'>Submit Proposal <span
                                                            class="bubbles"> <i class="fa fa-circle"></i> <i
                                                                class="fa fa-circle"></i> <i class="fa fa-circle"></i>
                                                        </span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-lg-4 col-xl-4 col-xs-12 col-sm-12 col-md-12">
                    <div class="project-sidebar position-sticky">
                        <div class="project-price">
                            <div class="card-body">
                                <div class="row">

                                    <div class="col"> <span class="price-label"> Budget</span>
                                        <div class="price">
                                            ${{ $project->price }} </div>
                                    </div>
                                    <div class="feature"> <i class="fal fa-wallet"></i> </div>
                                </div>

                            </div>
                        </div>

                        {{-- <p class="report-button text-center"> <a href="javascript:void(0)" data-bs-toggle="modal"
                                data-bs-target="#report-modal"><i class="fal fa-exclamation-triangle"></i>Report
                                Project</a></p> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal -->
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <img src="" id="modalImage" class="w-100">
            </div>
        </div>
    </div>

    <script language="javascript">

        var myElement = document.querySelectorAll('.carousel-item')[0];

        // example for addding some-class to the element
        myElement.classList.add('active');

        $('#carouselExample').on('slide.bs.carousel', function(e) {


            var $e = $(e.relatedTarget);
            var idx = $e.index();
            var itemsPerSlide = 4;
            var totalItems = $('.carousel-item').length;
            console.log(totalItems);
            if (idx >= totalItems - (itemsPerSlide - 1)) {
                var it = itemsPerSlide - (totalItems - idx);
                for (var i = 0; i < it; i++) {
                    // append slides to end
                    if (e.direction == "left") {
                        $('.carousel-item').eq(i).appendTo('.carousel-inner');
                    } else {
                        $('.carousel-item').eq(0).appendTo('.carousel-inner');
                    }
                }
            }
        });


        $('#carouselExample').carousel({
            interval: 2000
        });


        $(document).ready(function() {
            /* show lightbox when clicking a thumbnail */
            $('a.thumb').click(function(event) {
                event.preventDefault();
                var content = $('.modal-body');
                content.empty();
                var title = $(this).attr("title");
                $('.modal-title').html(title);
                content.html($(this).html());
                $(".modal-profile").modal({
                    show: true
                });
            });

        });

      function imgModal(url){
            $('#modelId').modal('show');
            $('#modalImage').attr('src',url);
        }
    </script>

@endsection
