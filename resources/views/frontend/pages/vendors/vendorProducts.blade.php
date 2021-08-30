@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Vendors Profile')

@section('main-content')

<link rel="stylesheet" href="{{ asset('frontend.css.vendor--profile.css') }}">

    <style>
        .card-img-top {
            position: relative;

        }

        .vendor_search_img {
            width: 28%;
            position: absolute;
            top: 67px;
            left: 37%;
            box-shadow: 2px 2px 2px 1px rgb(138 136 104 / 26%);

        }
        
        .main {
            width: 50%;
            margin: 50px auto;
        }

        /* Bootstrap 4 text input with search icon */

        .has-search .form-control {
            padding-left: 2.375rem;
        }

        .has-search .form-control-feedback {
            position: absolute;
            z-index: 2;
            display: block;
            width: 2.375rem;
            height: 2.375rem;
            line-height: 2.375rem;
            text-align: center;
            pointer-events: none;
            color: #aaa;
        }
        .banner {
            background-image: url( '{{ asset('frontend/img/vendor/banner-1.jpg') }} ');
            height: 150px;
            background-position: center;
            opacity: 0.6;
        }
        .top-11{
            top: 11px;
        }
    </style>

        <!-- banner -->
        <div class="banner">
            <div class="card w-25 ml-4 top-11">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img  src="https://www.kindpng.com/picc/m/22-223941_transparent-avatar-png-male-avatar-icon-transparent-png.png" alt="avatar" style="height:70px !important">
                        </div>
                        <div class="col-md-9 ">
                            <a href="">
                                <h5 class="card-title">Vendor Name</h5>
                            </a>
                            <p>1049 Followers</p>
                            <p>91% Positive Seller Ratings</p>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>

        <!-- End banner -->
    
        <!-- Navbar-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                  <ul class="navbar-nav">
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('vendor.single',1) }}">Homepage <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('vendor.products',1) }}">All Products</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="{{ route('vendor.profile',1) }}">Profile</a>
                    </li>
                  
                  </ul>
                </div>
                <form class="form-inline">
                    <!-- Another variation with a button -->
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search this blog">
                        <div class="input-group-append">
                        <button class="btn btn-secondary" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </nav>
   
        <!-- End Navbar-->

        <form action="{{ route('shop.filter') }}" method="POST">
            @csrf
            <!-- Product Style 1 -->
            <section class="product-area shop-sidebar shop-list shop section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            <div class="shop-sidebar">
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Categories</h3>
                                    <ul class="categor-list">
                                        @php
                                            // $category = new Category();
                                            $menu = App\Models\Category::getAllParentWithChild();
                                        @endphp
                                        @if ($menu)
                                            <li>
                                                @foreach ($menu as $cat_info)
                                                    @if ($cat_info->child_cat->count() > 0)
                                            <li><a href="{{ route('product-cat', $cat_info->slug) }}">{{ $cat_info->title }}</a>
                                                <ul>
                                                    @foreach ($cat_info->child_cat as $sub_menu)
                                                        <li><a
                                                                href="{{ route('product-sub-cat', [$cat_info->slug, $sub_menu->slug]) }}">{{ $sub_menu->title }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @else
                                            <li><a href="{{ route('product-cat', $cat_info->slug) }}">{{ $cat_info->title }}</a>
                                            </li>
                                        @endif
                                        @endforeach
                                        </li>
                                        @endif
                                        {{-- @foreach (Helper::productCategoryList('products') as $cat)
                                                    @if ($cat->is_parent == 1)
                                                        <li><a href="{{route('product-cat',$cat->slug)}}">{{$cat->title}}</a></li>
                                                    @endif
                                                @endforeach --}}
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Shop By Price -->
                                <div class="single-widget range">
                                    <h3 class="title">Shop by Price</h3>
                                    <div class="price-filter">
                                        <div class="price-filter-inner">
                                            {{-- <div id="slider-range" data-min="10" data-max="2000" data-currency="%"></div>
                                                        <div class="price_slider_amount">
                                                        <div class="label-input">
                                                            <span>Range:</span>
                                                            <input type="text" id="amount" name="price_range" value='@if (!empty($_GET['price'])) {{$_GET['price']}} @endif' placeholder="Add Your Price"/>
                                                        </div>
                                                    </div> --}}
                                            @php
                                                $max = DB::table('products')->max('price');
                                                // dd($max);
                                            @endphp
                                            <div id="slider-range" data-min="0" data-max="{{ $max }}"></div>
                                            <div class="product_filter">
                                                <button type="submit" class="filter_button">Filter</button>
                                                <div class="label-input">
                                                    <span>Range:</span>
                                                    <input style="" type="text" id="amount" readonly />
                                                    <input type="hidden" name="price_range" id="price_range" value="@if (!empty($_GET['price'])) {{ $_GET['price'] }} @endif" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
    
                                </div>
                                <!--/ End Shop By Price -->
                                <!-- Single Widget -->
                                <div class="single-widget recent-post">
                                    <h3 class="title">Recent post</h3>
    
                                </div>
                                <!--/ End Single Widget -->
                                <!-- Single Widget -->
                                <div class="single-widget category">
                                    <h3 class="title">Brands</h3>
                                    <ul class="categor-list">
    
                                    </ul>
                                </div>
                                <!--/ End Single Widget -->
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12">
                            <div class="row">
                                <div class="col-12">
                                    <!-- Shop Top -->
                                    <div class="shop-top">
                                        <div class="shop-shorter">
                                            <div class="single-shorter">
                                                <label>Show :</label>
                                                <select class="show" name="show" onchange="this.form.submit();">
                                                    <option value="">Default</option>
                                                    <option value="9" @if (!empty($_GET['show']) && $_GET['show'] == '9') selected @endif>09</option>
                                                    <option value="15" @if (!empty($_GET['show']) && $_GET['show'] == '15') selected @endif>15</option>
                                                    <option value="21" @if (!empty($_GET['show']) && $_GET['show'] == '21') selected @endif>21</option>
                                                    <option value="30" @if (!empty($_GET['show']) && $_GET['show'] == '30') selected @endif>30</option>
                                                </select>
                                            </div>
                                            <div class="single-shorter">
                                                <label>Sort By :</label>
                                                <select class='sortBy' name='sortBy' onchange="this.form.submit();">
                                                    <option value="">Default</option>
                                                    <option value="title" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'title') selected @endif>Name</option>
                                                    <option value="price" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'price') selected @endif>Price</option>
                                                    <option value="category" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'category') selected @endif>Category</option>
                                                    <option value="brand" @if (!empty($_GET['sortBy']) && $_GET['sortBy'] == 'brand') selected @endif>Brand</option>
                                                </select>
                                            </div>
                                        </div>
                                        <ul class="view-mode">
                                            <li><a href="{{ route('product-grids') }}"><i class="fa fa-th-large"></i></a></li>
                                            <li class="active"><a href="javascript:void(0)"><i class="fa fa-th-list"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!--/ End Shop Top -->
                                </div>
                            </div>
                            <div class="row">
    
                            </div>
                            <div class="row">
                                <div class="col-md-12 justify-content-center d-flex">
                                    {{-- {{$products->appends($_GET)->links()}} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/ End Product Style 1  -->
        </form>
    
    

    @endsection
    @push('styles')
        <style>
            .pagination {
                display: inline-flex;
            }

            .filter_button {
                /* height:20px; */
                text-align: center;
                background: #F7941D;
                padding: 8px 16px;
                margin-top: 10px;
                color: white;
            }

        </style>
    @endpush
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

        {{-- <script>
        $('.cart').click(function(){
            var quantity=1;
            var pro_id=$(this).data('id');
            $.ajax({
                url:"{{route('add-to-cart')}}",
                type:"POST",
                data:{
                    _token:"{{csrf_token()}}",
                    quantity:quantity,
                    pro_id:pro_id
                },
                success:function(response){
                    console.log(response);
					if(typeof(response)!='object'){
						response=$.parseJSON(response);
					}
					if(response.status){
						swal('success',response.msg,'success').then(function(){
							document.location.href=document.location.href;
						});
					}
					else{
                        swal('error',response.msg,'error').then(function(){
							// document.location.href=document.location.href;
						}); 
                    }
                }
            })
        });
	</script> --}}
    <script>
        const menuBtn = document.querySelector(".menu-icon span");
        const searchBtn = document.querySelector(".search-icon");
        const cancelBtn = document.querySelector(".cancel-icon");
        const items = document.querySelector(".nav-items");
        const form = document.querySelector("form");
        menuBtn.onclick = ()=>{
          items.classList.add("active");
          menuBtn.classList.add("hide");
          searchBtn.classList.add("hide");
          cancelBtn.classList.add("show");
        }
        cancelBtn.onclick = ()=>{
          items.classList.remove("active");
          menuBtn.classList.remove("hide");
          searchBtn.classList.remove("hide");
          cancelBtn.classList.remove("show");
          form.classList.remove("active");
          cancelBtn.style.color = "#ff3d00";
        }
        searchBtn.onclick = ()=>{
          form.classList.add("active");
          searchBtn.classList.add("hide");
          cancelBtn.classList.add("show");
        }
      </script>
        <script>
            $(document).ready(function() {
                /*----------------------------------------------------*/
                /*  Jquery Ui slider js
                /*----------------------------------------------------*/
                if ($("#slider-range").length > 0) {
                    const max_value = parseInt($("#slider-range").data('max')) || 500;
                    const min_value = parseInt($("#slider-range").data('min')) || 0;
                    const currency = $("#slider-range").data('currency') || '';
                    let price_range = min_value + '-' + max_value;
                    if ($("#price_range").length > 0 && $("#price_range").val()) {
                        price_range = $("#price_range").val().trim();
                    }

                    let price = price_range.split('-');
                    $("#slider-range").slider({
                        range: true,
                        min: min_value,
                        max: max_value,
                        values: price,
                        slide: function(event, ui) {
                            $("#amount").val(currency + ui.values[0] + " -  " + currency + ui.values[
                            1]);
                            $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                        }
                    });
                }
                if ($("#amount").length > 0) {
                    const m_currency = $("#slider-range").data('currency') || '';
                    $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                        "  -  " + m_currency + $("#slider-range").slider("values", 1));
                }
            })

        </script>

    @endpush
