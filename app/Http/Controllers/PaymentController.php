<?php

namespace App\Http\Controllers;
use App\Customer;
use DB;
use Illuminate\Http\Request;

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
}
