
@extends('user.layouts.master')

@section('main-content')



<link href="{{asset('css/chat.css')}}" rel="stylesheet" id="bootstrap-css">

<div class="messaging">
  <div class="inbox_msg">
	<div class="inbox_people">
	  <div class="headind_srch">
		<div class="recent_heading">
		  <h4>Recent</h4>
		</div>
		<div class="srch_bar">
		  <div class="stylish-input-group">
			<input type="text" class="search-bar"  placeholder="Search" >
			</div>
		</div>
	  </div>
	  <div class="inbox_chat scroll">
          @foreach ($chats as $chat)
            <a href="javascript:void(0)" onclick="chat({{$chat->toUser->id}})">
                <div class="chat_list active_chat">
                    <div class="chat_people">
                    <div class="chat_img"> <img src="{{asset('upload/profile/'.$chat->toUser->photo)}}" alt="sunil"> </div>
                    <div class="chat_ib">
                        <h5>{{$chat->toUser->name}}</h5>
                    </div>
                    </div>
                </div>
            </a>

          @endforeach

	  </div>
	</div>
	<div class="mesgs">
	  <div class="msg_history" id="messages">

        <div class="incoming_msg">
		  <div class="incoming_msg_img">
              <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
		  <div class="received_msg">
			<div class="received_withd_msg">
			  <p>Test which is a new approach to have all
				solutions</p>
			  <span class="time_date"> 11:01 AM    |    June 9</span></div>
		  </div>
		</div>

		<div class="outgoing_msg">
		  <div class="sent_msg">
			<p>Test which is a new approach to have all
			  solutions</p>
			<span class="time_date"> 11:01 AM    |    June 9</span> </div>
		</div>


	  </div>
	  <div class="type_msg">
		<div class="input_msg_write">
		  <input type="text" class="write_msg" placeholder="Type a message" />
		  <button class="msg_send_btn" type="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
		</div>
	  </div>
	</div>
  </div>
</div>


<script type="text/javascript">

function chat(id){

    let token = "{{csrf_token()}}"

    $.ajax({
            type:'POST',
            url:'/messages',
            data:{_token:token,id:id},
            success: function(data){
                for(var i=0; i<data.length; i++){
                    $("#messages").html(data[i]);
                }
            }
    });

}


</script>
@endsection
