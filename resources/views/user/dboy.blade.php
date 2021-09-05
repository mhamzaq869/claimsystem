@extends('user.layouts.master')

@section('main-content')


<div class="container-fluid">
    <h1>Assigned Delivery Boy's</h1>
      <table class="table table-default bg-white mt-3">
          <thead>
              <tr>
                  <th>Sr#</th>
                  <th>Vendor name</th>
                  <th>Project Title</th>
                  <th>Dboy name</th>
                  <th>Dboy email</th>
                  <th>Dboy contact</th>
                  <th>chat</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($tasks as $i => $task)
                <tr>
                    <td>{{$i+1}}</td>
                    <td>{{$task->user->name}}</td>
                    <td>{{$task->project->title}}</td>
                    <td>{{$task->dboy->name ?? ''}}</td>
                    <td>{{$task->dboy->email ?? ''}}</td>
                    <td>{{$task->dboy->userdetail->phone ?? ''}}</td>
                    <td> <a class="btn btn-primary"
                        href="{{ url('messages/' . $task->dboy->id) }}">chat</a>
                    </td>
                </tr>
              @endforeach
          </tbody>
      </table>
</div>


@endsection

