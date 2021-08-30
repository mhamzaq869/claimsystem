<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Contract;
use App\Models\Order;
use App\Models\Payout;
use App\Models\Project;
use App\Models\Userdetail;
use App\Models\Withdrawn;
use App\Notifications\StatusNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class VendorController extends Controller
{
    private $stripe;

    public function __construct()
    {
       $this->stripe = \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));;

    }
    public function projects()
    {
        $projects = Project::where('status',1)->get();
        return view('frontend.pages.projects',compact('projects'));
    }

    public function searchProjects(Request $request)
    {

        if($request->filled('keywords','pricemin','pricemax','preff_location')){
            $projects = Project::where('keywords','like','%'.$request->keywords.'%')
                    ->where('preff_location',$request->location)
                    ->where('price','>=',$request->pricemin)
                    ->where('price','<=',$request->pricemax)
                    ->get();
        } elseif($request->filled('pricemin','pricemax')){
            $projects =  $this->searchByPrice($request);
        }
        elseif($request->filled('location')){
            $projects =  $this->searchByLocation($request);
        }
        elseif($request->filled('keywords')){
            $projects =  $this->searchByKeywords($request);
        }else{
            $projects = Project::all();
        }

        return view('frontend.pages.projects')->with('projects',$projects);
    }
    private function searchByKeywords($request){
        $projects = Project::where('keywords','like','%'.$request->keywords.'%')
                    ->get();

        return $projects;
    }
    private function searchByPrice($request){
        $projects = Project::where('price','>=',$request->pricemin)
                    ->where('price','<=',$request->pricemax)
                    ->get();

        return $projects;
    }
    private function searchByLocation($request){

        $projects = Project::where('preff_location','LIKE',$request->location)->get();
        return $projects;
    }
    public function projectDetail($id)
    {
        $project = Project::find($id);
        return view('frontend.pages.proposal',compact('project'));
    }
    public function receiveOrders()
    {
        $orders=Order::orderBy('id','DESC')->get();
        $payout = Payout::where('user_id',Auth::user()->id)->whereNotNull('withdrawn')
                ->where('vendor_order',1)->get();

        return view('vendor.order.index')->with('orders',$orders)->with('payout',$payout);
    }
    public function receiveOrdersShow($id)
    {
        $order=Order::find($id);
        return view('vendor.order.show')->with('order',$order);
    }

    public function receiveOrdersEdit($id)
    {
        $order=Order::find($id);
        return view('vendor.order.edit')->with('order',$order);
    }
    public function receiveOrdersUpdate(Request $request, $id)
    {
        $order=Order::find($id);
        $this->validate($request,[
            'status'=>'required|in:new,process,delivered,cancel'
        ]);
        $data=$request->all();
        if($request->status=='delivered'){
            foreach($order->cart as $cart){
                $product=$cart->product;
                // return $product;
                $product->stock -=$cart->quantity;
                $product->save();
            }
        }
        $status=$order->fill($data)->save();
        if($status){
            request()->session()->flash('success','Successfully updated order');
        }
        else{
            request()->session()->flash('error','Error while updating order');
        }
        return redirect()->route('vendor.order.received');
    }
    public function receiveOrdersdestroy($id)
    {
        $order=Order::find($id);
        if($order){
            $status=$order->delete();
            if($status){
                request()->session()->flash('success','Order Successfully deleted');
            }
            else{
                request()->session()->flash('error','Order can not deleted');
            }
            return redirect()->route('vendor.order.received');
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    }
    public function orderStatus()
    {
        $contracts = Contract::where('req_by_user',Auth::user()->id)->get();
        return view('user.order.vendor.orders-status')->with('contracts',$contracts);
    }
    public function bidOnProject()
    {
        $bids = Bid::where('user_id',Auth::user()->id)->paginate(10);
        return view('user.bids.bids-on')->with('bids',$bids);
    }
    public function bidingOnProject(Request $request)
    {
        $count = Bid::where('project_id',$request->project_id)->where('user_id',Auth::user()->id)->count();

        if($count == 0):
            Bid::create([
            'project_id' => $request->project_id,
            'user_id' => Auth::user()->id,
            'cover_letter' => $request->cover_letter,
            'price' => $request->price,
            'days' => $request->days,
            ]);

            return redirect()->back()->with('success','Proposal has been sent successfully,please do wait for response')
                                     ->with('display','block')->with('price',$request->price);
        else:
            return redirect()->back()->with('danger','You have already sent a proposal on this project');
        endif;

    }

    public function submitWork(Request $request){

        $contract = Contract::find($request->project_id);

        $image = [];

        if($request->has('photos')){
            foreach($request->photos as $i => $photo){
                $fileName = $photo->getClientOriginalName();
                array_push($image,$fileName);
                $photo->move(public_path('upload'), $fileName);
            }

        }
        $images = json_encode($image);

        $contract->photos = $images;
        $contract->message = $request->message;
        $contract->status = 'delivered';
        $contract->save();

        return redirect()->back();
    }

    public function earning()
    {
        $payouts = Payout::where('user_id',Auth::user()->id)->whereNull('withdrawn')
                    ->where('status','1')
                    ->where('vendor_order','0')
                    ->get();
        // dd($payouts);
        $monthEarning =DB::table('payouts')
                    ->select("*",DB::raw("MONTH(created_at) as month"))
                    ->where('status','1')
                    ->where('vendor_order','0')
                    ->get();


        return view('user.earning.index')->with('payouts',$payouts)->with('mearning',$monthEarning);
    }
    public function withdrawn(Request $request)
    {

        $msg = '';

        $exist = Payout::where('user_id',Auth::user()->id)->where('withdrawn', $request->amount)->count();
        if($request->path() == 'vendor/order-withdraw'){
            $vendor_order = 1;
        }else{
            $vendor_order = 0;
        }
        if($exist == 0){
            Payout::create([
                'user_id' => Auth::user()->id,
                'withdrawn' => $request->amount,
                'vendor_order' => $vendor_order,
            ]);

            $msg = 'You Have Request To Withdraw Your Amount, it will be transfer with 4-5 days to your account';
            $details=[
                'title'=>'Payout Request Created for $'.$request->amount,
                'actionURL'=>route('admin.payment.request'),
                'fas'=>'fa-hand-holding-usd'
            ];
            Notification::send(Auth::user(), new StatusNotification($details));
        }

        return redirect()->back()->with('success',$msg)->with('danger','We have already received your request plese wait');


    }

    public function viewBank()
    {
        return view('user.bank.index');
    }

    public function addBank(Request $request)
    {
        if(Auth::user()->userdetail):
            Auth::user()->userdetail->update([
                'bank' => $request->bank,
                'acc_no' => $request->acc_no,
                'acc_title' => $request->acc_title,
            ]);
        else:
            Userdetail::create([
                'user_id' => Auth::user()->id,
                'bank' => $request->bank,
                'acc_no' => $request->acc_no,
                'acc_title' => $request->acc_title,
            ]);
        endif;

        return redirect()->back()->with('success','Bank Detail Added Successfully!');
    }

}
