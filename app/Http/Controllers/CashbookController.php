<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use App\UserDetail;
use App\User;
use App\CashbookIndex;
use App\CashbookData;
use App\Bank;
use App\PaymentForm;
use App\Payment;
use DB;
use Auth;
use Illuminate\Http\Request;

class CashbookController extends Controller
{

      private function replaceFOPTopayment_form_id(){
        $cashdata = CashBookData::all();
         for($i=0; $i<$cashdata->count();$i++)
        {
            $search=PaymentForm::where("name","like","%".ucfirst($cashdata[$i]->FOP)."%")->first();
            if(!$search)
                dd($cashdata[$i]->FOP);
           
           $cashdata[$i]->payment_form_id = $search->id;
            $cashdata[$i]->update();
        }
        dump('PAYMENTS DONE IN CASHBOOK DATA');
    }
    
    public function index()
    {
      //  $this->replaceFOPTopayment_form_id();
       $index=CashbookIndex::where('DayStatus','=',true)->get();
      return view('Cashbook.index',compact('index'));
    }
    public function summary(Request $request)
    {
    //  dd($request);
      $date=$request->date;
      $branch=$request->branch;
      $index=CashbookIndex::where('Day','=',$date)->first();
      $pageRef=$index->PageNumber;
      $AmountIn=CashbookData::where('PageRef','=',$index->PageNumber)
      ->where('AutoPost','=','1')
      ->orderBy('RecordTime', 'DESC')
      ->get();
      // dd($AmountIn[0]->payment_form_id ==$AmountIn[0]->PaymentForm->id);
      $AmountOut=CashbookData::where('PageRef','=',$index->PageNumber)
      ->where('AutoPost','=','0')
       ->orderBy('RecordTime', 'DESC')
      ->get();
      $payment_forms=PaymentForm::where('Status',TRUE)->get();
      // dd($payment_forms);
      $banks=Bank::where('Status',TRUE)->get();
      $pending_payments=Payment::where('StatusCode','Pending')->get();
      // dd($pending_payments[0]->SaleByUser->user_name);
      // dd($AmountOut);
      return view('Cashbook.summary',compact('pending_payments','banks','payment_forms','pageRef','date','branch','AmountIn','AmountOut','index'));
    }
    public function search()
    {
      return view('Cashbook.search');
    }
    
    public function bank(Request $request)
    {
      $banks=Bank::all();
       
      
         return view('Cashbook.addbank',compact('banks'));
    }
    public function addbank(Request $request)
    { 
       $i=0;
         foreach($request->bank_name as $bank)
       {
          $newBank= new Bank();
          $newBank->bank_name=$bank;
          $newBank->branch_name=$request->branch_name[$i];
          $newBank->description=$request->details[$i];  
          $newBank->status=true;
          $newBank->save();
          $i++;
       }
       $banks=Bank::all(); 
         return redirect()->back()->with('success','Bank Added!!');
    }
    
    public function delete_bank($id)
    {
       $banks=Bank::find($id);
       $banks->delete();
       return redirect()->back()->with('error','Bank Deelted!!');
    }
    
