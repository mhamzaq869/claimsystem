@extends('user.layouts.master')

@section('main-content')
    <style>
      /*/////////////////////////////////*/
/*/////////  chat styles  /////////*/
/*/////////////////////////////////*/
.chat
{
    list-style: none;
    margin: 0;
    padding: 0;
}

.chat li
{
    margin-bottom: 40px;
    padding-bottom: 5px;
    /* border-bottom: 1px dotted #B3A9A9; */
    margin-top: 10px;
    width: 80%;
}


.chat li .chat-body p
{
    margin: 0;
    /* color: #777777; */
}


.chat-care
{
    overflow-y: scroll;
    height: 350px;
}
.chat-care .chat-img
{
    width: 50px;
    height: 50px;
}
.chat-care .img-circle
{
    border-radius: 50%;
}
.chat-care .chat-img
{
    display: inline-block;
}
.chat-care .chat-body
{
    display: inline-block;
    max-width: 80%;
    background-color: #FFC195;
    border-radius: 12.5px;
    padding: 15px;
}
.chat-care .chat-body strong
{
  color: #0169DA;
}

.chat-care .admin
{
    text-align: right ;
    float: right;
}
.chat-care .admin p
{
    text-align: left ;
}
.chat-care .agent
{
    text-align: left ;
    float: left;
}
.chat-care .left
{
    float: left;
}
.chat-care .right
{
    float: right;
}

.clearfix {
  clear: both;
}




::-webkit-scrollbar-track
{
    box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
    background-color: #F5F5F5;
}

::-webkit-scrollbar
{
    width: 12px;
    background-color: #F5F5F5;
}

