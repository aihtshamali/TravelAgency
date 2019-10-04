<?php

namespace App\Http\Controllers;

use App\Lead;
use App\LeadText;
use App\LeadType;
use Illuminate\Http\Request;
use DB;
use Redirect;
use App\Customer;
use App\Branch;
use Auth;
use App\Sector;
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
        $branches = Branch::where('status',1)->get();
        $sectors = Sector::where('status',1)->get();
        $customer = Customer::find($request->account);
        return view('Leads.create',['customer'=>$customer,'lead_types'=>$lead_types,'sectors'=>$sectors,'branches'=>$branches]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lead_id = Lead::latest()->first(); 
        $lead = new Lead();
        $lead->LeadID = $lead_id->id+1;
        $lead->CustomerIDRef = $request->customer_id;
        $lead->lead_type_id = $request->lead_type;
        $lead->source_id = $request->source_id;
        $lead->destination_id = $request->destination_id;
        $lead->LeadSubject = $request->subject;
        $lead->ServiceDate = $request->service_date;
        $lead->branch_id = $request->branch_id;
        $lead->taken_over_by = Auth::id();
        $lead->LeadStatus = 'Open';
        $lead->LeadTypeOLD = 'Open';
        $lead->save();

        $leadText = new LeadText();
        $leadText->LeadRefID = $lead->id;
        $leadText->NotePad = $requst->details;
        $leadText->Comments ='<comments/>'; //'<comments><comment>'.$lead->id.'</comment></comments>';
        $leadText->save();
        dd($leadText);
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
       
        $request->validate([
            'PhoneNumber' => 'numeric|regex:/^03\d{2}\d{7}$/|required',
        ]);
        $customer =  collect(DB::select('exec CRM_NewLead "'.$request->PhoneNumber.'"'));
        if(count($customer)) {
            return redirect()->route('Customer.show',$customer->first()->CustomerID);
        }else{
            return redirect()->action('CustomerController@create',$request->all());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function searchByID(Request $request)
    {

        if(isset($request->LeadId))
        {
            $request->validate([
                'LeadId'=>'exists:CRM_Leads'
            ]);
             return redirect()->route('leads.show',$request->LeadId);
        }   
        else
            return view('Leads.searchByID');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Lead  $lead
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $lead = Lead::findOrFail($id);
       return view('Leads.show',['lead'=>$lead]);
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
