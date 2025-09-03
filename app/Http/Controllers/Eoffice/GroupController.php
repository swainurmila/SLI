<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\OfficeGroup;

class GroupController extends Controller
{
    public function groupMaster(){

         $group = OfficeGroup::where('is_delete', 0)->get();
         return view("Eoffice.groupmaster",compact('group'));
    }

    public function GroupAdd(Request $request){
        //return $request;

        $group= new OfficeGroup();
        $group->name = $request->name;
        $group->created_by = Auth::guard('officer')->user()->id;
        $group->status =$request->status;
        $group->save();
        return redirect()->route('officegroup-master')
        ->with('success', 'Group Added Successfully');
    }

    public function GroupUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255', // Ensure name is required and not empty
            'status' => 'required|in:0,1', // Assuming status can be either 0 or 1
        ]);
        $group = OfficeGroup::where('id', $id)->update([
            'name' => $request->name,
            'status'=>$request->status,

        ]);
        return redirect()->route('officegroup-master')
        ->with('success', 'Group Updated Successfully');
    }

    public function GroupDelete ($id){
        //return $id;
        $group = OfficeGroup::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('officegroup-master')
        ->with('success', 'Group deleted Successfully');
    }

}
