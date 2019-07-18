<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerType;
use App\Customer;
use Auth;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $customer = new Customer();
        $customer->CustomerName = $request->name;
        $customer->PhoneNumber = $request->phone_no;
        $customer->gender = $request->gender;
        $customer->customer_type_id = $request->customer_type;
        
        if(CustomerType::find($request->customer_type)->name == "Individual"){
            $customer->gender = $request->gender;
        }
        
        $customer->Remarks = $request->remarks;
        $customer->CreatedBy = Auth::user()->name;
        $customer->EmailAddress = $request->customer_email;
        $customer->save();

        return redirect()->back();
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
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
        //
    }
}
