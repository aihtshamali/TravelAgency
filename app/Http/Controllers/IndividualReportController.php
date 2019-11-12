<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\User;
use App\Payment;
use App\Lead;
use App\UserBranch;
use Auth;
use DB;
use Session;
class IndividualReportController extends Controller
{
    public function transactions(){
        $pendingSales = Sale::where('posted_by_user',Session()->get('userbranch')->user_id)->where('SaleStatus','Pending')->orderBy('PostedOn','DESC')->get();
        $saleAndRefunds = Sale::where('posted_by_user',Session()->get('userbranch')->user_id)
        ->orderBy('PostedOn','DESC')
        ->limit(10)->get();
        
        $payments = Payment::select('CRM_Payments.*')->leftJoin('user_branches','CRM_Payments.user_branch_id','user_branches.id')
        ->where('user_branches.user_id',Session()->get('userbranch')->user_id)
        ->orderBy('PostedOn','DESC')->limit(10)
        ->get();
        return view('individualReports.transactions',compact('pendingSales','saleAndRefunds','payments'));
        
//                return redirect()->route('approveSale', array('id' => $sale->SaleID));

    }
    public function FinalizedLeads(){
        $leads = Lead::where('user_id',Session()->get('userbranch')->user_id)
        ->orderBy('CreatedOn','DESC')->limit(20)
        ->get();
        return view('individualReports.finalized_leads',compact('leads'));
    }

    public function saleReport($user = null){
        if($user == null)
        {
            $transactionTypes = ["Sale","Refunds","Payments"];
            // dd("yes");
            return view('individualReports.saleReport',compact('transactionTypes'));
        }
        else
        {
            $transactionTypes = ["Sale","Refunds","Payments"];
            $users=User::where('status',1)
            ->get();
            // dd("yes");
            return view('individualReports.saleReport',compact('transactionTypes','users'));
        }
    }
    public function saleReportSearch(Request $request){
        $model = new Sale();
        $data =  $model->hydrate(DB::select('exec CRM_UserSaleReport '.Session()->get('userbranch')->user_id.',"'.$request->fromDate.'","'.$request->toDate.'","'.$request->transaction_type.'","'.$request->status.'"'));
        return view('individualReports.saleReportView');
    }

}
