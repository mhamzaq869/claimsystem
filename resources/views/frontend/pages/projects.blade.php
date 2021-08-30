@extends('frontend.layouts.master')

@section('main-content')

<link rel='dns-prefetch' href='http://kit.fontawesome.com/' />
<link rel='dns-prefetch' href='http://fonts.googleapis.com/' />
<link rel='dns-prefetch' href='http://s.w.org/' />
<link rel='preconnect' href='https://fonts.gstatic.com/' crossorigin />
<link rel="alternate" type="application/rss+xml" title="Exertio WordPress Theme &raquo; Feed" href="https://marketplace.exertiowp.com/feed/" />
<link rel="alternate" type="application/rss+xml" title="Exertio WordPress Theme &raquo; Comments Feed" href="https://marketplace.exertiowp.com/comments/feed/" />
		<script type="text/javascript">
			window._wpemojiSettings = {"baseUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/72x72\/","ext":".png","svgUrl":"https:\/\/s.w.org\/images\/core\/emoji\/13.0.1\/svg\/","svgExt":".svg","source":{"concatemoji":"https:\/\/marketplace.exertiowp.com\/wp-includes\/js\/wp-emoji-release.min.js?ver=5.6.2"}};
			!function(e,a,t){var n,r,o,i=a.createElement("canvas"),p=i.getContext&&i.getContext("2d");function s(e,t){var a=String.fromCharCode;p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,e),0,0);e=i.toDataURL();return p.clearRect(0,0,i.width,i.height),p.fillText(a.apply(this,t),0,0),e===i.toDataURL()}function c(e){var t=a.createElement("script");t.src=e,t.defer=t.type="text/javascript",a.getElementsByTagName("head")[0].appendChild(t)}for(o=Array("flag","emoji"),t.supports={everything:!0,everythingExceptFlag:!0},r=0;r<o.length;r++)t.supports[o[r]]=function(e){if(!p||!p.fillText)return!1;switch(p.textBaseline="top",p.font="600 32px Arial",e){case"flag":return s([127987,65039,8205,9895,65039],[127987,65039,8203,9895,65039])?!1:!s([55356,56826,55356,56819],[55356,56826,8203,55356,56819])&&!s([55356,57332,56128,56423,56128,56418,56128,56421,56128,56430,56128,56423,56128,56447],[55356,57332,8203,56128,56423,8203,56128,56418,8203,56128,56421,8203,56128,56430,8203,56128,56423,8203,56128,56447]);case"emoji":return!s([55357,56424,8205,55356,57212],[55357,56424,8203,55356,57212])}return!1}(o[r]),t.supports.everything=t.supports.everything&&t.supports[o[r]],"flag"!==o[r]&&(t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&t.supports[o[r]]);t.supports.everythingExceptFlag=t.supports.everythingExceptFlag&&!t.supports.flag,t.DOMReady=!1,t.readyCallback=function(){t.DOMReady=!0},t.supports.everything||(n=function(){t.readyCallback()},a.addEventListener?(a.addEventListener("DOMContentLoaded",n,!1),e.addEventListener("load",n,!1)):(e.attachEvent("onload",n),a.attachEvent("onreadystatechange",function(){"complete"===a.readyState&&t.readyCallback()})),(n=t.source||{}).concatemoji?c(n.concatemoji):n.wpemoji&&n.twemoji&&(c(n.twemoji),c(n.wpemoji)))}(window,document,window._wpemojiSettings);
		</script>
<style type="text/css">
    .btn-theme{
        border: 1px solid #F7941D !important;
        background-color: #F7941D !important;
        color: white !important;
    }
    h3:hover{
        color:  #F7941D !important;
    }
    .fa, .fas {
        font-family: 'FontAwesome' !important;
    font-weight: normal !important;
    }
</style>
<link rel='stylesheet' id='pretty-checkbox-css'  href='https://marketplace.exertiowp.com/wp-content/themes/exertio/css/pretty-checkbox.min.css?ver=5.6.2' type='text/css' media='all' />
<link rel='stylesheet' id='web-font-icons-css'  href='https://marketplace.exertiowp.com/wp-content/themes/exertio/css/font-all.css?ver=5.6.2' type='text/css' media='all' />
<link rel='stylesheet' id='exertio-style-css'  href='https://marketplace.exertiowp.com/wp-content/themes/exertio/css/theme.css?ver=5.6.2' type='text/css' media='all' />

