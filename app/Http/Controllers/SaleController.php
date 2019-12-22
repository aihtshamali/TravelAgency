<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
use App\CustomerType;
use App\Customer;
use App\LeadType;
use App\Lead;
use App\User;
use App\Sector;
class SaleController extends Controller
{
    //
    public function viewSaleByID($id = null)
    {
        if($id == null)
        {
            // echo "hey";
            return view('Sale.viewSaleByID');
        }
        else
        {
            return redirect()->route('approveSale', array('id' => $id));
        }
        
    }
    
    public function viewDocumentByID($id = null)
    {
        if($id == null)
        {
            // echo "hey";
            $sale=null;
            return view('Sale.viewDocumentByID');
        }
        else
        {
            // echo $id;
            // exit;
            $sales = Sale::selectRaw('SaleID,Login_users.name as Uname,CRM_Customers.CustomerID,SaleStatus
            ProductNum,CRM_Sale.created_at,IssueDate,posted_by_user,lead_types.name LeadType,ProductNum,PostedOn')
            ->leftJoin('CRM_Customers','CRM_Sale.CustomerIDRef','CRM_Customers.CustomerID')
            ->leftJoin('CRM_Leads','CRM_Sale.LeadIDRef','CRM_Leads.LeadID')
            ->leftJoin('user_branches','CRM_Sale.user_branch_id','user_branches.id')
            ->leftJoin('Login_Users','Login_Users.id','user_branches.user_id')
            ->leftJoin('branches','branches.id','user_branches.branch_id')
            ->leftJoin('lead_types','CRM_Sale.lead_type_id','lead_types.id')
            ->leftJoin('sectors','CRM_Sale.sector_id','sectors.id')
            ->where('ProductNum',$id)->get();
            // dd($sales[0]->PostedBy);
            return view('Sale.viewDocumentByID',['sales'=>$sales]);
        }
        
    }
    
    
    public function editSale($id)
    {
        $sale=Sale::where('SaleID',$id)->first();
        // dd($sale);
         $customer=Customer::where('CustomerID',$sale->CustomerIDRef)
                ->first();
        $leads=Lead::where('CustomerIDRef',$sale->CustomerIDRef)
                ->where('LeadStatus','!=','Closed')
                ->get();
        $users=User::all();
        $sectors=Sector::all();
        $lead_types  = LeadType::where('status','1')->get();
        return view('Sale.editSale',['sale'=>$sale,'lead_types'=>$lead_types,'customer'=>$customer,'leads'=>$leads,'users'=>$users,'sectors'=>$sectors]);
        
    }
    
    public function editRefund($id)
    {
    
      $refund=Sale::where('SaleID',$id)->where('ProductType','=','REFUND')->where('amount','<',0)->first();
       $customer=Customer::where('CustomerID',$refund->CustomerIDRef)
                ->first();
         
        $leads=Lead::where('CustomerIDRef',$refund->CustomerIDRef)
                ->where('LeadStatus','!=','Closed')
                ->get();
        $users=User::all();
        $sectors=Sector::all();
                // dd($leads);
        $lead_types  = LeadType::where('status','1')->get();
        return view('Sale.editRefund',['refund'=>$refund,'lead_types'=>$lead_types,'customer'=>$customer,'leads'=>$leads,'users'=>$users,'sectors'=>$sectors]);
        
    }
}
