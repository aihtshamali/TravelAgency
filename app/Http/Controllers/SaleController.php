<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
class SaleController extends Controller
{
    //
    public function viewSaleByID($id = null)
    {
        if($id == null)
        {
            // echo "hey";
            return view('Sale.viewSaleByID');
        }
        else
        {
            return redirect()->route('approveSale', array('id' => $id));
        }
        
    }
    
}