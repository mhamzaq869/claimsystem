@extends('frontend.layouts.master')

@section('title','E-SHOP || All Vendors')

@section('main-content')

<style>
    .card-img-top{
        position: relative;

    }
    .vendor_search_img{
        width: 28%;
        position: absolute;
        top: 67px;
        left: 37%;
        box-shadow: 2px 2px 2px 1px rgb(138 136 104 / 26%);

    }
</style>
	
		<!-- Breadcrumbs -->
		<div class="breadcrumbs">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bread-inner">
							<ul class="bread-list">
								<li><a href="{{route('home')}}">Home<i class="ti-arrow-right"></i></a></li>
								<li class="active"><a href="javascript:void(0);">All Vendors</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
        {{-- {{ dd($vendors) }} --}}
		<!-- End Breadcrumbs -->

        
		<form action="{{route('shop.filter')}}" method="POST">
		@csrf
			<!-- Product Style 1 -->
			<section class="product-area shop-sidebar shop-list shop section">
				<div class="container">
                    
					<div class="row">
                        @foreach ($vendors as $vendor)
                        <div class="col-lg-3 col-md-3 col-6">
							<div class="card">
                                <img class="card-img-top" src="{{ asset($vendor->photo) }}" alt="Card image cap">
                                <div class="card-body">
                                  <img class="vendor_search_img" src="{{ asset($vendor->photo) }}" alt="avatar">
                                  <div class="mt-3 text-center">
                                    <a href="{{ route('vendor.single',1) }}"><h5 class="card-title">{{ $vendor->name }}</h5></a>
                                      <p>1049 Followers</p>
                                      <p>91% Positive Seller Ratings</p>
                                  </div>
                                 
                                </div>
                              </div>
						</div>
                        @endforeach
					
					</div>
				</div>
			</section>
			<!--/ End Product Style 1  -->	
		</form>
		
@endsection
@push ('styles')
<style>
	 .pagination{
        display:inline-flex;
    }
	.filter_button{
        /* height:20px; */
        text-align: center;
        background:#F7941D;
        padding:8px 16px;
        margin-top:10px;
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
        $(document).ready(function(){
        /*----------------------------------------------------*/
        /*  Jquery Ui slider js
        /*----------------------------------------------------*/
        if ($("#slider-range").length > 0) {
            const max_value = parseInt( $("#slider-range").data('max') ) || 500;
            const min_value = parseInt($("#slider-range").data('min')) || 0;
            const currency = $("#slider-range").data('currency') || '';
            let price_range = min_value+'-'+max_value;
            if($("#price_range").length > 0 && $("#price_range").val()){
                price_range = $("#price_range").val().trim();
            }
            
            let price = price_range.split('-');
            $("#slider-range").slider({
                range: true,
                min: min_value,
                max: max_value,
                values: price,
                slide: function (event, ui) {
                    $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                    $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
                }
            });
            }
        if ($("#amount").length > 0) {
            const m_currency = $("#slider-range").data('currency') || '';
            $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
                "  -  "+m_currency + $("#slider-range").slider("values", 1));
            }
        })
    </script>

@endpush