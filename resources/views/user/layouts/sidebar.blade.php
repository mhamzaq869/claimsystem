<style>
    .user-hover:hover {
        background-color: orange;
        color: white;
    }
    .bg-orange{
        background-color: orange;
    }
    .text-orange{
        color: orange !important;
    }
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <div class="text-center mb-3 ">
      @if (Auth()->user()->photo)
      <img class="rounded-circle w-50 bg-secondary" src="{{ asset(Auth()->user()->photo) }}" data-holder-rendered="true" >
      @else
      <img class="rounded-circle w-50" alt="80x80" src="{{ asset('backend/img/avatar.png') }}" data-holder-rendered="true" >
      @endif

      <h5 class="mt-1">{{ Auth::user()->name }}</h5>

    </div>




    @if(Auth::user()->role == 'dboy')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('user.order.index') }}">
            <span>Orders</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if(\Request::path() == 'messages') text-orange @endif" href="{{url('messages')}}">
            <span>Message</span>
        </a>
    </li>
    @endif




    <!-- Reviews -->
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{route('user.productreview.index')}}">
            <span>Reviews</span></a>
    </li> --}}

    @if(Auth::user()->role == 'user')
    <li class="nav-item  @if(\Request::path() == 'user') bg-orange @endif">
        <a class="nav-link pl-2 text-dark user-hover" href="{{route('user')}}">
          <span>Dashboard</span></a>
    </li>
    <li class="nav-item @if(\Request::path() == 'user/project') bg-orange @endif">
        <a class="nav-link pl-2 text-dark user-hover" href="{{route('user.project')}}">
            <span>Projects</span>
        </a>
    </li>
    <li class="nav-item @if(\Request::path() == 'messages') bg-orange @endif">
        <a class="nav-link pl-2 text-dark user-hover" href="{{url('messages')}}">
            <span>Message</span>
        </a>
    </li>
    @endif


    @if(Auth::user()->role == 'vendor')
        <li class="nav-item">
            <a class="nav-link @if(\Request::path() == 'user') text-orange @endif" href="{{route('user')}}">
            <span>Dashboard</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Request::path() == 'vendor/products') text-orange @endif" href="{{route('products.index')}}">
                <span>Products</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Request::path() == 'vendor/orders') text-orange @endif" href="{{route('vendor.order.status')}}">
                <span>Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Request::path() == 'vendor/bids') text-orange @endif" href="{{route('vendor.bids.project')}}">
                <span>Bids</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Request::path() == 'messages') text-orange @endif" href="{{url('messages')}}">
                <span>Message</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if(\Request::path() == 'vendor/viewbank') text-orange @endif" href="{{route('vendor.viewbank')}}">
                <span>Add Bank</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link @if(\Request::path() == 'vendor/earning') text-orange @endif" href="{{route('vendor.earning')}}">
                <span>Earning</span>
            </a>
        </li>
    @endif


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
