
@extends('backend.layouts.master')

@section('main-content')
<div class="container-fluid">

    <section id="tabs" class="project-tab">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8"> <h2>Bids On Project</h2></div>
                        <div class="col-md-4 text-right">
                            <p class="mt-2 display-6">Bids <span class="badge badge-pill badge-primary text-white">{{ $bids->count() }}</span></p>
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <table class="table table-bordered" id="order-dataTable" width="100%" cellspacing="0">
                                <thead>
                                  <tr>
                                        <th>User</th>
                                        <th>Due on</th>
                                        <th>Project</th>
                                        <th>Cover Letter</th>
                                        <th>Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @forelse ($bids as $bid)
                                        <tr>
                                            <td>{{ $bid->user->name ?? ''}}</td>
                                            <td>{{ $bid->days }} days</td>
                                            <td>{{ $bid->project->title }}</td>
                                            <td>{{ $bid->cover_letter }}</td>
                                            <td>Rs.{{ $bid->project->price }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <h4>Bids Not Found</h4>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            {{ $bids->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection
