
@extends('backend.layouts.master')

@section('main-content')
<div class="container-fluid">

    <section id="tabs" class="project-tab">
        <div class="container-fluid">

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8"> <h2>Contracts</h2></div>
                        <div class="col-md-4 text-right">
                            <p class="mt-2 display-6">Contracts <span class="badge badge-pill badge-primary text-white">{{ $contracts->count() }}</span></p>
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
                                        <th>project</th>
                                        <th>Vendor</th>
                                        <th>User</th>
                                        <th>Delivery</th>
                                        <th>Expired</th>
                                        <th>Price</th>
                                        <th>status</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contracts as $i => $contract)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $contract->project->title }}</td>
                                            <td>{{ $contract->requser->name }}</td>
                                            <td>{{ $contract->user->name }}</td>
                                            <td>{{ $contract->delivery}} days</td>
                                            <td>{{ $contract->expired}}</td>
                                            <td>Rs.{{ $contract->price }}</td>
                                            <td>{{ $contract->status}}</td>
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

                            {{ $contracts->links() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

@endsection
