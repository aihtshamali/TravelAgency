<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Package;
use App\Sector;
class PackageController extends Controller
{
   public function index()
   {
   
    $sectors=Sector::all();
    return view('User.Packages.index',['sectors'=>$sectors]);
   
   }
   
   public function create(Request $request)
   {
    
    // dd($request->all());
     $newpackage= new Package(); 
     if(isset($request->p_title))
     $newpackage->title=$request->p_title;
      if(isset($request->p_descp))
     $newpackage->description=$request->p_descp;
      if(isset($request->s_date))
     $newpackage->start_date=$request->s_date;
      if(isset($request->e_date))
     $newpackage->end_date=$request->e_date;
      if(isset($request->source_id))
     $newpackage->source_id=$request->source_id;
      if(isset($request->destination_id))
     $newpackage->destination_id=$request->destination_id;
     $newpackage->status=true;
          if(!is_dir('storage/package_attachments'))
            {
                mkdir('storage/package_attachments');
            }
            
            if($request->hasFile('p_img'))
            {  
            // dd('1');
                  $store= $request->file('p_img')->store('package_attachments', 'public');
            $newpackage->attachment=  $request->file('p_img')->hashName();
            }
             $newpackage->save();
              return redirect()->back()->with('success','Package Saved!!!');
           
  
   }
   public function view()
   {
     $allpackages = Package::all();
      $sectors=Sector::all();
     return view('User.Packages.view',['sectors'=>$sectors,'allpackages'=>$allpackages]);
   
   }
   
  
   
   public function deletePackage($id)
   {
        $packages = Package::find($id);
       $packages->delete();
       return redirect()->back()->with('error','Package Deleted!!!');
   }
   
}
