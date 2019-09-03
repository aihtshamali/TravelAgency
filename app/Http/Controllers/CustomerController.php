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
        
        return redirect()->back();
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
        // dd($customer);
        return view('Customer.show',['customer'=>$customer]);
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
        $customer->PhoneNumber = $request->phone_no;
        $customer->customer_type_id = $request->customer_type;
                
        if(CustomerType::find($request->customer_type)->name == "Individual"){
            $customer->gender = $request->gender;
        }
                
        $customer->Remarks = $request->remarks;
        $customer->CreatedBy = Auth::user()->name;
        $customer->EmailAddress = $request->customer_email;
        $customer->save();
        return redirect()->back();
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
        // dd   ($request->all());
        // dd($request->session()->get('userbranch')->id);
        $sale=new Sale();
        $sale->CustomerIDRef = $request->customer_id;
        $sale->LeadIDRef = $request->LeadId;
        $sale->posted_by_user= $request->CreatedBy;
        $sale->Amount = $request->amount;
        $sale->NetCost = $request->cost;
        $sale->ProfitAmount = $request->profit;
        $sale->lead_type_id = $request->lead_type_id;
        $sale->IssueDate=$request->IssueDate;
        $sale->ProductNum = $request->ProductNum;
        $sale->ProductPax = $request->ProductPax;
        $sale->sector_id = $request->sector_id;
        $sale->AccountingText = $request->AccountigText;
        $sale->user_branch_id=$request->session()->get('userbranch')->id;
        $sale->save();
        return redirect()->back();
        // dd($request->all());
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
        // dd   ($request->all());
        // dd($request->session()->get('userbranch')->id);
        $lastSale=Sale::all()->last();
        // dd($lastSale->SaleID);
        $sale=new Sale();
        $sale->SaleID=$lastSale->SaleID+1;
        $sale->CustomerIDRef = $request->customer_id;
        // $sale->LeadIDRef = $request->LeadId;
        $sale->posted_by_user= $request->CreatedBy;
        $sale->Amount = "-".$request->amount;
        $sale->BranchRef="";
        $sale->PostedBy="";
        $sale->ProductType = "";
        $sale->NetCost=0;
        $sale->SaleBy="";
        $sale->ProfitAmount = $request->profit;
        $sale->lead_type_id = $request->lead_type_id;
        $sale->IssueDate=$request->IssueDate;
        $sale->ProductNum = $request->ProductNum;
        $sale->ProductPax = $request->ProductPax;
        $sale->sector_id = $request->sector_id;
        $sale->AccountingText = $request->AccountigText;
        $sale->user_branch_id=$request->session()->get('userbranch')->id;
        $sale->save();
        return redirect()->back();
        // dd($request->all());
    }
    public function addPayment($id)
    {
        // $id = Auth::id();
        // dd($id);
        $customer=Customer::where('CustomerID',$id)+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
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
        dd($request->all());
        $lastPayment=Payment::all()->last();
        $payment=new Payment();
        $payment->CustomerIDRef=$request->customer_id;
        $payment->LeadIDRef=$request->LeadId;
        $payment->user_id=$request->CreatedBy;
        $payment->Amount=$request->amount;
        $payment->payment_form_id=$request->payment_form;
        if(isset($request->payment_detail))
        {
            $payment->FOPText=$request->payment_detail;
        }
        $payment->RecFrom=$request->receivedFrom;
        $payment->PrintRemark=$request->printRemarks;
        $payment->AccountingText=$request->confidentialRemarks;
        $payment->save();
    }
}
