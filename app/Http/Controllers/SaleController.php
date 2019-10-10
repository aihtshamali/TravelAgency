<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
class SaleController extends Controller
{
    //
    public function viewSaleByID($id)
    {
        return redirect()->route('approveSale', array('id' => $id));
    }
    
}
