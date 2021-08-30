@extends('user.layouts.master')

@section('main-content')
<script src="https://js.stripe.com/v3/"></script>
{{-- <script src="{{ asset('js/script.js') }}" ></script> --}}
<div class="container-fluid">

    @if(Session::has('success') && !empty(Session::get('success')))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('success') }}
    </div>
    @endif
    @if(Session::has('danger') && !empty(Session::get('danger')))
    <div class="alert alert-danger alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('danger') }}
    </div>
    @endif
    <!-- Content Row -->
    <div class="row no-gutters">

      <!-- Category -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary border-right-0 h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                <div class="text-xs text-uppercase mb-1 display-5">Month Earning </div>
                @if ($mearning->pluck('month')->unique('month')->first() ==  (int) date('m'))
                 <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $mearning->pluck('paid')->sum() }}</div>
                @else
                <div class="h5 mb-0 font-weight-bold text-gray-800">$0</div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- withdrawn -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-success border-right-0 h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                <div class="text-xs display-5 text-uppercase mb-1">Withdrawn</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">${{$payouts->pluck('paid')->sum()}}</div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- withdrawl -->
      <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-info border-right-0 h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2 text-center">
                    <form action="{{ route('vendor.withdraw') }}" method="post">
                        <input type="hidden" name="amount" value="{{ $payouts->pluck('vendor_earning')->sum() }}">
                      @csrf
                      <button @if($payouts->pluck('vendor_earning')->sum() >= 5000) type="submit" @else  type="button"  @endif class="border-0 bg-white">
                        <div class="text-xs display-5 text-uppercase mb-1">Withdraw</div>
                        <div class="h5 mb-0 mr-3 text-center font-weight-bold text-gray-800">${{ $payouts->pluck('vendor_earning')->sum() }}</div>
                      </button>
                    </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

      <table class="table table-default bg-white">
          <thead>
              <tr>
                  <th>Date</th>
                  <th class="text-center">Amount</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($payouts as $payout)
                @if ($payout->vendor_earning != null)
                <tr>
                    <td>{{ date('Y-m-d',strtotime($payout->created_at)) }}</td>
                    <td class="text-center">${{ $payout->vendor_earning ?? 0}}</td>
                </tr>
                @endif
              @endforeach
          </tbody>
      </table>
</div>


@endsection

