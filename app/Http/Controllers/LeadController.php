<?php

namespace App\Http\Controllers;

use App\Lead;
use App\LeadText;
use App\LeadType;
use Illuminate\Http\Request;
use DB;
use Redirect;
use DateTime;

use App\Customer;
use App\Branch;

use Carbon\Carbon;
use App\Sector;
use Auth;
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
 
    public function takeOver(Request $request){
        
       DB::update('exec CRM_LeadUpdate '.$request->LeadID.',"'.$request->action.'",'.Auth::id());
       return redirect()->route('myLeads');
    }
 
    public function changeServiceDate(Request $request){
        // dd($request->all());
        $lead = Lead::find($request->lead_id);
        $lead->ServiceDate = date('Y-m-d',strtotime($request->date));
        $lead->update();
        return redirect()->back();
    }
    public function saveNotePad(Request $request){
        $lead = LeadText::find($request->lead_id);
        $lead->NotePad = $request->notepad;
        $lead->update();
        return redirect()->back()->with('success','NotePad added successfully!');
    }
    
    public function saveComment(Request $request){
        $lead = LeadText::find($request->lead_id);
        if($lead->Comments == "<comments/>")
            $lead->Comments=str_replace("<comments/>","",$lead->Comments);
        $lead->Comments = $lead->Comments.''.date('Y-m-d H:i:s')." #$$ ".Auth::user()->name." #$$ ".$request->comment." $%$ ";
        $lead->update();
        return redirect()->back()->with('success','Comment has been added successfully!');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $updated = DB::update('exec CRM_AddLead "'.$request->customer_id.'",'.Auth::id().','.$request->lead_type.','.$request->source_id.','.$request->destination_id.',"'.$request->subject.'","'.date('Y-m-d',strtotime($request->service_date)).'","'.$request->details.'",'.$request->create_for_others.','.$request->branch_id);
        // dd($updated);
        if(!$updated)
            return redirect()->back()->with('error','Something went Wrong!');
        
        $lead = Lead::latest()->first();
        return redirect()->route('leads.show',$lead->LeadID);
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
       $leads = Lead::findOrFail($id);
        $lead = LeadText::find($id);
        //its a very bad practice but i have to follow the previous table structure
        $comments = collect();
        if($lead)
        foreach(explode("$%$",$lead->Comments) as $st1)
        {   $comment = array();
            if($st1 && $st1!=" "){
                foreach(explode("#$$",$st1) as $st2)
                {
                    array_push($comment,$st2);
                }
                $comments->push($comment);
            }
        }
        // dd($comments);

       return view('Leads.show',['lead'=>$leads,'comments'=>$comments]);
    }
    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function myLeads()
    {
       $leads = Lead::where('user_id',Auth::id())->where('LeadStatus','Working')->get();
       return view('Leads.myLead',['leads'=>$leads]);
    }
    public function AvailableLeads()
    {
       $leads = Lead::where('user_id',Auth::id())->where('LeadStatus','Open')->get();
       return view('Leads.available',['leads'=>$leads]);
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
