@extends('user.layouts.master')

@section('main-content')
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="card w-75 ">
        <div class="card-header pb-4">
            <img src="https://2018.islamabad.wordcamp.org/files/2018/09/PaymentsLogos.png" class="mb-3 w-50">
               <form action="{{ route('vendor.bank') }}" method="post">
                @csrf
                    <select name="bank" class="w-100">
                        <option value="1" @if(!empty(Auth::user()->userdetail) && Auth::user()->userdetail->bank == 1) selected @endif>Easypaisa</option>
                        <option value="2"  @if(!empty(Auth::user()->userdetail) && Auth::user()->userdetail->bank == 2) selected @endif>Jazzcash</option>
                    </select>

                    <input type="text" name="acc_title" class="form-control mb-3" value="{{ Auth::user()->userdetail->acc_title ?? '' }}" placeholder=" Name">
                    <input type="number" name="acc_no" class="form-control mb-3" value="{{ Auth::user()->userdetail->acc_no ?? '' }}" placeholder=" Number">

                    <button type="submit" class="btn btn-primary">Submit</button>
               </form>
        </div>
    </div>


@endsection
