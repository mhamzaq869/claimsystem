
@extends('backend.layouts.master')

@section('main-content')
<div class="container-fluid">

    <section id="tabs" class="project-tab">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-12"> <h2>All Transactions</h2></div>
                    </div>

                </div>

                <div class="card-body text-center py-5">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold py-3 ">Vendor Earning</h5>
                                     R.s{{ $payouts->pluck('vendor_earning')->sum() }}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold py-3">Admin Earning</h5>
                                    R.s{{ $payouts->pluck('admin_earning')->sum() }}
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="font-weight-bold py-3">Paid Amount</h5>
                                    R.s{{ $payouts->pluck('paid')->sum() }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table class="table table-bordered table-responsive" id="order-dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                        <th>S.N</th>
                                        <th>User</th>
                                        <th>Role</th>
                                        <th>Project Id</th>
                                        <th>Vendor Earning</th>
                                        <th>Admin Earning</th>
                                        <th>Paid Amount</th>
                                        <th>Transaction Id</th>
                                        <th>Bank Name</th>
                                        <th>Date</th>
                                        <th>Status</th>

                                  </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payouts as $i => $payout)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $payout->user->name ?? ''}}</td>
                                            <td>{{ $payout->user->role ?? ''}}</td>
                                            <td>{{ $payout->project_id }}</td>
                                            <td>R.s{{ $payout->vendor_earning ?? 0 }}</td>
                                            <td>R.s{{ $payout->admin_earning ?? 0}}</td>
                                            <td>R.s{{ $payout->paid ?? 0 }}</td>
                                            <td>{{ $payout->trans_id }}</td>
                                            <td>{{ $payout->bank }}</td>
                                            <td>{{ date('M d, Y',strtotime($payout->created_at ))}}</td>
                                            <td>
                                                @if ($payout->status == 1 )
                                                <button class="btn btn-success btn-sm px-5 d-flex"><i class="fa fa-check-circle mr-1 mt-1"></i> Transferred</button>
                                                {{-- @else
                                                <button class="btn btn-primary"><i class="fa fa-check-circle"></i> Accept</button> --}}
                                                @endif
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <h4> No Transaction Made</h4>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


                 {{-- <!-- Modal -->
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
                </div> --}}


            </div>

        </div>
    </section>

</div>

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
