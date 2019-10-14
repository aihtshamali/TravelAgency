<?php

namespace App\Http\Controllers;

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
}
