@extends('backend.layouts.master')

@section('main-content')
 <!-- DataTales Example -->
 <div class="card shadow mb-4">
     <div class="row">
         <div class="col-md-12">
            @include('backend.layouts.notification')
         </div>
     </div>

    <div class="card-body">
        <div class="card-header">
            All Projects
        </div>
      <div class="table-responsive">

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
              <th>completed</th>
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
                    <td><a href="{{ route('admin.view.bids',$project->id) }}" class="badge badge-success">{{App\Models\Bid::where('project_id',$project->id)->count()}}</a></td>
                    <td>@foreach($keywords as $data) <label class="badge badge-primary">{{ $data }}</label> @endforeach</td>
                    <td>@if($project->status == 0) Yes @else No @endif</td>
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
@endsection

