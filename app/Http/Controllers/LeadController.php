<?php

namespace App\Http\Controllers;

use App\Lead;
use App\LeadType;
use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Customer;
class LeadController extends Controller
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
    public function create(Request $request)
    {
        $lead_types  = LeadType::where('status','1')->get();

        $customer = Customer::find($request->account);
        return view('Leads.create',['customer'=>$customer,'lead_types'=>$lead_types]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * phoneSearch search phoneNumber in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function phoneSearch()
    {
       return view('Leads.search');
    }
    /**
     * phoneSearch search phoneNumber in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function customerLead(Request $request)
    {
       
        $customer =  collect(DB::select('exec CRM_NewLead '.$request->PhoneNumber));
        if(count($customer)) {
            return redirect()->route('Customer.show',$customer->first()->CustomerID);
        }
        return Redirect::back()->withErrors(['Wrong Number' => 'Enter a valid Number']);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    //    return view('Leads.search');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $lead)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
