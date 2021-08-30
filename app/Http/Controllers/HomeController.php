<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Order;
use App\Models\ProductReview;
use App\Models\PostComment;
use App\Models\Userdetail;
use App\Models\Contract;
use App\Models\Project;
use App\Models\Bid;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(){
        if(Auth::user()->role == 'admin'){
            return view('admin.index');
        }
        elseif(Auth::user()->role == 'user')
        {
            $projects = Project::with('bid')->where('user_id',Auth::user()->id)->where('status',1)->paginate(10);
            $orders   = Order::where('user_id',Auth::user()->id)->get();
            $contract = Contract::where('req_by_user',Auth::user()->id)->orWhere('acc_by_user',Auth::user()->id)->where('status','active')->get();

            return view('user.index',compact('projects','orders','contract'));
        }
        else{
            $contract = Contract::where('status','active')->get();

            $userss = User::where('role','dboy')->get();


            $dboy = [];
            foreach($userss as $user):
                    if(Auth::user()->role == 'vendor' && !empty($user->userdetail)){
                        $dboy = $user->userdetail->select("*",DB::raw("6371 * acos(cos(radians(".(Auth::user()->userdetail->lat ?? 0) ."))
                                * cos(radians(userdetails.lat))
                                * cos(radians(userdetails.long) - radians(".(Auth::user()->userdetail->long ?? 0 )."))
                                + sin(radians(".(Auth::user()->userdetail->lat ?? 0)."))
                                * sin(radians(userdetails.lat))) AS distance"))
                                ->whereIn('user_id',$userss->pluck('id'))
                                ->get();

                    }


                endforeach;
            // dd($dboy);
            // dd($contract[0]->project->title);
            return view('user.index')->with('contract',$contract)->with('dboy',$dboy);
        }
    }

    public function profile(){
        $profile=Auth()->user();

        return view('user.users.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id){

        $user=User::findOrFail($id);

        $user_detail=Userdetail::where('user_id',$id)->first();

        if($user_detail){
            $user_detail->bio = $request->bio ?? '';
            $user_detail->address = $request->address ?? '';
            $user_detail->city = $request->city ?? '';
            $user_detail->country = $request->country ?? '';
            $user_detail->lat = $request->lat ?? '';
            $user_detail->long = $request->long ?? '';

            if($request->has('photo')){

            $fileName = $request->photo[1]->getClientOriginalName();
            $path = 'upload/profile/'.$fileName;
            $request->photo[1]->move(public_path('upload/profile/'), $fileName);

                $users = User::find(Auth::user()->id)->update([
                    'photo' => $path
                ]);
            }

            if($request->has('cnic_front')){

                $fileName = $request->cnic_front->getClientOriginalName();
                $path = 'upload/profile/'.$fileName;
                $request->cnic_front->move(public_path('upload/profile/'), $fileName);

                $user_detail->cnic_front = $path;
            }

            if($request->has('cnic_back')){

                $fileName = $request->cnic_back->getClientOriginalName();

                $path = 'upload/profile/'.$fileName;
                $request->cnic_back->move(public_path('upload/profile/'), $fileName);
                $user_detail->cnic_back = $path;
            }

            $user_detail->save();

        }else{
            Userdetail::create([
                'user_id' => $id,
                'bio' => $request->bio,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country,
                'lat' => $request->lat,
                'long' => $request->long,
            ]);

            if($request->has('photo')){

                $fileName = $request->photo[1]->getClientOriginalName();

                $path = 'upload/profile/'.$fileName;
                $request->photo[1]->move(public_path('upload/profile/'), $fileName);

                    $users = User::find(Auth::user()->id)->update([
                        'photo' => $path
                    ]);
                }

        }

        // $data=$request->all();
        $status=$user->save();
        if($status){
            request()->session()->flash('success','Successfully updated your profile');
        }
        else{
            request()->session()->flash('error','Please try again!');
        }
        return redirect()->back();
    }

    // Order
    public function orderIndex(){
        $orders=Order::orderBy('id','DESC')->where('user_id',auth()->user()->id)->paginate(10);
        // dd($orders);
        return view('user.order.index')->with('orders',$orders);
    }
    public function userOrderDelete($id)
    {
        $order=Order::find($id);
        if($order){
           if($order->status=="process" || $order->status=='delivered' || $order->status=='cancel'){
                return redirect()->back()->with('error','You can not delete this order now');
           }
           else{
                $status=$order->delete();
                if($status){
                    request()->session()->flash('success','Order Successfully deleted');
                }
                else{
                    request()->session()->flash('error','Order can not deleted');
                }
                return redirect()->route('user.order.index');
           }
        }
        else{
            request()->session()->flash('error','Order can not found');
            return redirect()->back();
        }
    }

    public function orderShow($id)
    {
        $order=Order::find($id);
        // dd($order);
        // return $order;
        return view('user.order.show')->with('order',$order);
    }
    // Product Review
    public function productReviewIndex(){
        $reviews=ProductReview::getAllUserReview();
        return view('user.review.index')->with('reviews',$reviews);
    }

    public function productReviewEdit($id)
    {
        $review=ProductReview::find($id);
        // return $review;
        return view('user.review.edit')->with('review',$review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewUpdate(Request $request, $id)
    {
        $review=ProductReview::find($id);
        if($review){
            $data=$request->all();
            $status=$review->fill($data)->update();
            if($status){
                request()->session()->flash('success','Review Successfully updated');
            }
            else{
                request()->session()->flash('error','Something went wrong! Please try again!!');
            }
        }
        else{
            request()->session()->flash('error','Review not found!!');
        }

        return redirect()->route('user.productreview.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productReviewDelete($id)
    {
        $review=ProductReview::find($id);
        $status=$review->delete();
        if($status){
            request()->session()->flash('success','Successfully deleted review');
        }
        else{
            request()->session()->flash('error','Something went wrong! Try again');
        }
        return redirect()->route('user.productreview.index');
    }

    public function userComment()
    {
        $comments=PostComment::getAllUserComments();
        return view('user.comment.index')->with('comments',$comments);
    }
    public function userCommentDelete($id){
        $comment=PostComment::find($id);
        if($comment){
            $status=$comment->delete();
            if($status){
                request()->session()->flash('success','Post Comment successfully deleted');
            }
            else{
                request()->session()->flash('error','Error occurred please try again');
            }
            return back();
        }
        else{
            request()->session()->flash('error','Post Comment not found');
            return redirect()->back();
        }
    }
    public function userCommentEdit($id)
    {
        $comments=PostComment::find($id);
        if($comments){
            return view('user.comment.edit')->with('comment',$comments);
        }
        else{
            request()->session()->flash('error','Comment not found');
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function userCommentUpdate(Request $request, $id)
    {
        $comment=PostComment::find($id);
        if($comment){
            $data=$request->all();
            // return $data;
            $status=$comment->fill($data)->update();
            if($status){
                request()->session()->flash('success','Comment successfully updated');
            }
            else{
                request()->session()->flash('error','Something went wrong! Please try again!!');
            }
            return redirect()->route('user.post-comment.index');
        }
        else{
            request()->session()->flash('error','Comment not found');
            return redirect()->back();
        }

    }

    public function changePassword(){
        return view('user.layouts.userPasswordChange');
    }
    public function changPasswordStore(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->route('user')->with('success','Password successfully changed');
    }


}
