<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\CustomerType;
use App\LeadType;
use App\Customer;
use App\Lead;
use App\Sector;
use App\Sale;
use App\PaymentForm;
use App\Payment;
use App\User;
use Session;
use Auth;
use DB;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $stmt = 'exec SearchCustomer ';
        $customers =array();
        if($request->all()){
            $name= "NULL";
            if($request->name){
                $name='"'.$request->name.'"';
            }
            $customers = collect(DB::select($stmt.($request->phone ?? "NULL").' , '.$name.','.($request->account ?? "NULL").''));
            // $customers = collect(DB::select($stmt));
        }
       
        return view('Customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $phoneNumber = "";
        if(isset($request->PhoneNumber)){
            $phoneNumber = $request->PhoneNumber;
        }
        $customer_types=CustomerType::where('status',1)->get();
        return view('Customer.add',['customer_types'=>$customer_types,'phoneNumber'=>$phoneNumber]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'PhoneNumber' => 'numeric|regex:/^03\d{2}\d{7}$/|required|unique:CRM_Customers',
        ]);
        // $request->validate([
        //     'PhoneNumber' => 'required|unique:CRM_Customers',
        //     // 'EmailAddress' => 'required|unique:CRM_Customers|email'
        // ]);
        if($request->EmailAddress){
            $customer = new User();
            $customer->name = $request->name;
            $customer->user_name = $request->PhoneNumber;
            $customer->email = $request->EmailAddress;
            $customer->password = Hash::make($request->PhoneNumber);
            $customer->save();
        }
        if(CustomerType::find($request->customer_type)->name == "Individual"){
            DB::select('exec CRM_CreateCustomer "'.$request->name.'", "'.$request->customer_type.'","'.$request->PhoneNumber.'","'.($request->EmailAddress ?? "NULL").'","'.($request->remarks ?? "NULL").'","'.$request->gender.'","'.Auth::user()->name.'","'.Session::get('userbranch')->branch_id.'", 1000');
        }
        else
        {
            DB::select('exec CRM_CreateCustomer "'.$request->name.'", "'.$request->customer_type.'","'.$request->phone_no.'","'.($request->customer_email ?? "NULL").'","'.$request->remarks.'","NULL","'.Auth::user()->name.'","'.Session::get('userbranch')->branch_id.'",1000');
        }
        
        return redirect()->back()>with('success','Customer added successfully!');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // $customers = Customer::get();
        // dd($customers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $customer = Customer::where('CustomerID',$id)->where('status',1)->first();
        $leads= Lead::where('CustomerIDRef',$id)->get();
        $sales = Sale::where('CustomerIDRef',$id)
                    ->where('amount','>',0)
                    ->get();
        $refunds = Sale::where('CustomerIDRef',$id)
                    ->where('amount','<',0)
                    ->get();
        $payments= Payment::where('CustomerIDRef',$id)->with('PaymentForm')->get();
       
        return view('Customer.show',['sales'=>$sales,'refunds'=>$refunds,'customer'=>$customer,'leads'=>$leads,'payments'=>$payments]);
    }
    
  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $customer=Customer::where('CustomerID',$id)
                ->first();
        $customer_types=CustomerType::where('status',1)->get();
        return view('Customer.add',['customer_types'=>$customer_types,'customer'=>$customer]);
        // dd($customer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $customer=Customer::where('CustomerID',$id)
                ->first();

        $customer->CustomerName = $request->name;
        $customer->PhoneNumber = $request->PhoneNumber;
        $customer->customer_type_id = $request->customer_type;
                
        if(CustomerType::find($request->customer_type)->name == "Individual"){
            $customer->gender = $request->gender;
        }
                
        $customer->Remarks = $request->remarks;
        $customer->CreatedBy = Auth::user()->name;
        $customer->EmailAddress = $request->customer_email;
        $customer->save();
        return redirect()->back()->with('success','Customer Added Successfully!');
        // dd($id);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer=Customer::where('CustomerID',$id)
                ->first();
                
                $customer->status = "FALSE";
                $customer->save();
                // dd($customer);        
        return $id;
        // dd("hey");
        //
    }
    public function addSale($id)
    {
        // $id = Auth::id();
        // dd($id);
        $customer=Customer::where('CustomerID',$id)
                ->first();
            // $leads = Lead::all();
            // dd($data = Session::get('userbranch'));
        $leads=Lead::where('CustomerIDRef',$id)
                ->where('LeadStatus','!=','Closed')
                ->get();
        $users=User::all();
        $sectors=Sector::all();
                // dd($leads);
        $lead_types  = LeadType::where('status','1')->get();
        return view('Customer.addsale',['lead_types'=>$lead_types,'customer'=>$customer,'leads'=>$leads,'users'=>$users,'sectors'=>$sectors]);
    }
    public function saveSale(Request $request)
    { 
    
        // dd($request->file('ticket_attachment'));
        if(Sale::find($request->saleId))
        {
            $update=Sale::find($request->saleId);
        $update->CustomerIDRef = $request->customer_id;
        $update->LeadIDRef = $request->LeadId;
            //IT is SaleBy
        $update->posted_by_user= $request->SaleBy;
        $update->Amount = $request->amount;
        $update->NetCost = $request->cost;
        $update->ProfitAmount = $request->profit;
        $update->lead_type_id = $request->lead_type_id;
        $update->IssueDate=$request->IssueDate;
        $update->ProductNum = $request->ProductNum;
        $update->ProductPax = $request->ProductPax;
        $update->source_id = $request->source_id;
        $update->destination_id = $request->destination_id;
        $update->ProductDetail = $request->ProductDetail;
        $update->AccountingText = $request->AccountigText;
        $update->user_branch_id=$request->session()->get('userbranch')->id;
        $update->SaleStatus='Approved';
            
            $customer = Customer::find($request->customer_id);
            $user_id = 0;
            
            if(isset($customer->User)){
                $user_id = $customer->User->id;
            }
         
            if($request->hasFile('ticket_attachment'))
            {
               if(!is_dir('storage/attachments')){
                     mkdir('storage/attachments');
                 }
                if(!is_dir('storage/attachments/'.$request->saleId)){
                    mkdir('storage/attachments/'.$request->saleId.'/');
                }
              foreach($request->file('ticket_attachment') as $fileIterator)
              {
                  $fileIterator->store('public/attachments/'.$request->saleId.'/');
                $update->ticket_attachment = $fileIterator->hashName();
                $update->document_name='Attachment-'.$request->saleId;
              }
            }
        $update->save();
            
            return redirect()->back()->with('success','Updated Successfully!!!');
            }
            else{    
            $sale=new Sale();
            $sale->CustomerIDRef = $request->customer_id;
            $sale->LeadIDRef = $request->LeadId;
            //IT is SaleBy
            $sale->posted_by_user= $request->CreatedBy;
            $sale->Amount = $request->amount;
            $sale->NetCost = $request->cost;
            $sale->ProfitAmount = $request->profit;
            $sale->lead_type_id = $request->lead_type_id;
            $sale->IssueDate=$request->IssueDate;
            $sale->ProductNum = $request->ProductNum;
            $sale->ProductPax = $request->ProductPax;
            // $sale->sector_id = $request->sector_id;
            $sale->source_id = $request->source_id;
            $sale->destination_id = $request->destination_id;
            $sale->ProductDetail = $request->ProductDetail;
            $sale->AccountingText = $request->AccountigText;
            $sale->user_branch_id=$request->session()->get('userbranch')->id;
            $sale->SaleStatus='Approved';
            
            $customer = Customer::find($request->customer_id);
            $user_id = 0;
            
            if(isset($customer->User)){
                $user_id = $customer->User->id;
            }
            if(!is_dir('storage/attachments')){
                mkdir('storage/attachments');
            }
            if(!is_dir('storage/attachments/'.$user_id)){
                mkdir('storage/attachments/'.$user_id);
            }
            if($request->hasFile('ticket_attachment')){
                $request->file('ticket_attachment')->store('public/attachments/'.$user_id.'/');
                $sale->ticket_attachment = $request->file('ticket_attachment')->hashName();
                //   $sale->document_name='Attachment-'.$request->saleId;
            }
            $sale->save();
            
            return redirect()->route('approveSale', array('id' => $sale->SaleID));
            // $sale->created_at=date('Y-m-d H:i:s');
            // $sale->updated_at=date('Y-m-d H:i:s');
            // return view('Customer.addsale',['lead_types'=>$lead_types,'customer'=>$customer,'leads'=>$leads,'users'=>$users,'sectors'=>$sectors]);
            // echo "hey";
            // dd($request->session()->get('userbranch')->user_id);
            // dd($sale->SaleID);
            // $sales = Sale::selectRaw('SaleID,branches.name as Branch,Login_users.name as Uname,CRM_Customers.CustomerName,
            // CRM_Sale.CustomerIDRef,LeadIDRef,CRM_Sale.created_at,Amount,NetCost,ProfitAmount,
            // AccountingText,lead_types.name as Type,IssueDate,ProductPax,ProductNum,sectors.name as Sector')
            // ->leftJoin('CRM_Customers','CRM_Sale.CustomerIDRef','CRM_Customers.CustomerID')
            // ->leftJoin('CRM_Leads','CRM_Sale.LeadIDRef','CRM_Leads.LeadID')
            // ->leftJoin('user_branches','CRM_Sale.user_branch_id','user_branches.id')
            // ->leftJoin('Login_Users','Login_Users.id','user_branches.user_id')
            // ->leftJoin('branches','branches.id','user_branches.branch_id')
            // ->leftJoin('lead_types','CRM_Sale.lead_type_id','lead_types.id')
            // ->leftJoin('sectors','CRM_Sale.sector_id','sectors.id')
            // ->where('SaleID',$sale->SaleID)->first();

            //         // dd($sales);
            // return view('Customer.approvesale',['sale'=>$sales]);
            // approveSale($sale->id);
            // dd($request->all());
            }
            
    }
    public function approveSale($id)
    {
        $sales = Sale::selectRaw('CRM_Sale.ticket_attachment,SaleID,branches.name as Branch,action_by,Login_users.name as Uname,CRM_Customers.CustomerName,
        CRM_Sale.CustomerIDRef,LeadIDRef,CRM_Sale.created_at,Amount,NetCost,ProfitAmount,ActionOn,SaleStatus,
        AccountingText,lead_types.name as Type,IssueDate,ProductPax,ProductNum,sectors.name as Sector')
        ->leftJoin('CRM_Customers','CRM_Sale.CustomerIDRef','CRM_Customers.CustomerID')
        ->leftJoin('CRM_Leads','CRM_Sale.LeadIDRef','CRM_Leads.LeadID')
        ->leftJoin('user_branches','CRM_Sale.user_branch_id','user_branches.id')
        ->leftJoin('Login_Users','Login_Users.id','user_branches.user_id')
        ->leftJoin('branches','branches.id','user_branches.branch_id')
        ->leftJoin('lead_types','CRM_Sale.lead_type_id','lead_types.id')
        ->leftJoin('sectors','CRM_Sale.sector_id','sectors.id')
        ->where('SaleID',$id)->first();
                // dd($sales);
        if($sales == null)
        {
            return redirect()->back()->with('error', 'No Sale found against this ID');
        }
        else
        {
            return view('Customer.approvesale',['sale'=>$sales]);
        }
    }
    public function changeSaleStatus($id,$status)
    {
        $sale=Sale::where('SaleID',$id)
                ->first();
        if($status == 0)
        {
            $sale->SaleStatus='Rejected';
        }
        if($status == 1)
        {
            $sale->SaleStatus='Approved';
        }
        $sale->action_by=Session()->get('userbranch')->user_id;
        // dd(date('M j Y g:iA'));
        $sale->ActionOn=date('M j Y g:iA');
        $sale->save();
        return redirect('/Customer');
        // dd(Session()->get('userbranch')->user_id);
    }
    
    
    public function addRefund($id)
    {
        // $id = Auth::id();
        // dd($id);
        $customer=Customer::where('CustomerID',$id)
                ->first();
            // $leads = Lead::all();
            // dd($data = Session::get('userbranch'));
        $leads=Lead::where('CustomerIDRef',$id)
                ->where('LeadStatus','!=','Closed')
                ->get();
        $users=User::all();
        $sectors=Sector::all();
                // dd($leads);
        $lead_types  = LeadType::where('status','1')->get();
        return view('Customer.addrefund',['lead_types'=>$lead_types,'customer'=>$customer,'leads'=>$leads,'users'=>$users,'sectors'=>$sectors]);
    }
    public function saveRefund(Request $request)
    {
      if(Sale::find($request->saleId))
      {
        $update=Sale::find($request->saleId);
        $update->CustomerIDRef = $request->customer_id;
        $update->posted_by_user= $request->CreatedBy;
        $update->Amount = $request->amount;
       
        // $update->PostedBy="";
        // $update->ProductType = "";
        $update->NetCost=0;
        // $update->SaleBy="";
        $update->ProfitAmount = $request->profit;
        $update->lead_type_id = $request->lead_type_id;
        $update->IssueDate=$request->IssueDate;
        $update->ProductNum = $request->ProductNum;
        $update->ProductPax = $request->ProductPax;
    
        $update->source_id = $request->source_id;
        $update->destination_id = $request->destination_id;
        $update->ProductDetail = $request->ProductDetail;
        $update->AccountingText = $request->AccountigText;
        $update->user_branch_id=$request->session()->get('userbranch')->id;
        $update->SaleStatus='Approved';
        $update->save();
        // dd($update);
         return redirect()->back()->with('success','Updated Successfully!!!');
      }
      else{
        $sale=new Sale();
        $sale->CustomerIDRef = $request->customer_id;
        $sale->posted_by_user= $request->CreatedBy;
        $sale->Amount = "-".$request->amount;
       
        $sale->PostedBy="";
        $sale->ProductType = "";
        $sale->NetCost=0;
        $sale->SaleBy="";
        $sale->ProfitAmount = $request->profit;
        $sale->lead_type_id = $request->lead_type_id;
        $sale->IssueDate=$request->IssueDate;
        $sale->ProductNum = $request->ProductNum;
        $sale->ProductPax = $request->ProductPax;
    
        $sale->source_id = $request->source_id;
        $sale->destination_id = $request->destination_id;
        $sale->ProductDetail = $request->ProductDetail;
        $sale->AccountingText = $request->AccountigText;
        $sale->user_branch_id=$request->session()->get('userbranch')->id;
        $sale->SaleStatus='Approved';
        $sale->save();
         return redirect()->route('approveSale', array('id' => $sale->SaleID));
      }
        
       
      
    }
    
    public function addPayment($id)
    {
        // $id = Auth::id();
        // dd($id);
        $customer=Customer::where('CustomerID',$id)
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
        return view('Customer.addpayment',['lead_types'=>$lead_types,'customer'=>$customer,'leads'=>$leads,'users'=>$users,'sectors'=>$sectors,'paymentForms'=>$paymentForms]);
    }
    public function savePayment(Request $request)
    {
     
     if(Payment::find($request->paymemtid))
     {
        $updatepaymet=Payment::find($request->paymemtid);
        $updatepaymet->CustomerIDRef=$request->customer_id;
        if(isset($request->LeadId) && $request->LeadId !="")
        {
            $updatepaymet->LeadIDRef=$request->LeadId;
        }
        $updatepaymet->user_id=$request->CreatedBy;
        $updatepaymet->Amount=$request->amount;
        $updatepaymet->payment_form_id=$request->payment_form;
        $updatepaymet->SaleBy=$request->CreatedBy;
        $updatepaymet->BranchRef="";
        $updatepaymet->FOP="";
        $updatepaymet->PostedBy=$request->session()->get('userbranch')->id;
        $updatepaymet->user_branch_id=$request->session()->get('userbranch')->id;
        if(isset($request->payment_detail))
        {
            $updatepaymet->FOPText=$request->payment_detail;
        }
        $updatepaymet->RecFrom=$request->receivedFrom;
        $updatepaymet->PrintRemark=$request->printRemarks;
        if(isset($request->confidentialRemarks))
        {
            $updatepaymet->AccountingText=$request->confidentialRemarks;
        }
        $updatepaymet->StatusCode='Approved';
        $updatepaymet->FOP='';
        $updatepaymet->PostedOn=date('Y-m-d H:i:s');
        $updatepaymet->save();
          return redirect()->back()->with('success','Updated Successfully!!!');
     }
     else
      {  $lastPayment=Payment::all()->last();
        $payment=new Payment();
        $payment->CustomerIDRef=$request->customer_id;
        if(isset($request->LeadId) && $request->LeadId !="")
        {
            $payment->LeadIDRef=$request->LeadId;
        }
        $payment->user_id=$request->CreatedBy;
        $payment->Amount=$request->amount;
        $payment->payment_form_id=$request->payment_form;
        $payment->SaleBy=$request->CreatedBy;
        $payment->BranchRef="";
        $payment->FOP="";
        $payment->PostedBy=$request->session()->get('userbranch')->id;
        $payment->user_branch_id=$request->session()->get('userbranch')->id;
        if(isset($request->payment_detail))
        {
            $payment->FOPText=$request->payment_detail;
        }
        $payment->RecFrom=$request->receivedFrom;
        $payment->PrintRemark=$request->printRemarks;
        if(isset($request->confidentialRemarks))
        {
            $payment->AccountingText=$request->confidentialRemarks;
        }
        $payment->StatusCode='Approved';
        $payment->FOP='';
        $payment->PostedOn=date('Y-m-d H:i:s');
        $payment->save();
        return redirect()->route('approvePayment', array('id' => $payment->PaymentID));
    }
}

    public function userperformance()
    {
        return view('Reports.UserPerformance');
    }
    
    public function userPerformanceReportIndividual(Request $request)
    {
        $dateFrom=$request->dateFrom;
        $dateTo=$request->dateTo;
         $new_dateFrom=null;
        $new_dateTo=null;
         return view('Reports.userPerformanceReport',['dateFrom'=>$dateFrom,'dateTo'=>$dateTo,'new_dateFrom'=>$new_dateFrom,'new_dateTo'=>$new_dateTo]);
    }
    
    public function userPerformanceReportDouble(Request $request)
    {
        $dateFrom=$request->previous_dateFrom;
        $dateTo=$request->previous_dateTo;
        $new_dateFrom=$request->dateFrom;
        $new_dateTo=$request->dateTo;
      return view('Reports.userPerformanceReport',['dateFrom'=>$dateFrom,'dateTo'=>$dateTo,
                                                   'new_dateFrom'=>$new_dateFrom,'new_dateTo'=>$new_dateTo]);
    }
    public function approvePayment($id)
    {
        $payments = Payment::selectRaw('PaymentID,branches.name as Branch,Login_users.name as Uname,CRM_Customers.CustomerName,
        CRM_Payments.CustomerIDRef,LeadIDRef,CRM_Payments.PostedOn,Amount,FOPText,AccountingText,
        payment_forms.name as FOP,PrintRemark,RecFrom,StatusCode,AuthOn,auth_by')
        ->leftJoin('CRM_Customers','CRM_Payments.CustomerIDRef','CRM_Customers.CustomerID')
        ->leftJoin('CRM_Leads','CRM_Payments.LeadIDRef','CRM_Leads.LeadID')
        ->leftJoin('user_branches','CRM_Payments.user_branch_id','user_branches.id')
        ->leftJoin('Login_Users','Login_Users.id','user_branches.user_id')
        ->leftJoin('branches','branches.id','user_branches.branch_id')
        ->leftJoin('payment_forms','CRM_Payments.payment_form_id','payment_forms.id')
        ->where('PaymentID',$id)->first();
        if($payments == null)
        {
            return redirect()->back()->with('error', 'No Receipt found against this ID');
        }
        else
        {
            return view('Customer.approvepayment',['payment'=>$payments]);
        }
        
    }
    public function changePaymentStatus($id,$status)
    {
        $payment=Payment::where('PaymentID',$id)
                ->first();
        if($status == 0)
        {
            $payment->StatusCode='Rejected';
        }
        if($status == 1)
        {
            $payment->StatusCode='Approved';
        }
        $payment->auth_by=Session()->get('userbranch')->user_id;
        // dd(date('M j Y g:iA'));
        $payment->AuthOn=date('Y-m-d H:i:s');
        $payment->save();
        return redirect('/Customer');
        // dd(Session()->get('userbranch')->user_id);
    }
}