<section class="fr-list-product "
    style='background: url(https://marketplace.exertiowp.com/wp-content/uploads/2020/12/sz.png); background-position: center center; background-size: cover; background-repeat: no-repeat;'>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="fr-list-content">
                    <div class="fr-list-srch">
                        <h1>Project Search</h1>
                    </div>
                    <div class="fr-list-details">
                        <ul>
                            <li><a href="https://marketplace.exertiowp.com/">Home</a></li>
                            <li><a href="javascript:void(0);">Project Search</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="fr-list-side-bar section-padding bg-gray-light-color  actionbar_space">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-xs-12 col-sm-12 col-md-12 col-xl-4">
                <div class="project-sidebar">
                    <div class="heading">
                        <h4>Search Filters</h4>
                    </div>
                    <div class="project-widgets">
                        <form action="{{ route('vendor.search.projects') }}" method="POST">
                            @csrf
                            <div class="panel panel-default">

                                <a role="button" class="" data-bs-toggle="collapse"> Search by Keyword </a>
                                <div id="search-widget" class="panel-collapse collapse show" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="keywords"
                                                placeholder="What are you looking for" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <a role="button" class="" data-bs-toggle="collapse"> Price </a>
                                <div id="price-widget" class="panel-collapse collapse show" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="extra-controls">
                                            <input type="text" class="services-input-from form-control" value=""
                                                name="pricemin" placeholder="Min Price"/>
                                            <input type="text" class="services-input-to form-control" value=""
                                                name="pricemax" placeholder="Max Price" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <a role="button" class="collapsed" data-bs-toggle="collapse" > Filter by Location </a>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="location"
                                            placeholder="What  are you looking for" value="">
                                    </div>
                                </div>


                            </div>
                            <div class="submit-btn">

                            <p><i>Select the options and press the Filter Result button to apply the changes
                                </i></p>

                                <button class="btn btn-theme btn-block" type="submit"> Filter Result</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-xs-12 col-sm-12 col-md-12 col-lg-8">
                <div class="row">
                    <div class="col-xl-12 col-xs-12 col-sm-12 col-md-12">
                        <div class="services-filter-2">
                            <form>
                                <div class="heading-area">
                                    <h4>Found {{ count($projects) }} Projects </h4>
                                </div>

                            </form>
                        </div>
                    </div>
                    {{-- {{ dd($projects->count()) }} --}}
                    @if ($projects->count() != 0)

                    <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                        @foreach ($projects as $project)
                        <div class="fr-right-detail-box">
                            <div class="fr-right-detail-content">
                                <div class="fr-right-details-products">
                                    <div class="fr-jobs-price">
                                        <div class="style-hd">
                                            R.s {{ $project->price }}<small class="protip" data-pt-position="top"
                                                data-pt-scheme="black"
                                                data-pt-title="Estimated Hours 100&lt;br&gt;&lt;br&gt;Total: 20*100= $2,000.00"></small> </div>
                                    </div>
                                    <div class="fr-right-details2">
                                        <a
                                            href="{{ route('vendor.project.detail',$project->id) }}">
                                            <h3 title="Assemble a 3D activity of 35 seconds">{{ $project->title }}</h3>
                                        </a>
                                    </div>
                                    @php $keywords = explode(',',$project->keywords); @endphp

                                    <div class="fr-right-product">
                                        <ul class="skills">
                                            @foreach ($keywords as $keyword)
                                            <li><a href="javascript:void(0)">{{ Str::ucfirst($keyword) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="fr-right-index font-weight-normal ">
                                        {!! \Illuminate\Support\Str::words($project->description,3) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="fr-right-information">
                                <div class="fr-right-list">
                                    <ul>
                                        <li>
                                            <p class="heading"> Expiry: </p>
                                            <div>
                                                <p>Never Expire </p>
                                            </div>
                                        </li>
                                        <li>
                                            <p class="heading">Proposals</p>
                                            <span>{{ $project->bid->count() }} Received </span>
                                        </li>
                                        <li>
                                            <p class="heading">Location</p>
                                            <span>
                                                {{ $project->preff_location ?? 'N/A' }} </span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="fr-right-bid">
                                    <ul>
                                        <li> <a href="javascript:void(0);" class="mark_fav protip "
                                                data-post-id="221" data-pt-position="top" data-pt-scheme="black"
                                                data-pt-title="Save project"></a>
                                        </li>
                                        <li><a href="{{ route('vendor.project.detail',$project->id) }}"
                                                class="btn btn-theme"> Send Proposal </a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    @else
                    <div class="col-xl-12 col-xs-12 col-lg-12 col-sm-12 col-md-12">
                        <div class="fr-right-detail-box">
                            <div class="fr-right-detail-content">
                                <div class="fr-right-details-products py-5">
                                    <div class="fr-right-index">
                                        <p>Sorry! No Such A Project Found Under This Search </p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    @endif
                </div>


            </div>

        </div>
    </div>
</section>



@endsection
