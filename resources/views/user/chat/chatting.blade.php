
@extends('user.layouts.master')

@section('main-content')

<link href="{{asset('css/chat.css')}}" rel="stylesheet" id="bootstrap-css">

<div class="card shadow">
    <div class="card-header shadow">
        <div class="row">
            <div class="col-md-1 col-3 text-center">
                <a href="{{url('messages')}}">
                    <i class="fas fa-arrow-left mt-2"></i>
                </a>
            </div>

            <div class="col-md-6 col-9">
                <h4>{{$chats->first()->toUser->name}}</h4>
                @if($chats->first()->toUser->online == 1)
                <button type="button" class="btn btn-outline-success btn-sm px-3 font-weight-bold" style="border-radius: 50px;font-size: 10px;">
                    Online
                </button>
                @else
                <button type="button" class="btn btn-outline-danger btn-sm px-3 font-weight-bold" style="border-radius: 50px;font-size: 10px;">
                    Offline
                </button>
                @endif

            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="messaging">
            <div class="inbox_msg border-0">
                <div class="mesgs w-100">
                    <div class="msg_history" id="messages">
                        {{-- @foreach ($chats as $chat)
                            @if ($chat->user_id == Auth::user()->id)
                            <div class="outgoing_msg">
                                <div class="sent_msg">
                                    <p>{{$chat->message}}</p>
                                    <span class="time_date"> {{date('H:i A',strtotime($chat->created_at))}}   |  {{date('M d',strtotime($chat->created_at))}}</span>
                                </div>
                            </div>
                            @else
                            <div class="incoming_msg">
                                <div class="incoming_msg_img">
                                    <img style="width:50px" src="{{asset($chat->toUser->photo ?? "upload/profile/profile.jpg")}}" alt="sunil">
                                </div>
                                <div class="received_msg">
                                    <div class="received_withd_msg">
                                        <p>{{$chat->message}}</p>
                                </div>
                            </div>
                            @endif
                        @endforeach --}}
                    </div>
                    <div class="type_msg">
                    <div class="input_msg_write">
                        <input type="text" class="write_msg" id="input_msg" placeholder="Type a message" />
                        @if (Auth::user()->role == 'vendor')
                        <button class="msg_send_btn mr-5" data-toggle="modal" data-target="#offer" type="button">
                            <i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                        </button>
                        @endif

                        <button class="msg_send_btn" onclick="chat()" type="button">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>

                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('user.chat.acceptOfferModal')

@include('user.chat.offerModal')


<script src="https://js.stripe.com/v3/"></script>

<script type="text/javascript">



function chat(){

    let token = "{{csrf_token()}}"
    let msg = $("#input_msg").val();
    let to_user = "{{$chats->first()->toUser->id}}"
    let project = "{{$chats->first()->contract_id}}"

    $.ajax({
            type:'POST',
            url:'/sendMessages',
            data:{_token:token,message:msg,id:to_user,project_id:project},
            success: function(data){
                $("#input_msg").val('')
                for(var i=0; i<data.length; i++){
                    $("#messages").html(data[i]);
                }
            }
    });

}

function get_real_messages() {

    let url = "{{url('getChatMessages',[Auth::user()->id,$chats->first()->toUser->id])}}"

    $.ajax({
        type:'GET',
        url: url,
        success:function(data) {
                if(data){
                    for(var i=0; i<data.length; i++){
                        $("#messages").html(data[i]);
                    }

                    var usr = document.getElementById("user-"+{{Auth::user()->id}})

                    if(usr == {{Auth::user()->id}}){
                        usr.setAttribute("disabled","true")
                    }
                }
            }
    });
}

let interv = setInterval(function(){
    get_real_messages()
}, 1000);


// Create a Stripe client.
var stripe = Stripe("{{ env('STRIPE_KEY') }}");
// console.log(stripe.elements());
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
            color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
};
// Create an instance of the card Element.
var card = elements.create('card', {
    hidePostalCode: true,
    style: style
});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
});


var mid;
function message(id){
   mid = id
}

// Handle form submission.
function formSubmit(id,offer,delivery,vendor,note){
    var form = document.getElementById('form'+id);

    $("#amount").html(offer)
    $("#offerPrice").val(offer)
    $("#offerDelivery").val(delivery)
    $("#offerVendor").val(vendor)
    $("#msg_id").val(mid)
    $("#note_id").val(note)

    form.addEventListener('submit', function(event) {

        const cardButton = document.getElementById('client_secret');
        const clientSecret = cardButton.getAttribute('value');
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            var hiddenCardInput = document.createElement('input');
            hiddenCardInput.setAttribute('type', 'hidden');
            hiddenCardInput.setAttribute('name', 'cardMethod');
            hiddenCardInput.setAttribute('value', result.token.id);
            form.appendChild(hiddenCardInput);
        });

        stripe.handleCardSetup(clientSecret, card, {
                payment_method_data: {}
            })
            .then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    form.submit();
                }
            });
    });

}



</script>

@endsection
