@extends('user.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
    <h5 class="mb-3 display-4">All Project</h5>
    <a href="{{ route('user.project.create') }}" class="btn btn-primary float-right text-white">Add Projects</a>
      <div class="table-responsive">
          {{-- {{ dd($projects) }} --}}
          @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  {{ Session::get('message') }}
              </div>
          @endif

        @if(count($projects)>0)
        <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>S.N.</th>
              <th>Title</th>
              <th>Category</th>
              <th>Preffered Location</th>
              <th>Price</th>
              <th>Proposals</th>
              <th>keywords</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach($projects as $key=> $project)
                <tr>
                   @php $keywords = explode(',',$project->keywords) ; @endphp
                    <td>{{$key+1}}</td>
                    <td>{{$project->title}}</td>
                    <td>{{$project->category}}</td>
                    <td>{{$project->preff_location ?? 'N/A'}}</td>
                    <td>R.s {{$project->price}}</td>
                    <td><a href="{{ route('proposal.recive',$project->id) }}" class="badge badge-success">{{App\Models\Bid::where('project_id',$project->id)->count()}}</a></td>
                    <td>@foreach($keywords as $data) <label class="badge badge-primary">{{ $data }}</label> @endforeach</td>

                    <td>
                        <a href="{{route('user.project.edit',$project->id)}}" class="badge badge-warning btn-sm float-left mr-1 " style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="view" data-placement="bottom">
                            <i class="fas fa-edit mt-2"></i></a>
                        <form method="POST" action="{{route('user.project.delete',[$project->id])}}">
                          @csrf
                          @method('delete')
                              <button class="badge badge-danger btn-sm dltBtn" data-id={{$project->id}} style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Delete"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
          </tbody>
        </table>
        <span style="float:right">{{ $projects->links() }}</span>
        @else
          <h6 class="text-center">No orders found!!! Please order some projects</h6>
        @endif
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
