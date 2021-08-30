@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Vendor Home')

@section('main-content')

    <style>
        .emp-profile {
            padding: 3%;
            margin-top: 3%;
            margin-bottom: 3%;
            border-radius: 0.5rem;
            background: #fff;
        }

        .profile-img {
            text-align: center;
        }

        .profile-img img {
            width: 70%;
            height: 100%;
        }

        .profile-img .file {
            position: relative;
            overflow: hidden;
            margin-top: -20%;
            width: 70%;
            border: none;
            border-radius: 0;
            font-size: 15px;
            background: #212529b8;
        }

        .profile-img .file input {
            position: absolute;
            opacity: 0;
            right: 0;
            top: 0;
        }

        .profile-head h5 {
            color: #333;
        }

        .profile-head h6 {
            color: #0062cc;
        }

        .profile-edit-btn {
            border: none;
            border-radius: 1.5rem;
            width: 70%;
            padding: 2%;
            font-weight: 600;
            color: #6c757d;
            cursor: pointer;
        }

        .proile-rating {
            font-size: 12px;
            color: #818182;
            margin-top: 5%;
        }

        .proile-rating span {
            color: #495057;
            font-size: 15px;
            font-weight: 600;
        }

        .profile-head .nav-tabs {
            margin-bottom: 5%;
        }

        .profile-head .nav-tabs .nav-link {
            font-weight: 600;
            border: none;
        }

        .profile-head .nav-tabs .nav-link.active {
            border: none;
            border-bottom: 2px solid #0062cc;
        }

        .profile-work {
            padding: 14%;
            margin-top: -15%;
        }

        .profile-work p {
            font-size: 12px;
            color: #818182;
            font-weight: 600;
            margin-top: 10%;
        }

        .profile-work a {
            text-decoration: none;
            color: #495057;
            font-weight: 600;
            font-size: 14px;
        }

        .profile-work ul {
            list-style: none;
        }

        .profile-tab label {
            font-weight: 600;
        }

        .profile-tab p {
            font-weight: 600;
            color: #0062cc;
        }

    </style>

    <section class="fr-list-product h-25"
        style="background: url(https://tropicaldiscovery.com/wp-content/grand-media/image/Atitlan-Menu-Banner-e1501248540966.jpg); background-position: center center; background-size: cover; background-repeat: no-repeat;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <div class="fr-list-content">
                        <div class="text-white text-center">
                            <h1 class="mt-5">Vendor Profile</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container mt-3">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="w-100">
                        @if(!empty($vendors->photo))
                        <img src="{{ asset($vendors->photo) }}" />
                        @else
                        <img src="{{ asset('upload/profile/profile.jpg') }}" />
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="profile-head">
                        <h5>{{ $vendors->name }}</h5>
                        <h6 class="mt-1">{{ $vendors->role }}</h6>
                        <p class="my-2">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $vendors->rate) <i class="fa fa-star
                                    text-warning"></i>
                                @else
                                    <i class="fa fa-star"></i> @endif
                            @endfor
                        </p>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                    aria-controls="home" aria-selected="true">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                    aria-controls="profile" aria-selected="false">Products</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-4">
                    <div class="profile-work">

                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    {{ $vendors->userdetail->bio ?? 'N/A' }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <i class="fa fa-map-marker"></i> {{ $vendors->userdetail->address ?? 'N/A' }}
                                </div>
                                {{-- <div class="col-md-7 text-left">
                                    <div id='printoutPanel'></div>
                                    <div id='myMap' style="height: 300px;"></div>
                                </div> --}}
                            </div>

                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row">
                            @if(!empty($vendors->product) && $vendors->product->count() != 0)
                                @foreach($vendors->product as $key=>$product)
                                <div class="col-sm-6 col-md-4 col-lg-4 p-b-35 isotope-item {{$product->cat_id}}">
                                    <div class="single-product">
                                        <div class="product-img">
                                            <a href="{{route('product-detail',$product->slug)}}">
                                                @php
                                                    $photo=explode(',',$product->photo);
                                                // dd($photo);
                                                @endphp
                                                <img class="default-img" src="{{asset($photo[0])}}" alt="{{$photo[0]}}">
                                                <img class="hover-img" src="{{asset($photo[0])}}" alt="{{$photo[0]}}">
                                                @if($product->stock<=0)
                                                    <span class="out-of-stock">Sale out</span>
                                                @elseif($product->condition=='new')
                                                    <span class="new">New</span
                                                @elseif($product->condition=='hot')
                                                    <span class="hot">Hot</span>
                                                @else
                                                    <span class="price-dec">{{$product->discount}}% Off</span>
                                                @endif


                                            </a>
                                            <div class="button-head">
                                                <div class="product-action">
                                                    {{-- <a data-toggle="modal" data-target="#{{$product->id}}" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a> --}}
                                                    <a title="Wishlist" href="{{route('add-to-wishlist',$product->slug)}}" ><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
                                                </div>
                                                <div class="ml-2">
                                                    <a title="Add to cart" href="{{route('add-to-cart',$product->slug)}}">Add to cart</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product-content">
                                            <h3><a href="{{route('product-detail',$product->slug)}}">{{$product->title}}</a></h3>
                                            <div class="product-price">
                                                @php
                                                    $after_discount=($product->price-($product->price*$product->discount)/100);
                                                @endphp
                                                <span>${{number_format($after_discount,2)}}</span>
                                                <del style="padding-left:4%;">${{number_format($product->price,2)}}</del>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
{{--
<script type='text/javascript'>

body.onload = function() {
    longlat(long,lat);
}


    function loadMapScenario() {
        var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
            /* No need to set credentials if already passed in URL */
            center: new Microsoft.Maps.Location({{$vendors->userdetail->lat ?? 0}},{{$vendors->userdetail->long ?? 0}}),
            zoom: 8
        });
        Microsoft.Maps.loadModule('Microsoft.Maps.Search', function() {
            var searchManager = new Microsoft.Maps.Search.SearchManager(map);
            var requestOptions = {
                bounds: map.getBounds(),
                where: 'Seattle',
                callback: function(answer, userData) {
                    map.setView({
                        bounds: answer.results[0].bestView
                    });
                    map.entities.push(new Microsoft.Maps.Pushpin(answer.results[0].location));
                }
            };
            searchManager.geocode(requestOptions);
        });

    }
</script> --}}
