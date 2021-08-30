public function fetchMessages(Request $request)
    {

        $messages = Chat::with('user')->where('to_user',$request->id)->get();

        $all = [];

        foreach($messages as $message){

            $rights = ($message->user_id == Auth::user()->id)?"outgoing_msg":"incoming_msg";
            $pos = ($message->user_id == Auth::user()->id)?"right":"left";
            $img = ($message->user_id == Auth::user()->id)?"http://placehold.it/50/FA6F57/fff&text=".substr(Auth::user()->name,0,1):"http://placehold.it/50/55C1E7/fff&text=".substr($message->user->name,0,1);

            $html = '<div class="'.$rights.'">';
            $html .= '<div class="'.$rights.'_img">';
            $html .= '<img style="width:50px" src="'.($message->toUser->photo ?? "upload/profile/profile.jpg").'" alt="sunil"> </div>';
            $html .= '<div class="received_msg">';
            $html .= '<div class="received_withd_msg">';
            $html .= '<p>'.$message->message.'</p>';
            $html .= '</div></div>';

            array_push($all,$html);
        }

        return response([$all],200);


    }



    public function message() {

$chats = Chat::where('user_id',Auth::user()->id)->get();

return view('user.chat.index',compact('chats'));
}
