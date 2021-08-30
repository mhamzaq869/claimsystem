@extends('frontend.layouts.master')

@section('title', 'E-SHOP || Vendor Home')

@section('main-content')

    <!-- Product Style 1 -->
    <section class="product-area shop-sidebar shop-list shop section">
        <div class="container-fluid">
            <div class="row">
                
                <div class="col-lg-12 col-md-12 col-12">
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

    {{-- {{ dd($vendors) }} --}}
@endsection