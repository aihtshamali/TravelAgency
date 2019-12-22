<?php

namespace App\Http\Controllers;
use App\Customer;
use DB;
use Illuminate\Http\Request;
use App\Sale;
use App\Payment;
use App\PaymentForm;
use App\CustomerType;
use App\LeadType;
use App\Lead;
use App\User;
use App\Sector;
class PaymentController extends Controller
{
    //
    public function viewPaymentByID($id = null)
    {
        if($id == null)
        {
            // echo "hey";
            return view('Payment.viewPaymentByID');
        }
        else
        {
            return redirect()->route('approvePayment', array('id' => $id));
        }
        
    }
  
    
    public function viewPendingPayments()
    {
        $model = new Customer();
        $data =  $model->hydrate(DB::select('exec CRM_PendingPayments '));
        // return $data;
        return view('Payment.viewPendingPayments',['payments'=>$data]);
    }
    
    public function editPayment($id)
    {
        
        $payment=Payment::where('PaymentID',$id)->first();
        // dd($payment);
        $customer=Customer::where('CustomerID',$payment->CustomerIDRef)
                ->first();
            // $leads = Lead::all();
            // dd($data = Session::get('userbranch'));
        $leads=Lead::where('CustomerIDRef',$id)
                ->where('LeadStatus','!=','Closed')
                ->get();
        $paymentForms=PaymentForm::all();
        $users=User::all();
        $sectors=Sector::all();
                // dd($leads);
        $lead_types  = LeadType::where('status','1')->get();
        return view('Payment.editPayment',['payment'=>$payment,'lead_types'=>$lead_types,'customer'=>$customer,'leads'=>$leads,'users'=>$users,'sectors'=>$sectors,'paymentForms'=>$paymentForms]);
    
    }
}
