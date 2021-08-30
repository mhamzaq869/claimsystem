@extends('user.layouts.master')

@section('main-content')
<div class="container-fluid">
    @include('user.layouts.notification')
    <!-- Page Heading -->


    @if(Auth::user()->role == 'user')
    <!-- Content Row -->
    <div class="row no-gutters">
      <div class="col-xl-6 col-md-6 mb-4 shadow-sm">
        <div class="card border-left-primary border-right-0 h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Projects</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$projects->count()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-sitemap fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Products -->
      <div class="col-xl-6 col-md-6 mb-4 shadow-sm">
        <div class="card border-left-success border-right-0 h-100 py-2">
          <div class="card-body">
            <div class="row no-gutters align-items-center">
              <div class="col mr-2">
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Purchased Items</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$orders->count()}}</div>
              </div>
              <div class="col-auto">
                <i class="fas fa-cubes fa-2x text-gray-300"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Content Row -->


    <div class="row mb-3">
        <div class="col-md-12 col-lg-12 col-12">
            <div class="card">
                <div class="card-body">
                    @if(count($projects)>0)
                        <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>S.N.</th>
                            <th>Title</th>
                            <th>Preffered Location</th>
                            <th>Price</th>
                            <th>Bids</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($projects as $key=> $project)
                                <tr>
                                @php $keywords = explode(',',$project->keywords) ; @endphp
                                    <td>{{$key+1}}</td>
                                    <td>{{$project->title ?? ''}}</td>
                                    <td>{{$project->preff_location ?? 'N/A'}}</td>
                                    <td>R.s {{$project->price ?? ''}}</td>

                                    @php Session::put('project_id',$project->id) @endphp
                                    <td><button onclick="doChat({{$project->id}})" class="badge badge-success text-center" style="padding: 14px 15px;border-radius: 50%;">{{App\Models\Bid::where('project_id',$project->id)->count()}}</button></td>

                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <span style="float:right">{{ $projects->links() }}</span>
                        @else
                        <h6 class="text-center">No orders found!!! Please order some projects</h6>
                        @endif
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="boy" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header pb-5">
            <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body mt-5" id="users">

            </div>
        </div>
        </div>
    </div>


    @endif

<!------ Include the above in your HEAD tag ---------->

    @if (Auth::user()->role == 'vendor')
        <div class="row mb-3">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Active Orders - <span class="text-secondary">{{ $contract->count() }}(${{ $contract->pluck('price')->sum() * 0.8}})</span></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif


    @if(isset($contract))

        @foreach ($contract as $item)

        <div class="row">
            <div class="col-md-12 col-lg-12 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h3>{{ $item->project->title ?? ''}}</h3>
                        </div>
                        {!!  $item->project->bid[0]->cover_letter ?? '' !!}
                        <div class="float-right mt-3 text-white">
                            <a href="{{ route('contract.view', $item->id) }}" class="btn btn-warning">View</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    @endif

    @if (!empty($dboy) && $dboy != null)
        @if (!isset($_COOKIE['close']))
            <!-- Modal -->
            <div class="modal fade" id="dboy" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header w-100">
                     <h2 class="text-left ml-4">Delivery Boy's</h2>
                    <button type="button" class="close" data-dismiss="modal" id="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body mt-5">
                            @foreach ($dboy as $boy)
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            @if (!empty($boy->user->photo))
                                                <img src="{{ asset($boy->user->photo) }}" class="rounded-circle">
                                            @else
                                                <img src="{{ asset('backend/img/avatar.png')  }}" class="rounded-circle">
                                            @endif
                                        </div>
                                        <div class="col-md-7">
                                            <h2>{{ $boy->user->name }}</h2>
                                            {!! $boy->bio !!}
                                        </div>
                                        <div class="col-md-3">
                                        <div>
                                            <p> <i class="fa fa-phone-alt"></i> {{ $boy->phone ?? 'N/A' }}</p>
                                        </div>
                                        <div>
                                            <p> <i class="fa fa-map-marker-alt"></i> {{ $boy->address }}</p>
                                        </div>
                                        <div>

                                            @for ($i = 0; $i < 5; $i++)
                                                @if ($i < $boy->user->rate)
                                                    <i class="fa fa-star text-warning"></i>
                                                @else
                                                    <i class="fa fa-star"></i>
                                                @endif
                                            @endfor
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                    </div>
                </div>
                </div>
            </div>
        @endif
    @endif

  </div>
@endsection

@push('scripts')
<script type="text/javascript">

    $(document).ready( function () {
        $('#table_id').DataTable();
    } );

    function modalShow(){
        $('#dboy').modal('show');
    }

    document.getElementById("close").addEventListener('click', function(){
        document.cookie='close'+"="+1;
    })

    window.load = modalShow();


    function doChat(id)
    {
        $("#boy").modal("show");

        $.ajax({
            type:'GET',
            url:'user/fetchBider/'+id,
            success:function(data) {
                if(data){
                    for(var i=0; i<data.length; i++){
                        $("#users").html(data[i]);
                    }
                }
            }
         });
    }

</script>
@endpush