::-webkit-scrollbar-thumb
{
    box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
    background-color: #555;
}
    </style>
    <link type="text/css" rel="stylesheet" href="{{ asset('css/image-uploader.css') }}">

    <!-- DataTales Example -->
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <h4 class="card-title display-4 font-weight-normal">Order #{{ $contract->id }}</h4>
                    <small>
                        Vendor: <span class="text-primary">{{ $contract->requser->name ?? '' }}</span> |
                        {{ date('M d,Y', strtotime($contract->created_at)) }}
                    </small>
                </div>
                <div class="col-md-4 text-right">
                    <h2 class="display-4">R.s {{ $contract->price * 0.8 }}</h2>
                    @if ( $contract->status == 'active')
                        <label class="badge badge-primary text-white py-1 px-2">{{ $contract->status }}</label>
                    @elseif ($contract->status == 'late')
                        <label class="badge badge-danger text-white py-1 px-2">{{ $contract->status }}</label>
                    @elseif ($contract->status == 'delivered')
                        <label class="badge badge-info text-white py-1 px-2">{{ $contract->status }}</label>
                    @elseif ($contract->status == 'completed')
                        <label class="badge badge-success text-white py-1 px-2">{{ $contract->status }}</label>
                    @endif
                </div>
            </div>
            <hr>
            @php
                $bid = App\Models\Bid::where('user_id', $contract->req_by_user)
                    ->where('project_id', $contract->project_id)
                    ->first();
                Auth::user()->contract_id =  $contract->id;
            @endphp
            <p>{{ $bid->cover_letter ?? ''}}</p>
            <input type="hidden" id="expiry"
                value="{{ date('M d,Y H:i:s', strtotime($contract->created_at . "+".($bid->days ?? $contract->delivery )."days")) }}">

            <table class="table mt-3 mb-4">
                <thead class="thead-light">
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Duration</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $bid->project->title ?? 'Custom Proposal'}}</td>
                        <td> x1 </td>
                        <td>{{ $bid->days ?? $contract->delivery }} days</td>
                        <td>{{ $contract->price * 0.8 }}</td>
                    </tr>
                </tbody>
            </table>

            @if (Auth::user()->role == 'vendor')

                @if ($contract->status == 'delivered')
                <div class="mt-5 text-center">
                    <i class="fa fa-box-open fa-3x text-primary"></i> <br>
                    <h5 class="font-weight-bold text-primary">HERE'S YOUR DELIVERY!</h5>
                </div>


                <p class="my-2">{{ $contract->message ?? '' }}</p>

                @else
                    @if ($contract->status == 'completed')

                    <div class="bg-success text-white p-2 rounded" role="alert">
                        <h3 class="mt-2"> <i class="fa fa-check-circle"></i> Order completed. You Earned Rs. {{ $contract->price * 0.8 }}</h3>
                    </div>
                     @else
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modelId">
                        Deliver Work
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body mt-5 p-4">
                                    <form action="{{ route('vendor.deliver') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="project_id" value="{{ $contract->id }}">
                                        <label for="msg">Message</label>
                                        <textarea name="message" id="" cols="30" rows="5"></textarea>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">

                                                    <div class="field" align="left"></div>

                                                    <div class="input-field">
                                                        <label class="active">Photos</label>
                                                        <input type="file" id="files" name="files[]" multiple hidden/>
                                                        <div class="input-images-2" style="padding-top: .5rem;"></div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-success float-right">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endif
                @endif
            @else

                @if ($contract->status == 'completed')

                <div class="bg-success text-white p-2 rounded" role="alert">
                    <h3 class="mt-2"> <i class="fa fa-check-circle"></i> Order completed.</h3>
                </div>
                @endif

                @if ($contract->status == 'delivered')
                    <!-- Button trigger modal -->
                <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#reject">
                    Reject
                </button>

                <!-- Reject Modal -->
                <div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="height: 450px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mt-5 p-4">
                                <form action="{{ route('reject.submit.work') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $contract->project_id }}">
                                    <input type="hidden" name="by" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="to" value="{{ $contract->req_by_user }}">
                                    <div class="form-group bg-danger p-3" id="rating-ability-wrapper">
                                        <div class="row">
                                            <div class="col-md-12 text-white">
                                                <h4 class="font-weight-bold">Reason For Rejection </h4>
                                                <h6>How would you rate your overall experience with this vendor?</h6>
                                            </div>

                                        </div>
                                    </div>
                                    <label class="font-weight-bold">Share Some Detail (Publicly)</label>
                                    <textarea name="review" class="form-control mt-3" id="" cols="30" rows="4"></textarea>

                                    <button type="submit" class="btn btn-danger float-right mt-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#review">
                    Accept Work
                </button>

                <!-- Accept Modal -->
                <div class="modal fade" id="review" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="height: 450px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body mt-5 p-4">
                                <form action="{{ route('user.review') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $contract->project_id }}">
                                    <input type="hidden" name="by" value="{{ Auth::user()->id }}">
                                    <input type="hidden" name="to" value="{{ $contract->req_by_user }}">
                                    <div class="form-group bg-success p-3" id="rating-ability-wrapper">
                                        <div class="row">
                                            <div class="col-md-7 text-white">
                                                <h4 class="font-weight-bold">Overall Experience</h4>
                                                <h6>How would you rate your overall experience with this vendor?</h6>
                                            </div>
                                            <div class="col-md-5 text-right">
                                                <label class="control-label" for="rating">
                                                    <span class="field-label-info"></span>
                                                    <input type="hidden" id="selected_rating" name="rating" value="" required="required">
                                                </label>
                                                <h2 class="bold rating-header" style="">
                                                    <span class="selected-rating">0</span><small> / 5</small>
                                                </h2>
                                                <i  type="button" class="fa fa-star btnrating text-white" aria-hidden="true" data-attr="1" id="rating-star-1"></i>
                                                <i  type="button" class="fa fa-star btnrating text-white" aria-hidden="true" data-attr="2" id="rating-star-2"></i>
                                                <i  type="button" class="fa fa-star btnrating text-white" aria-hidden="true" data-attr="3" id="rating-star-3"></i>
                                                <i  type="button" class="fa fa-star btnrating text-white" aria-hidden="true" data-attr="4" id="rating-star-4"></i>
                                                <i  type="button" class="fa fa-star btnrating text-white" aria-hidden="true" data-attr="5" id="rating-star-5"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <label class="font-weight-bold">Share Some Detail (Publicly)</label>
                                    <textarea name="review" class="form-control mt-3" id="" cols="30" rows="4"></textarea>

                                    <button type="submit" class="btn btn-success float-right mt-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif



            @endif
        </div>
    </div>
    @if ($contract->status != 'delivered' && $contract->status != 'completed')
    <div class="row my-3 ">
        <div class="col-md-12  ml-auto mr-auto">
            <div class="text-center">
                <div class="d-flex" id="time">
                    <div class="card">
                        <div class="card-body bg-dark text-light text-center p-3">
                            <h1 id="days">23</h1>
                            <small>Days</small>
                        </div>
                    </div>

                    <div class="card ml-2">
                        <div class="card-body text-light text-center bg-dark p-3">
                            <h1 id="hours">3</h1>
                            <small>Hours</small>
                        </div>
                    </div>
                    <div class="card ml-2">
                        <div class="card-body text-light text-center bg-dark p-3">
                            <h1 id="minutes">23</h1>
                            <small>Minutes</small>
                        </div>
                    </div>
                    <div class="card ml-2">
                        <div class="card-body text-light text-center bg-dark p-3">
                            <h1 id="seconds">23</h1>
                            <small>Seconds</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else

    <div class="row">
        <div class="col-md-12">
            <div id="gallery-demo" class="simplegallery">
                <div class="content">
                    @foreach (json_decode($contract->photos) as $i => $image)
                    <img src="{{ asset('upload/'.$image) }}" id="thumb_{{ $i+1 }}">
                    @endforeach
                </div>
                <div class="clear"></div>
                <div class="thumbnail">
                    @foreach (json_decode($contract->photos) as $i => $image)
                        <div class="thumb"> <a href="#thumb_{{ $i+1 }}" rel="{{ $i+1 }}"> <img src="{{ asset('upload/'.$image) }}"> </a> </div>
                    @endforeach
                </div>
              </div>
        </div>
    </div>
    @endif

@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('js/profile_review.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/image-uploader.js') }}"></script>

<script>
function expiryDate() {

    var date = document.getElementById('expiry').value

    // Set the date we're counting down to

    var countDownDate = new Date(date).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        console.log(hours,date);
        // Display the result in the element with id="demo"
        document.getElementById("days").innerHTML = days
        document.getElementById("hours").innerHTML = hours
        document.getElementById("minutes").innerHTML = minutes
        document.getElementById("seconds").innerHTML = seconds


        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("days").innerHTML = "EX";
            document.getElementById("hours").innerHTML = "PI";
            document.getElementById("minutes").innerHTML = "RE";
            document.getElementById("seconds").innerHTML = "D";
            // document.getElementById("time").innerHTML = '<div class="card"><div class="card-body bg-dark text-light text-center"><h1 id="days">EXPIRED</h1></div></div>';
        }
    }, 1000);
}
window.onload=expiryDate();

let preloaded = [];

$('.input-images-2').imageUploader({
preloaded: preloaded,
imagesInputName: 'photos',
preloadedInputName: 'old',
maxSize: 2 * 1024 * 1024,
maxFiles: 3
});

$(document).ready(function(){

$('#gallery-demo').simplegallery({
galltime : 400, // transition delay
gallcontent: '.content',
gallthumbnail: '.thumbnail',
gallthumb: '.thumb'
});

});

//chat box scrolling script
$('.card-body').scrollTop(1000000);



</script>


@endpush
