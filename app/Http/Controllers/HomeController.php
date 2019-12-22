<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use App\Customer;
use App\User;
use App\Sale;
use App\Payment;
use App\PaymentForm;
use App\UserBranch;
use App\LeadType;
use Illuminate\Support\Facades\Hash;
use DB;
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
    private function replaceCustomerType(){
        $customers = Customer::all();
        foreach ($customers as $customer) {
            if($customer->CustomerType == "M"){
                $customer->gender = "male";
                $customer->customer_type_id = 1;
            }
            else if($customer->CustomerType == "F"){
                $customer->gender = "female";
                $customer->customer_type_id = 1;
            }
            else if($customer->CustomerType == "C"){
                // $customer->gender = "female";
                $customer->customer_type_id = 2;
            }
            $customer->save();
        }
        dump("Customer Type Updated!");
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
    // Copy all Users
    private function copyAllUsers(){
        $oldUsers= \App\Login_UserOLD::all();
        foreach ($oldUsers as $Olduser) {
            $user = new \App\User();
            $user->name =  $Olduser->FullName;
            $user->user_name =  $Olduser->UserID;
            $user->login_count =  $Olduser->LoginCount;
            $user->email =  $Olduser->Email;
            $user->created_at =  $Olduser->AccountCreated;
            $user->status = $Olduser->IsActive;
            // dd($Olduser->IsActive);
            $user->password =  Hash::make("123456");
            $user->save();
            
        }
        dump('User Updated');
    }

    // Update CreatedBy,TakenBy,ClosedBy in CRM_Leads
    private function UpdatedallUsersInLeads(){
        $leads = \App\Lead::all();
        foreach ($leads as $lead) {
            $createdBy = \App\User::where('user_name',$lead->CreatedBy)->first();
            $takenOverBy = \App\User::where('user_name',$lead->TakenOverByUser)->first();
            $ClosedBy = \App\User::where('user_name',$lead->ClosedBy)->first();
            $LastUpdatedBy = \App\User::where('user_name',$lead->LastUpdateBy)->first();

            $branch = \App\Branch::where('name',$lead->BranchRestrict)->first();

            if($createdBy)
                $lead->user_id = $createdBy->id;
            if($takenOverBy)
                $lead->taken_over_by = $takenOverBy->id;
            if($ClosedBy)
                $lead->closed_by = $ClosedBy->id;
            if($LastUpdatedBy)
                $lead->last_updated_by = $LastUpdatedBy->id;

            if($branch)
                $lead->branch_id = $branch->id;
            
                
            $lead->save();
        }
        dump('UpdatedallUsersInLeads');
    }    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $this->CopyUserToUserBranch();
        // $this->copyAllUsers();
        // $this->replaceLeadType();
        // $this->replaceCustomerType();
        // $this->UpdatedallUsersInLeads();
        // $this->AddCustomersToUsers();
        // $this->copyProductTypeToSale();
        // $this->CopySaleByPostedByActionByInSale();
        $this->CopySaleByPostedByAuthByInPayment();
        $model = new Customer();
        $data =  $model->hydrate(DB::select('exec CRM_PendingPayments '));
        // return $data;
        return view('home',['payments'=>$data]);
        // return view('home');
    }
    public function paymentForm()
    {
        $payments = Payment::all();
        foreach($payments as $payment){
            if($payment->FOP == "CASH"){
                $lead->lead_type_id = 1; 
            }
            else if($payment->FOP == "CHEQUE"){
                $lead->lead_type_id = 2; 
            }
            else if($payment->FOP == "CREDIT CARD"){
                $lead->lead_type_id = 3; 
            }
            else if($payment->FOP == "BANK TRANSFER"){
                $lead->lead_type_id = 4; 
            }
            else if($payment->FOP == "OTHER"){
                $lead->lead_type_id = 5; 
            }
            
            $payment->save();
        }
        dump('Form of payment done');
    
    }
    private function UpdatedallUsersInPayments(){
        $payments = \App\Payment::all();
        foreach ($payments as $payment) {
            $saleBy = \App\User::where('user_name',$payment->saleBy)->first();
            $postedBy = \App\User::where('user_name',$lead->TakenOverByUser)->first();
            // $ClosedBy = \App\User::where('user_name',$lead->ClosedBy)->first();
            // $LastUpdatedBy = \App\User::where('user_name',$lead->LastUpdateBy)->first();

            $branch = \App\Branch::where('name',$lead->BranchRestrict)->first();

            if($saleBy)
                $payment->user_id = $saleBy->id;
            if($postedBy)
                $payment->postedBy = $postedBy->id;
            // if($ClosedBy)
            //     $lead->closed_by = $ClosedBy->id;
            // if($LastUpdatedBy)
            //     $lead->last_updated_by = $LastUpdatedBy->id;

            if($branch)
                $lead->branch_id = $branch->id;
            
                
            $payment->save();
        }
        dump('UpdatedallUsersInPayments');
    }

    private function AddCustomersToUsers(){
        $customers = \App\Customer::all();
         set_time_limit(3000);
        foreach($customers as $customer){
            if(!User::where('user_name',$customer->PhoneNumber)->count()){
                $user = new User();
                $user->name = $customer->CustomerName;
                $user->user_name = $customer->PhoneNumber;
                $user->email = $customer->EmailAddress;
                $user->password = Hash::make($customer->PhoneNumber);
                $user->save();
                $customer->user_id = $user->id;
                $customer->save(); 
            }
        }
        dump('AddCustomersToUsers');
    }

    private function copyProductTypeToSale(){
        
        $sales = Sale::all();
        foreach($sales as $sale){
            $search=LeadType::where("name","like","%".ucfirst($sale->ProductType)."%")->first();
            if(!$search)
                dd($sale->ProductType);

            $sale->lead_type_id = $search->id;
            $sale->save();
        }
        dump("PRoduct Type Copied");
    }

    //ByDefault HDQ
    private function CopyUserToUserBranch(){
        $users = User::all();
        foreach($users as $user){
            if(!UserBranch::where('user_id',$user->id)->first())
            {
                $userbranch = new UserBranch();
                $userbranch->user_id = $user->id;
                $userbranch->branch_id = 1;
                $userbranch->save(); 
            }
        }
        dump("User Copied in UserBranches");
    }

    //postedByUSer is SaleBy and SaleBy is in USerBranchID 
    private function CopySaleByPostedByActionByInSale(){
        $sales = Sale::all();
        foreach($sales as $sale){
            $actionBy = User::where("user_name",$sale->ActionBy)->first();
            $saleBy = User::where("user_name",$sale->SaleBy)->first();
            $postedBy = UserBranch::where('user_id',User::where("user_name",$sale->PostedBy)->first()->id)->first();
            
            if($actionBy)
                $sale->action_by = $actionBy->id; 
            if($saleBy)
                $sale->posted_by_user = $saleBy->id; 
            $sale->user_branch_id = $postedBy->id;
            $sale->save(); 
        }
        dump("Copy SaleBy PostedBy ActionBy In Sale Done");
    }

    private function CopySaleByPostedByAuthByInPayment(){
        $payments = Payment::all();
        foreach($payments as $payment){
            $saleBy = User::where("user_name",$payment->SaleBy)->first();
            $PostedBy = UserBranch::where('user_id',User::where("user_name",$payment->PostedBy)->first()->id)->first();
            $authBy = User::where("user_name",$payment->AuthBy)->first();
            $payment_form = PaymentForm::where('name',$payment->FOP)->first();
            $payment->payment_form_id = $payment_form->id;
            $payment->auth_by = $authBy->id;
            $payment->user_id = $saleBy->id;
            $payment->user_branch_id = $PostedBy->id;
            $payment->save();
        }
        dump("CopySaleByPostedByAuthByInPayment Done");
    }
}
