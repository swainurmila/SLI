<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\e_office\OfficeDepartment;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function DepartmentMaster(){
 
        $dept = OfficeDepartment::where('is_delete', 0)->get();
        return view("Eoffice.departmentmaster" ,compact('dept'));
   }
   public function DepartmentAdd(Request $request){
       //return $request;

       $dept = new OfficeDepartment();
       $dept->name = $request->name;
       $dept->created_by = Auth::guard('officer')->user()->id;
       $dept->status = $request->status;
       $dept->save();
       return redirect()->route('dept-master')
       ->with('success', 'Department Added Successfully');
   }
   public function DepartmentUpdate(Request $request, $id){
       //return $request;
       $dept = OfficeDepartment::where('id', $id)->update([
           'name' => $request->name,
           'status'=>$request->status,

       ]);
       return redirect()->route('dept-master')
       ->with('success', 'Department Updated Successfully');
   }
   public function DepartmentDelete($id){
       //return $id;
       $dept= OfficeDepartment::where('id', $id)->update([
           'is_delete' => 1,
       ]);
       return redirect()->route('dept-master')
       ->with('success', 'Department deleted Successfully');
   }
}
