
@extends('backend.layouts.master')

@section('main-content')
<div class="container-fluid">

    <section id="tabs" class="project-tab">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8"> <h2>Withdraw Requests</h2></div>
                        <div class="col-md-4 text-right">
                            <p class="mt-2 display-6">Withdraw Requests <span class="badge badge-pill badge-primary text-white">{{ $payouts->count() }}</span></p>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                        <th>S.N</th>
                                        <th>Vendor</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payouts as $i => $payout)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $payout->user->name ?? ''}}</td>
                                            <td>Rs.{{ $payout->withdrawn }}</td>
                                            <td>{{ date('M d, Y',strtotime($payout->created_at ))}}</td>
                                            <td>
                                                <button onclick="paymentModal(this.id,{{ $payout->withdrawn }})" id="{{ $payout->id }}" class="btn btn-primary" data-toggle="modal" data-target="#modelId"><i class="fa fa-check-circle"></i> Accept</button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <h4>Withdraw Request Not Found</h4>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{ $payouts->links() }}


                        </div>
                    </div>
                </div>

                 <!-- Modal -->
                 <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog  modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Payment Transfer</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.payment.accept') }}" id="payemntForm" method="post">
                                    @csrf
                                    <input type="text" name="trans_id" class="form-control mb-3" placeholder="Transaction Id">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </section>

</div>

<script>
  function  paymentModal(id,amount){
        $('#payemntForm').append('<input type="hidden" name="payout_id" value="'+id+'" /><input type="hidden" name="amount" value="'+amount+'" />')
    }
</script>
@endsection



@push('styles')
  <link href="{{asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
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
  </script>
@endpush
