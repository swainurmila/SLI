<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\OfficeSubCatagory;
use App\Models\e_office\OfficeMainCatagory;
use Illuminate\Validation\Rule;
use DB;

class SubCatagoryController extends Controller
{
    public function SubCatagoryMaster(){
         $catagory= OfficeMainCatagory::all();
         $subcatagory = OfficeSubCatagory::with('mainCategory')->where('is_delete', 0)->get();

         return view("Eoffice.subcatagorymaster",compact('catagory','subcatagory'));
    }
    public function SubCatagoryAdd(Request $request){

// return $request;
        $subcatagory = new OfficeSubCatagory();
        $subcatagory->name = $request->name;
        $subcatagory->main_catagory_id = $request->main_catagory_id;
        $subcatagory->created_by = Auth::guard('officer')->user()->id;
        $subcatagory->status =$request->status ;
        $subcatagory->save();
        return redirect()->route('officesub-catagory-master')
        ->with('success', 'sub category Added Successfully');
    }
    public function SubCatagoryUpdate(Request $request, $id){
        // return $request;
        $request->validate([
            'name' => 'required|string|max:255', // Ensure name is required and not empty
            'status' => 'required|in:0,1', // Assuming status can be either 0 or 1
            // 'main_catagory_id' => 'required',

        ]);
         //return $request;
        $subcatagory = OfficeSubCatagory::where('id', $id)->update([
            'name' => $request->name,
            'status'=>$request->status,
            'main_catagory_id' =>$request->main_catagory_id,
        ]);
        return redirect()->route('officesub-catagory-master')
        ->with('success', 'Sub Category Updated Successfully');
    }
    public function SubCatagoryDelete ($id){
        //return $id;
        $subcatagory= OfficeSubCatagory::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('officesub-catagory-master')
        ->with('success', 'deleted Successfully');
    }

}
