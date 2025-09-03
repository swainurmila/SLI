<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\OfficeMainCatagory;
use DB;
class MainCatagoryController extends Controller
{
    public function MainMaster(){

         $maincatagory = OfficeMainCatagory::where('is_delete', 0)->get();
        return view("Eoffice.maincatagorymaster", compact('maincatagory'));
   }

   public function CatagoryAdd(Request $request){
    //return $request;

    $maincatagory= new  OfficeMainCatagory();
    $maincatagory->name = $request->name;
    $maincatagory->created_by = Auth::guard('officer')->user()->id;
    $maincatagory->status =$request->status;
    $maincatagory->save();
    return redirect()->route('officemain-catagory-master')
    ->with('success', 'Category Added Successfully');
}
public function CatagoryUpdate(Request $request, $id){
    $request->validate([
        'name' => 'required|string|max:255',
        'status' => 'required|in:0,1',
    ]);
    $maincatagory =OfficeMainCatagory::where('id', $id)->update([
        'name' => $request->name,
        'status'=>$request->status,

    ]);
    return redirect()->route('officemain-catagory-master')
    ->with('success', 'category Updated Successfully');
}

public function CatagoryDelete ($id){
    //return $id;
    $maincatagory = OfficeMainCatagory::where('id', $id)->update([
        'is_delete' => 1,
    ]);
    return redirect()->route('officemain-catagory-master')
    ->with('success', 'Catagory deleted Successfully');
}


}
