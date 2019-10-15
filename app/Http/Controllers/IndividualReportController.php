<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\Payment;
use App\UserBranch;
use Auth;
class IndividualReportController extends Controller
{
    public function transactions(){
        $pendingSales = Sale::where('posted_by_user',Auth::id())->where('SaleStatus','Pending')->orderBy('PostedOn','DESC')->get();
        $saleAndRefunds = Sale::where('posted_by_user',Auth::id())
        ->orderBy('PostedOn','DESC')
        ->limit(10)->get();
        
        $payments = Payment::select('CRM_Payments.*')->leftJoin('user_branches','CRM_Payments.user_branch_id','user_branches.id')
        ->where('user_branches.user_id',Auth::id())
        ->orderBy('PostedOn','DESC')->limit(10)
        ->get();
        return view('individualReports.transactions',compact('pendingSales','saleAndRefunds','payments'));
        
//                return redirect()->route('approveSale', array('id' => $sale->SaleID));

    }
}
