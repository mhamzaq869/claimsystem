<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Bid;
use App\Models\Contract;
use App\Events\MessageSent;
use App\Models\Chat;
use App\Models\Message;
use App\Models\Payout;
use App\Models\ProfileReview;
use Illuminate\Console\Scheduling\Schedule;
use App\User;
class ProjectController extends Controller
{
    private $stripe;

    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
    }

    public function index()
    {

        $projects = project::where('status',1)->where('user_id',Auth::user()->id)->paginate(10);

        return view('user.users.project.index',compact('projects'));
    }
    public function create(Request $request)
    {
        return view('user.users.project.addproject');
    }
    public function store(Request $request)
    {
                // dd($request->all());
                $project = new Project();

                $project->user_id = auth()->user()->id;
                $project->title = $request->title;
                $project->delivery = $request->delivery;
                $project->category = $request->category;
                $project->price = $request->price;
                $project->description =  $request->description;
                $project->preff_location = $request->pref_location;
                $project->keywords = $request->keywords;

                // dd($request->photos[0]->getClientOriginalName());
                $image = [];

                if($request->has('photos')){
                    foreach($request->photos as $i => $photo){
                        $fileName = $photo->getClientOriginalName();
                        array_push($image,'upload/projects/'.$fileName);
                        $photo->move(public_path('upload/projects'), $fileName);
                    }

                }
                $images = json_encode($image);

                $project->images = $images;
                $project->save();

                return redirect()->back()->with('message','Project has been created Successfully!');

    }
    public function edit($id)
    {
        $project = project::where('id',$id)->first();
        // dd($project);
        return view('user.users.project.editproject',compact('project'));
    }

    public function update(Request $request)
    {
        // dd($request->all());
        $project = Project::find($request->id);

        $project->title = $request->title;
        $project->delivery = $request->delivery;
        $project->category = $request->category;
        $project->price = $request->price;
        $project->description =  $request->description;
        $project->preff_location = $request->pref_location;
        $project->keywords = $request->keywords;

        $image = [];

        if($request->has('photo')){
            foreach($request->photo as $i => $photo){
                $fileName = $photo->getClientOriginalName();
                array_push($image,'upload/projects/'.$fileName);
                $photo->move(public_path('upload/projects'), $fileName);
            }

        }
        $images = json_encode($image);

        $project->images = $images;
        $project->save();

        return redirect()->back()->with('message','Project has been updted Successfully!');

    }

    public function destroy($id)
    {
        Project::find($id)->delete();

        return redirect()->back()->with('message','Project deleted successfully!');
    }

    public function upload(Request $request)
    {
        // dd($request->all());

        $fileName = time().'.'.$request->filepond->extension();

        $request->filepond->move(public_path('upload'), $fileName);

        return 'success';

    }

    public function proposalRecive($id)
    {
        $proposals = Bid::where('project_id',$id)->paginate(10);

        $st = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = \Stripe\SetupIntent::create([
            'usage' => 'on_session', // The default usage is off_session
        ]);

        return view('user.users.project.proposals')->with('proposals',$proposals)->with('intent',$intent);

    }
    public function bidProposalAccept(Request $request)
    {
        // dd($request->all(),$request->message_id);
        try{

            $charges = $this->stripe->charges->create([
                'amount' => $request->price * 100,
                'currency' => 'usd',
                'source' => $request->cardMethod,
                'receipt_email' =>  Auth::user()->email,
            ]);


            if( $charges->status == 'succeeded'){
                // $charges = '';
                $expired = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')."+$request->delivery days"));

                $contract = Contract::create([
                    'project_id' => $request->project_id,
                    'req_by_user' => $request->req_by_user,
                    'acc_by_user' => Auth::user()->id,
                    'delivery' => $request->delivery,
                    'price'  => $request->price ,
                    'expired'  =>  $expired,
                    'status' => 'active',

                ]);

                $payout = Payout::create([
                    'user_id' =>  Auth::user()->id,
                    'project_id' => $request->project_id,
                    'vendor_earning' => $request->price * 0.8,
                    'admin_earning' => $request->price * 0.2,
                    'trans_id'     => $charges->id ?? '',
                    'bank'         => 'stripe'
                ]);

                Bid::where('project_id',$request->project_id)->delete();


            }
            return redirect()->back();
            // return redirect()->route('contract.view',$contract->id);

        } catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('danger',$e->getMessage());

        }

    }
    public function proposalAccept(Request $request)
    {
        // dd($request->all(),$request->message_id);
        try{
            $chat = Chat::find($request->message_id);

            $charges = $this->stripe->charges->create([
                'amount' => $request->price * 100,
                'currency' => 'usd',
                'source' => $request->cardMethod,
                'receipt_email' =>  Auth::user()->email,
            ]);


            if( $charges->status == 'succeeded'){
                // $charges = '';
                $expired = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')."+$request->delivery days"));

                $contract = Contract::create([
                    'project_id' => $request->project_id,
                    'req_by_user' => $request->req_by_user,
                    'acc_by_user' => Auth::user()->id,
                    'delivery' => $request->delivery,
                    'price'  => $request->price ,
                    'expired'  =>  $expired,
                    'status' => 'active',

                ]);

                $payout = Payout::create([
                    'user_id' =>  Auth::user()->id,
                    'project_id' => $request->project_id,
                    'vendor_earning' => $request->price * 0.8,
                    'admin_earning' => $request->price * 0.2,
                    'trans_id'     => $charges->id ?? '',
                    'bank'         => 'stripe'
                ]);



                $html  = '<div class="card"> <div class="card-body"><div class="row"><div class="col-md-12">';
                $html .= '<h5>Price:$'.$request->price .' - Days('.$request->delivery.')</h5>';
                $html .= '<div class="mt-2"><h5 class="text-left">Note:</h5><p class="mb-4 bg-white text-dark">'.$request->note.'</p>';
                $html .= '<button class="btn-secondary btn-sm disabled" type="button">Accepted</button>';
                $html .= '</div></div></div></div></div>';

                $chat->update(['message' => $html]);

                Bid::where('project_id',$request->project_id)->delete();


            }
            return redirect()->back();
            // return redirect()->route('contract.view',$contract->id);

        } catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('danger',$e->getMessage());

        }

    }

    public function acceptSubmitWork(Request $request)
    {
        // dd($request->all());
        ProfileReview::create($request->except('project_id','_token'));

        Contract::where('project_id',$request->project_id)->update([
            'status' => 'completed',
            'completed' => '1',
        ]);

        Payout::where('project_id',$request->project_id)->update([
            'status' => '1'
        ]);

        Project::where('id',$request->project_id)->update([
            'status' => 0
        ]);

        return redirect()->back();
    }

    public function rejectSubmitWork(Request $request)
    {

        Contract::where('project_id',$request->project_id)->update([
            'status' => 'active',
            'completed' => '0',
            'message' => $request->review,
        ]);

        Payout::where('project_id',$request->project_id)->update([
            'status' => '0'
        ]);

        Project::where('id',$request->project_id)->update([
            'status' => 1
        ]);

        return redirect()->back();
    }

    public function Contract($id)
    {
       $contract =  Contract::find($id);
       $chats = Chat::with('user')->where('contract_id',$contract->id ?? '')->get();

       $st = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

       $intent = \Stripe\SetupIntent::create([
           'usage' => 'on_session', // The default usage is off_session
       ]);

       return view('user.users.project.contract',compact('contract','chats','intent'));
    }

    public function chat($id,$project_id = null)
    {
       $chats = Chat::with('user')->where('user_id',Auth::user()->id)->where('to_user',$id)->get();
    //    $chats = Chat::where('user_id',Auth::user()->id)->orWhere('to_user',Auth::user()->id)->where('to_user',$id)->orWhere('user_id',$id)->get();
        if($chats->count() == 0 ){
            $chats[] =  Chat::create([
                'user_id' => Auth::user()->id,
                'to_user' => $id,
                'contract_id' => $project_id,
                'message' => "Hi!, How Are You Doing?",
            ]);

             Chat::create([
                'user_id' => $id,
                'to_user' => Auth::user()->id,
                'contract_id' => $project_id,
                'message' => "Hi!, How Are You Doing?",
            ]);
        }

        $st = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $intent = \Stripe\SetupIntent::create([
            'usage' => 'on_session', // The default usage is off_session
        ]);

       return view('user.chat.chatting',compact('chats','intent'));
    }

    public function fetchMessages($id,$to)
    {
        $messages = \DB::select('select * from `chats` where (`user_id` = ? or `to_user` = ?) and (`to_user` = ? or `user_id` = ?)', [$id,$id,$to,$to]);

        $all = [];

        foreach($messages as $message){

            if($message->user_id == Auth::user()->id):
                $html = '<a href="javascript:void(0)" onclick="message('.$message->id.')" id="users-'.$message->user_id.'"><div class="outgoing_msg" ><div class="sent_msg">';
                $html .= '<p>'.$message->message.'</p>';
                $html .= ' <span class="time_date"> '.date('H:i A',strtotime($message->created_at)).'    |   '.date('M d',strtotime($message->created_at)).'</span></div></div></a>';
            else:
                $html = '<a href="javascript:void(0)" onclick="message('.$message->id.')" id="users-'.$message->user_id.'"><div class="incoming_msg"><div class="incoming_msg_img">';
                $html .= '<img style="width:50px" src="'.asset($message->toUser->photo ?? "upload/profile/profile.jpg").'" alt="sunil"> </div>';
                $html .= '<div class="received_msg">';
                $html .= '<div class="received_withd_msg">';
                $html .= '<p>'.$message->message.'</p>';
                $html .= '</div></div>></a>';
            endif;


            array_push($all,$html);
        }
        return response([$all],200);


    }

    public function sendOfferMessage(Request $request)
    {
        $user = Auth::user();
        $message = Chat::create([
            'user_id' => Auth::user()->id,
            'to_user' => $request->to_user,
            'contract_id' => $request->contract_id,
            'message' => $request->html,
        ]);

        return "Offer Sent!";
    }

    public function sendMessages(Request $request)
    {

        Chat::create([
            'user_id' => Auth::user()->id,
            'to_user' => $request->id,
            'contract_id' => $request->project_id,
            'message' => $request->message,
        ]);

        $all = [];

        $messages = \DB::select('select * from `chats` where (`user_id` = ? or `to_user` = ?) and (`to_user` = ? or `user_id` = ?)', [Auth::user()->id,Auth::user()->id,$request->to,$request->to]);


        foreach($messages as $message){

            if($message->user_id == Auth::user()->id):
                $html = '<div class="outgoing_msg"><div class="sent_msg">';
                $html .= '<p>'.$message->message.'</p>';
                $html .= ' <span class="time_date"> '.date('H:i A',strtotime($message->created_at)).'    |   '.date('M d',strtotime($message->created_at)).'</span></div></div>';
            else:
                $html = '<div class="incoming_msg"><div class="incoming_msg_img">';
                $html .= '<img style="width:50px" src="'.asset($message->toUser->photo ?? "upload/profile/profile.jpg").'" alt="sunil"> </div>';
                $html .= '<div class="received_msg">';
                $html .= '<div class="received_withd_msg">';
                $html .= '<p>'.$message->message.'</p>';
                $html .= '</div></div>';
            endif;


            array_push($all,$html);
        }
        return response([$all],200);

    }

    public function message() {

        $chatts = Chat::where('user_id',Auth::user()->id)->get();
        $chats = User::whereIn('id',$chatts->pluck('to_user')->unique()->flatten())->get();

        return view('user.chat.index',compact('chats','chatts'));
    }


    public function fetchBiderUserToChat($id){

        $users = [];
        $bids = Bid::where('project_id',$id)->get();

        foreach($bids as $bid):
            $user = $bid->user->toArray();

            $html = '<div class="card mt-2 shadow-sm"><div class="card-body"><div class="row"><div class="col-md-1">';
            $html .= '<img src="'.asset($bid->user->photo ?? "").'" class="rounded-circle"></div><div class="col-md-9">';
            $html .= ' <h2>'.$bid->user->name.'</h2></div>';
            $html .= ' <div class="col-md-"><a href="messages/'.$bid->user->id.'/'.$id.'" class="btn btn-primary">Chat</a></div>';
            $html .= '</div></div></div></div></div>';

            array_push($users,$html);
        endforeach;


        return response($users,200);
    }
}
