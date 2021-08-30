<!DOCTYPE html>
<html lang="zxx">
<head>
	@include('user.layouts.head')
</head>
<body class="js">

	<!-- Preloader -->
	<div class="preloader">
		<div class="preloader-inner">
			<div class="preloader-icon">
				<span></span>
				<span></span>
			</div>
		</div>
	</div>
	<!-- End Preloader -->

	<!-- Header -->
	@include('user.layouts.header')

    <div class="container">
      <div class="row py-5">
        <div class="col-md-3
        @if (Auth::user()->role == 'user')
            bg-basic shadow
        @else
            bg-dark
        @endif text-white py-4">
          @include('user.layouts.sidebar')
        </div>
        <div class="col-md-9">
          @yield('main-content')
        </div>
      </div>
    </div>
	<!--/ End Header -->

	@include('frontend.layouts.footer')

    <style>
        .display-4 {
            font-size: 40px;
        }
        .display-5{
            font-size: 25px;
        }
        .display-6 {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
        }
        .btn{

        }
    </style>

    @include('user.layouts.scripts')

</body>
</html>
