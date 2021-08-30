<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bid;
use App\Models\Contract;
use App\Models\Payout;
use App\Models\Project;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function projects(){
        $projects = Project::paginate(10);
        return view('backend.projects.index')->with('projects',$projects);
    }

    public function bids($id=null){
        if($id == null){
            $bids = Bid::paginate(10);
        }else{
            $bids = Bid::where('project_id',$id)->paginate(10);
        }
        return view('backend.bids.index')->with('bids',$bids);
    }

    public function contracts($id=null){
        if($id == null){
            $contracts = Contract::paginate(10);
        }else{
            $contracts = Contract::where('project_id',$id)->paginate(10);
        }
        return view('backend.contract.index')->with('contracts',$contracts);
    }

    public function payemntRequest()
    {
        $payouts = Payout::whereNotNull('withdrawn')->paginate(10);
        // dd($payouts->first()->user);
        return view('backend.payment.index')->with('payouts',$payouts);
    }

    public function paymentTrans()
    {
        $payouts = Payout::all();

        return view('backend.payment.transaction')->with('payouts',$payouts);
    }

    public function accPaymentRequest(Request $request)
    {
        $payouts = Payout::find($request->payout_id)->update([
            'withdrawn' => null,
            'paid' => $request->amount,
            'trans_id'  => $request->trans_id,
            'bank'    => 'easypaisa',
            'status'    => '1'
        ]);

        return redirect()->back();
    }


}
