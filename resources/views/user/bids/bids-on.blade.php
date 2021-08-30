
@extends('user.layouts.master')

@section('main-content')
<div class="container-fluid">

    <section id="tabs" class="project-tab">
        <div class="container-fluid">
            <h3 class="display-4">Bids On Project</h3>
            <p class="mt-2 display-6">Bids <span class="badge badge-pill badge-primary text-white">{{ $bids->count() }}</span></p>
            <div class="row mt-2">
                <div class="col-md-12">
                    <table class="table" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Project Title</th>
                                <th>Due on</th>
                                <th>Cover Letter</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bids as $bid)
                                <tr>
                                    <td><a href="{{ route('vendor.project.detail',$bid->project_id) }}">{{ $bid->project->title }}</a></td>
                                    <td>{{ $bid->days }}</td>
                                    <td>{{ $bid->cover_letter }}</td>
                                    <td>{{ $bid->project->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $bids->links() }}
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
