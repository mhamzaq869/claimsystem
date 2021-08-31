@extends('user.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row"></div>
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>
     @php
         $generated_amount = [];
     @endphp
    <div class="card-header py-3">
        <div class="row">
            <div class="col-md-12">
                <h6 class="m-0 font-weight-bold text-primary float-left">Order Lists</h6>
            </div>

        </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        @if(count($orders)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Quantity</th>
              <th>Charge</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>S.N.</th>
              <th>Order No.</th>
              <th>Name</th>
              <th>Email</th>
              <th>Quantity</th>
              <th>Charge</th>
              <th>Total Amount</th>
              <th>Status</th>
              <th>Action</th>
              </tr>
          </tfoot>
          <tbody>
            @foreach($orders as $i => $order)

            @foreach ( $order->cart as $ord)
               @if($ord->product->user->id == Auth::user()->id)
                @php
                    if($order->payment_method == 'stripe'){
                        array_push($generated_amount,$order->total_amount);
                    }
                    $shipping_charge=DB::table('shippings')->where('id',$order->shipping_id)->pluck('price');
                @endphp
                <tr>
                    <td>{{$order->id}}</td>
                    <td>{{$order->order_number}}</td>
                    <td>{{$order->first_name}} {{$order->last_name}}</td>
                    <td>{{$order->email}}</td>
                    <td>{{$order->quantity}}</td>
                    <td>@foreach($shipping_charge as $data) $ {{number_format($data,2)}} @endforeach</td>
                    <td>${{number_format($order->total_amount,2)}}</td>
                    <td>
                        @if($order->status=='new')
                          <span class="badge badge-primary">{{$order->status}}</span>
                        @elseif($order->status=='process')
                          <span class="badge badge-warning">{{$order->status}}</span>
                        @elseif($order->status=='delivered')
                          <span class="badge badge-success">{{$order->status}}</span>
                        @else
                          <span class="badge badge-danger">{{$order->status}}</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{route('order.received.show',$order->id)}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom"><i class="fas fa-eye"></i></a>
                        <a href="{{route('order.received.edit',$order->id)}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="edit" data-placement="bottom"><i class="fas fa-edit"></i></a>
                        <form method="POST" action="{{route('order.received.delete',[$order->id])}}">
                          @csrf
                          @method('delete')
                              <button class="btn btn-danger btn-sm dltBtn" data-id={{$order->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
                @endif

                @endforeach
            @endforeach
          </tbody>
        </table>
        @else
          <h6 class="text-center">No orders found!!! Please order some products</h6>
        @endif

      </div>
    </div>

    <div class="card-body">

       <div class="row">
        <div class="col-md-6 text-right">
            <h6 class="font-weight-bold">Already Withdrawn</h6>
            <h5 class="m-0 font-weight-bold mb-3">
                ${{ $payout->pluck('withdrawn')->sum() }}
            </h5>
        </div>
        <div class="col-md-6 text-right">
            <h6 class="font-weight-bold">Amount To Withdraw</h6>
            <h5 class="m-0 font-weight-bold mb-3">
                ${{ array_sum($generated_amount) - $payout->pluck('withdrawn')->sum() }}
            </h5>
            @if ($payout->pluck('withdrawn')->sum() != 0)
                <form action="{{ route('vendor.order.withdraw') }}" method="POST">
                    @csrf

                    <input type="hidden" name="amount" value="{{ array_sum($generated_amount) - $payout->pluck('withdrawn')->sum() }}">
                    <button class="btn btn-primary btn-sm ml-2 py-2"> Generate Payouts</button>
                </form>
            @endif
        </div>

   </div>
    </div>

</div>
@endsection

@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
  <style>
      div.dataTables_wrapper div.dataTables_paginate{
          display: none;
      }
  </style>
@endpush

@push('scripts')

  <!-- Page level plugins -->
  <script src="{{asset('backend/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('backend/js/demo/datatables-demo.js')}}"></script>
  <script>

      $('#order-dataTable').DataTable( {
            "columnDefs":[
                {
                    "orderable":false,
                    "targets":[8]
                }
            ]
        } );

        // Sweet alert

        function deleteData(id){

        }
  </script>
  <script>
      $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
          $('.dltBtn').click(function(e){
            var form=$(this).closest('form');
              var dataID=$(this).data('id');
              // alert(dataID);
              e.preventDefault();
              swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this data!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                       form.submit();
                    } else {
                        swal("Your data is safe!");
                    }
                });
          })
      })
  </script>
@endpush
