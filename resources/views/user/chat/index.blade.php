
@extends('user.layouts.master')

@section('main-content')
<link href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
<script src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<div class="card shadow">
    <div class="card-body">

        <table id="Table_ID">
            <thead>
              <tr>
                  <th>Users</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($chats  as $chat)
                <tr>
                    <td>
                        <a href="{{url('messages',[$chat->id])}}" class="text-decoration-none ">
                          <div class="row">
                              <div class="col-md-2 col-4">
                                  @if ($chat->photo != null)
                                  <img src="{{asset($chat->photo)}}" class="position-relative" style="width: 70px" alt="sunil">
                                  @else
                                  <img src="{{asset('upload/profile/profile.jpg')}}" class="position-relative" style="width: 70px" alt="sunil">
                                  @endif
                                  <span class="position-absolute top-0 start-100 translate-middle p-1 {{($chat->online == 1) ? 'bg-success' : 'bg-danger'}} border border-light rounded-circle">
                                </span>
                              </div>
                              <div class="col-md-8 col-4">
                              <h5 class="text-dark ">{{$chat->name}}

                                </h5>
                              <p>{!! $chat->chat->last()->message ?? '' !!}.</p>
                              </div>
                              <div class="col-md-2 col-3">
                                 <button type="button" class="mt-3 btn btn-primary btn-sm px-4" style="border-radius: 25px">Chat</button>
                              </div>
                          </div>
                          </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>

    </div>
</div>


<script>
    $(document).ready( function () {
        $('#Table_ID').DataTable();
    } );
    </script>

@endsection
