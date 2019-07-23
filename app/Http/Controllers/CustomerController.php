<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerType;
use App\Customer;
use Auth;
use App\Lead;
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
        // dd($request->all());
        if(!$request->all()){
            $customers = collect(DB::select($stmt));
        }else{
            // $stmt = $request->phone ? $stmt . $request->phone .  
            $customers = collect(DB::select($stmt.($request->phone ?? "NULL").' , '.($request->name ?? "NULL").','.($request->account ?? "NULL").''));
        }
        // dd('exec SearchCustomer "'.($request->/phone ?? "NULL").'" , "'.(strtoupper($request->name) ?? "NULL").'",'.($request->account ?? "NULL").'');

        return view('Customer.index',compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customer_types=CustomerType::where('status',1)->get();
        return view('Customer.add',['customer_types'=>$customer_types]);
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
            'PhoneNumber' => 'required|unique:CRM_Customers',
            'EmailAddress' => 'required|unique:CRM_Customers|email'
        ]);
       
        if(CustomerType::find($request->customer_type)->name == "Individual"){
            $asd=DB::select('exec CRM_CreateCustomer "'.$request->name.'", "'.$request->customer_type.'","'.$request->PhoneNumber.'","'.$request->EmailAddress.'","'.$request->remarks.'","'.$request->gender.'","'.Auth::user()->name.'", 1000');
        }
        else
        {
            $asd=DB::select('exec CRM_CreateCustomer "'.$request->name.'", "'.$request->customer_type.'","'.$request->phone_no.'","'.$request->customer_email.'","'.$request->remarks.'","NULL","'.Auth::user()->name.'", 1000');
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
        return view('Customer.show',['customer'=>Customer::find($id)]);
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
}
