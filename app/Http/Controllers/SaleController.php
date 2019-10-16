<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sale;
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
}