    public function bankreport()
    {
      $reports=null;
      $type=null;
      $payment_forms=PaymentForm::where('Status',TRUE)->where('name','!=','CASH')->get();
    
      $banks=Bank::where('Status',TRUE)->get();
      return view("Cashbook.bankreport",compact('banks','reports','type','payment_forms'));
    }
    public function bankBasedreport(Request $request)
    {
      $payment_forms=PaymentForm::where('Status',TRUE)->where('name','!=','CASH')->get();
      $banks=Bank::where('Status',TRUE)->get();
       if($request->fromDate == null && $request->ToDate == null && $request->cheque ==null && $request->creditcard==null && $request->paymentType == null)
        {
          $reports=null;
          $type=null;
          return view("Cashbook.bankreport",compact('banks','reports','type','payment_forms'));
        }
    if($request->fromDate != null && $request->ToDate != null)
     { 
     
     if($request->paymentType == 4)
     {
      $reports=CashbookData::where('bank_id',$request->bank)
      ->where('payment_form_id',$request->paymentType)
       ->where('RecordTime','>=',$request->fromDate)
       ->where('RecordTime','<=',$request->ToDate)
      ->get();
      $paymenttype=Bank::find($request->bank);
      $type=$paymenttype->bank_name;
      }
      elseif($request->paymentType == 2)
      {
        $reports=CashbookData::where('chequeOrcard',$request->cheque)
        ->where('payment_form_id',$request->paymentType)
          ->where('RecordTime','>=',$request->fromDate)
       ->where('RecordTime','<=',$request->ToDate)
        ->get();
        $paymenttype=PaymentForm::find($request->paymentType);
        $type=$paymenttype->name;
      }
       elseif($request->paymentType == 3)
      {
        $reports=CashbookData::where('chequeOrcard',$request->creditcard)
        ->where('payment_form_id',$request->paymentType)
          ->where('RecordTime','>=',$request->fromDate)
       ->where('RecordTime','<=',$request->ToDate)
        ->get();
        $paymenttype=PaymentForm::find($request->paymentType);
        $type=$paymenttype->name;
       
      }
      else{
       $reports=CashbookData::where('RecordTime','>=',$request->fromDate)
       ->where('RecordTime','<=',$request->ToDate)
        ->get();
        $type="Date Range";
      }
      
        $dates=" Start Date:".$request->fromDate." | End Date".$request->ToDate;
        return view("Cashbook.bankreport",compact('dates','reports','banks','type','payment_forms'));
    }
    else{
     if($request->paymentType == 4)
     {
      $reports=CashbookData::where('bank_id',$request->bank)
      ->where('payment_form_id',$request->paymentType)
      ->get();
      $paymenttype=Bank::find($request->bank);
      $type=$paymenttype->bank_name;
      }
      elseif($request->paymentType == 2)
      {
        $reports=CashbookData::where('chequeOrcard',$request->cheque)
        ->where('payment_form_id',$request->paymentType)
        ->get();
        $paymenttype=PaymentForm::find($request->paymentType);
        $type=$paymenttype->name;
      }
       elseif($request->paymentType == 3)
      {
        $reports=CashbookData::where('chequeOrcard',$request->creditcard)
        ->where('payment_form_id',$request->paymentType)
        ->get();
        $paymenttype=PaymentForm::find($request->paymentType);
        $type=$paymenttype->name;
       
      }
        $dates=null;
         return view("Cashbook.bankreport",compact('dates','reports','banks','type','payment_forms'));
    }
       
    }
    public function cashIn(Request $request)
    {
 
             $FOP=PaymentForm::find($request->payment);
               $bankID=1;
             $str ='EXEC CashBook_Add '.$request->in_amount.','.$request->out_amount.','.$request->autopost.',"'.$request->in_detail.'","'.$FOP->name.'",'.$request->PageRef.',"'.$request->UserRef.'",'.$request->UserRefId.','.$bankID.','.$FOP->id.',NULL';
            $cashIn =DB::update($str);
        
        return redirect()->back()->with('success','Cash In Successfully!!');
    }
    
    public function cashOut(Request $request)
    {
    
    // dd($request->all());
      
      $FOP=PaymentForm::find($request->payment);
      if(isset($request->creditcard) && $request->creditcard!=null)
         {
            $creditcard_cheque=$request->creditcard;
             $bankID=1;
             $str ='EXEC CashBookOut '.$request->in_amount.','.$request->out_amount.','.$request->autopost.',"'.$request->out_detail.'","'.$FOP->name.'",'.$request->PageRef.',"'.$request->UserRef.'",'.$request->UserRefId.','.$bankID.','.$request->payment.',"'.$creditcard_cheque.'"';
          }
          elseif(isset($request->cheque) && $request->cheque!=null)
          {
            $creditcard_cheque=$request->cheque;
            $bankID=1;
             $str ='EXEC CashBookOut '.$request->in_amount.','.$request->out_amount.','.$request->autopost.',"'.$request->out_detail.'","'.$FOP->name.'",'.$request->PageRef.',"'.$request->UserRef.'",'.$request->UserRefId.','.$bankID.','.$request->payment.',"'.$creditcard_cheque.'"';
            
          }
          elseif($request->bank !=null)
          {
            $bankID=$request->bank;
             $str ='EXEC CashBookOut '.$request->in_amount.','.$request->out_amount.','.$request->autopost.',"'.$request->out_detail.'","'.$FOP->name.'",'.$request->PageRef.',"'.$request->UserRef.'",'.$request->UserRefId.','.$bankID.','.$request->payment.',NULL';
            
          }
          else{
             $bankID=1;
             $str ='EXEC CashBookOut '.$request->in_amount.','.$request->out_amount.','.$request->autopost.',"'.$request->out_detail.'","'.$FOP->name.'",'.$request->PageRef.',"'.$request->UserRef.'",'.$request->UserRefId.','.$bankID.','.$request->payment.',NULL';
          
          }
          $cashOut =DB::update($str);
          
       return redirect()->back()->with('success','Cash Out Successfully!!');
    }
    
    public function close_cashbook(Request $request)
    {
      //  dd($request->all());
       $closebook =DB::update('EXEC CashBook_Close '.$request->PageRef.',"'.$request->UserRef.'","'.$request->UserRefId.'"');
       return redirect()->back()->with('success','Cashbook Closed Successfully!!');
    }
  
}
