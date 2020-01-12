<?php

namespace App\Http\Controllers;

use App\Lead;
use App\LeadText;
use App\LeadType;
use App\Priority;
use Illuminate\Http\Request;
use DB;
use Redirect;
use DateTime;

use App\Customer;
use App\Branch;

use Carbon\Carbon;
use App\Sector;
use App\User;
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
        $priority= Priority::where('status','1')->get();
        // dd($priority);
        return view('Leads.create',['priority'=>$priority,'customer'=>$customer,'lead_types'=>$lead_types,'sectors'=>$sectors,'branches'=>$branches]);
    }

    public function transferLead(Request $request){
        $lead = Lead::find($request->lead_id);
        $lead->taken_over_by = $request->user_id;
        $lead->TakenOverOn = date('Y-m-d H:i:s');
        $lead->update();
        return redirect()->back()->with('success','Transferred Successfully!');
    }
 
    public function takeOver(Request $request){
        
       DB::update('exec CRM_LeadUpdate '.$request->LeadID.',"'.$request->action.'",'.Session()->get('userbranch')->user_id);
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
        $leadText = LeadText::find($request->lead_id);
        $leadText->NotePad = $request->notepad;
        $leadText->update();
        
        $lead = Lead::find($request->lead_id);
        $lead->LastUpdatedOn= date('Y-m-d H:i:s');
        $lead->update();
        return redirect()->back()->with('success','NotePad added successfully!');
    }
    
    public function saveComment(Request $request)
    {
        // dd($request);
        $leadText = LeadText::find($request->lead_id);
        if($leadText->Comments == "<comments/>")
           $leadText->Comments=str_replace("<comments/>","",$leadText->Comments);
        $leadText->Comments = $leadText->Comments.''.date('Y-m-d H:i:s')." #$$ ".Auth::user()->name." #$$ ".$request->comment." $%$ ";
        $leadText->update();
        
        $lead = Lead::find($request->lead_id);
        $lead->LastUpdatedOn= date('Y-m-d H:i:s');
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
       $updated = DB::update('exec CRM_AddLead "'.$request->customer_id.'",'.Session()->get('userbranch')->user_id.','.$request->lead_type.','.$request->lead_priority.','.$request->source_id.','.$request->destination_id.',"'.$request->subject.'","'.date('Y-m-d',strtotime($request->service_date)).'","'.$request->details.'",'.$request->create_for_others.','.$request->branch_id);
        // dd($updated);
        if(!$updated)
            return redirect()->back()->with('error','Something went Wrong!');
        
        $lead = Lead::latest()->first();
        return redirect()->route('leads.show',$lead->LeadID);
    }
    
    public function userLeadsbyId($id)
    {
        // dd($id);
        $user_leads=Lead::where('user_id',$id)->get();
        // dd($user_leads[0]);
       return view('Leads.userLeadsbyId',['user_leads'=>$user_leads]);
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
       // dd($id);
       $leads = Lead::findOrFail($id);
        $lead = LeadText::find($id);
        //its a very bad practice but i have to follow the previous table structure
        $comments = collect();
        $users = User::where('status',1)->get();
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

       return view('Leads.show',['lead'=>$leads,'comments'=>$comments,'users'=>$users]);
    }
    /**
     * Display the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function myLeads()
    {
       $leads = Lead::where('user_id',Session()->get('userbranch')->user_id)->where('LeadStatus','Working')->get();
       return view('Leads.myLead',['leads'=>$leads]);
    }
    public function AvailableLeads()
    {
       $leads = Lead::where('user_id',Session()->get('userbranch')->user_id)->where('LeadStatus','Open')->get();
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
        $lead = Lead::find($id);
        $lead_types  = LeadType::where('status','1')->get();
        $branches = Branch::where('status',1)->get();
        $sectors = Sector::where('status',1)->get();
        $priority= Priority::where('status','1')->get();
        
        return view('Leads.edit',compact('priority','lead','lead_types','branches','sectors'));
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
        $lead = Lead::find($lead);
        $lead->LeadSubject = $request->subject;
        $lead->lead_type_id = $request->lead_type;
          $lead->priority_id = $request->lead_priority;
        $lead->source_id = $request->source_id;
        $lead->destination_id = $request->destination_id;
        $lead->LeadSubject = $request->subject;
        $lead->ServiceDate = $request->service_date;
        $lead->branch_id = $request->branch_id;
        $lead->LastUpdatedOn= date('Y-m-d H:i:s');
        $lead->update();

        return redirect()->route('leads.show',$lead->LeadID)->with('success','Updated Successfully!');

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
    public function allLeads()
    {
        $userLeads = Lead::select(DB::raw('CRM_Leads.user_id,count(LeadID) as lead_count, Login_Users.name, branches.name as branch'))
                    ->leftJoin('Login_Users','Login_Users.id','CRM_Leads.user_id')
                    ->leftJoin('user_branches','Login_Users.id','user_branches.user_id')
                    ->leftJoin('branches','user_branches.branch_id','branches.id')
                    ->where('LeadStatus', '=', 'Working')
                    ->groupBy('CRM_Leads.user_id','Login_Users.name','branches.name')
                    ->get();
        $leads = Lead::orderBy('LeadID', 'desc')->take(20)->get();
                    // dd($userLeads);
        // $branches=Branch::where('status',1)
        //     ->get();
            // dd($branches);
        return view('Leads.allLeads',compact('userLeads','leads'));
    }
    public function leadReport(){
       
        
            $transactionTypes = ["Sale","Refunds","Payments"];
            $users=User::where('status',1)
            ->get();
            $branches=Branch::where('status',1)
            ->get();
            // dd($branches);
            return view('Leads.leadReport',compact('users','branches'));
        
    }
    
    public function leadStatusreport()
    {
         $users=User::all();
        $leadStatus=Lead::all();
      
        return view('Leads.statusReport',['leadStatus'=>$leadStatus,'users'=>$users]);
    }
    public function leadStatusReportsearch( Request $request)
    {
    //    dd($request->all());
        $dateFrom=date('Y-m-d h:i:s',strtotime($request->dateFrom));
        $dateTo=date('Y-m-d h:i:s',strtotime($request->dateTo));
        $createdby=$request->CreatedBy;
        $status=$request->leadStatus;
        
        $new_dateFrom=null;
        $new_dateTo=null;
        $users=User::all();
        $leadStatus=Lead::all();
        $Userdatanew=array();
        $Userdata = collect ( DB::select('exec CRM_LeadStatusReport "'.$createdby.'","'.$dateFrom.'","'.$dateTo.'","'.$status.'"'));
         
         return view('Leads.statusReportDouble',['status'=>$status,'createdby'=>$createdby,'Userdatanew'=> $Userdatanew,'Userdata'=> $Userdata,
         'leadStatus'=>$leadStatus,
         'users'=>$users,
         'dateFrom'=>$dateFrom,'dateTo'=>$dateTo,
         'new_dateFrom'=>$new_dateFrom,'new_dateTo'=>$new_dateTo]);
    }
    
    public function statusReportDouble(Request $request)
    {
        $new_dateFrom=date('Y-m-d h:i:s',strtotime($request->new_dateFrom));
        $new_dateTo=date('Y-m-d h:i:s',strtotime($request->new_dateTo));
        $new_user=$request->newCreatedBy;
        $new_status=$request->newleadStatus;
        
        $dateFrom=$request->previous_dateFrom;
        $dateTo=$request->previous_dateTo;
        $createdby=$request->previous_user;
        $status=$request->previous_status;
        
        $users=User::all();
        $leadStatus=Lead::all();
        $Userdatanew= collect ( DB::select('exec CRM_LeadStatusReport "'.$new_user.'","'.$new_dateFrom.'","'.$new_dateTo.'","'.$new_status.'"'));
        $Userdata = collect ( DB::select('exec CRM_LeadStatusReport "'.$createdby.'","'.$dateFrom.'","'.$dateTo.'","'.$status.'"'));
        // dd($Userdatanew);
         return view('Leads.statusReportDouble',['new_status'=>$new_status,'status'=>$status,'createdby'=>$createdby,'Userdatanew'=> $Userdatanew,'Userdata'=> $Userdata,
         'leadStatus'=>$leadStatus,
         'users'=>$users,
         'dateFrom'=>$dateFrom,'dateTo'=>$dateTo,'new_dateFrom'=>$new_dateFrom,'new_dateTo'=>$new_dateTo]);
    }
    public function leadReportSearch(Request $request){
        
        $model = new Lead();
        if(isset($request->user))
        {
            if($request->branch == 1)
            {
                // dd("Branches");
                $createdLeads = $model->hydrate(DB::select('EXEC CRM_BranchLeadReport '.$request->user.',"'.$request->fromDate.'","'.$request->toDate.'",1'));
                $completedLeads = $model->hydrate(DB::select('EXEC CRM_BranchLeadReport '.$request->user.',"'.$request->fromDate.'","'.$request->toDate.'",2'));
                $closedLeads = $model->hydrate(DB::select('EXEC CRM_BranchLeadReport '.$request->user.',"'.$request->fromDate.'","'.$request->toDate.'",3'));
                // dd($createdLeads);
            }
            else
            {
                // dd("User");
                $createdLeads=Lead::where('user_id',$request->user)
                                    ->where('CreatedOn','>=',$request->fromDate)
                                    ->where('CreatedOn','<=',$request->toDate)
                                    ->get();
                $completedLeads=Lead::where('user_id',$request->user)
                                    ->where('CreatedOn','>=',$request->fromDate)
                                    ->where('CreatedOn','<=',$request->toDate)
                                    ->where('LeadStatus','=','Completed')
                                    ->get();
                $closedLeads=Lead::where('user_id',$request->user)
                                    ->where('CreatedOn','>=',$request->fromDate)
                                    ->where('CreatedOn','<=',$request->toDate)
                                    ->where('LeadStatus','=','Closed')
                                    ->get();
                
                                    // dd($createdLeads);
                // $data =  $model->hydrate(DB::select('exec CRM_UserSaleReport '.$request->user.',"'.$request->fromDate.'","'.$request->toDate.'","'.$request->transaction_type.'","'.$request->status.'"'));
            }

        }
        
        return view('Leads.leadReportView',['created'=>$createdLeads,'completed'=>$completedLeads,'closed'=>$closedLeads]);
    }
}
