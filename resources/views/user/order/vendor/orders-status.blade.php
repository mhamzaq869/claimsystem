
@extends('user.layouts.master')

@section('main-content')
<div class="container-fluid">

    <section id="tabs" class="project-tab">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">New <span class=" ml-1 badge badge-primary" id="new">{{ $contracts->where('status','active')->count() }}</span></a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Active <span class=" ml-1 badge badge-info" id="active">{{ $contracts->where('status','active')->count() }}</span></a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Late <span class=" ml-1 badge badge-danger" id="late">{{ $contracts->where('status','late')->count() }}</span></a>
                            <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-delivered" role="tab" aria-controls="nav-contact" aria-selected="false">Completed <span class=" ml-1 badge badge-success">{{ $contracts->where('status','completed')->count() }}</span> </a>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Due on</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($contracts as $contract)
                                    @if ($contract->status == 'active')
                                    @php $new = $contract->count() @endphp
                                        <tr>
                                            <td><a href="#">{{ $contract->user->name }}</a></td>
                                            <td>{{ date('M d,Y', strtotime($contract->created_at.'+'.$contract->delivery.' days')) }}</td>
                                            <td>{{ $contract->project->price }}</td>
                                            <td><small class="bg-primary text-white p-1 px-2 rounded">{{  $contract->status}}</small></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Due on</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($contracts as $contract)
                                    @if ($contract->status == 'active')
                                        <tr>
                                            <td><a href="#">{{ $contract->user->name }}</a></td>
                                            <td>{{ date('M d,Y', strtotime($contract->created_at.'+'.$contract->delivery.' days')) }}</td>
                                            <td>{{ $contract->project->price }}</td>
                                            <td><small class="bg-info text-white p-1 px-2 rounded">{{ $contract->status }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Due on</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($contracts as $contract)
                                    @if ($contract->status == 'late')
                                        <tr>
                                            <td><a href="#">{{ $contract->user->name }}</a></td>
                                            <td>{{ date('M d,Y', strtotime($contract->created_at.'+'.$contract->delivery.' days')) }}</td>
                                            <td>{{ $contract->project->price }}</td>
                                            <td><small class="bg-danger text-white p-1 px-2 rounded">{{ $contract->status }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="nav-delivered" role="tabpanel" aria-labelledby="nav-contact-tab">
                            <table class="table" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Customer</th>
                                        <th>Due on</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($contracts as $contract)
                                    @if ($contract->status == 'completed')
                                    @php $completed = $contract->count(); @endphp
                                        <tr>
                                            <td><a href="#">{{ $contract->user->name }}</a></td>
                                            <td>{{ date('M d,Y', strtotime($contract->created_at.'+'.$contract->delivery.' days')) }}</td>
                                            <td>{{ $contract->project->price }}</td>
                                            <td><small class="bg-success text-white p-1 px-2 rounded">{{ $contract->status }}</small></td>
                                        </tr>
                                    @endif
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection
