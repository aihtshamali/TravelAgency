<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Copy the value(ID) of LeadType
    private function replaceLeadType(){
        $leads = Lead::all();
        foreach($leads as $lead){
            if($lead->LeadType == "Flight"){
                $lead->lead_type_id = 1; 
            }
            else if($lead->LeadType == "Hotel"){
                $lead->lead_type_id = 2; 
            }
            else if($lead->LeadType == "Visa"){
                $lead->lead_type_id = 3; 
            }
            else if($lead->LeadType == "Insurance"){
                $lead->lead_type_id = 4; 
            }
            else if($lead->LeadType == "Tour"){
                $lead->lead_type_id = 5; 
            }
            else if($lead->LeadType == "Umrah"){
                $lead->lead_type_id = 6; 
            }
            else if($lead->LeadType == "Hajj"){
                $lead->lead_type_id = 7; 
            }
            $lead->save();
        }
        dump('Leads Done');
    }
    // Copy and Replace BranchId
    private function replaceBranches(){
        $branches = Branch::all();
        foreach($branches as $branch){
            if($branch->BranchRestrict == "HDQ"){
                $branch->branch_id = 1; 
            }
            $branch->save();
        }
        dump('Leads Done');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 
        $this->replaceLeadType();
        return view('home');
    }
}
