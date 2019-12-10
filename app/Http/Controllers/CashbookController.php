<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\UserDetail;
use App\User;
use App\CashbookIndex;
use App\CashbookData;
use DB;
use Auth;
use Illuminate\Http\Request;

class CashbookController extends Controller
{
    public function index()
    {
     $index=CashbookIndex::where('DayStatus','=',true)->get();
    //  dd($index);
      return view('Cashbook.index',compact('index'));
    }
     public function summary(Request $request)
    {
    //  dd($request);
      $date=$request->date;
      $branch=$request->branch;
      $index=CashbookIndex::where('Day','=',$date)->first();
      $AmountIn=CashbookData::where('PageRef','=',$index->PageNumber)
      ->where('AutoPost','=','1')
      ->get();
      $AmountOut=CashbookData::where('PageRef','=',$index->PageNumber)
      ->where('AutoPost','=','0')
      ->get();
      // dd($AmountOut);
      return view('Cashbook.summary',compact('date','branch','AmountIn','AmountOut','index'));
    }
    public function search()
    {
      return view('Cashbook.search');
    }
}
