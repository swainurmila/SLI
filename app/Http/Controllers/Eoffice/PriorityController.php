<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\e_office\OfficePriority;
use Illuminate\Support\Facades\Auth;

class PriorityController extends Controller
{
    public function  PriorityMaster()
    {
        $priority = OfficePriority::where('is_delete', 0)->get();
        return view("Eoffice.prioritymaster", compact('priority'));
    }

    public function PriorityAdd(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:0,1',

        ]);
        $priority = new OfficePriority();
        $priority ->name = $request->name;
        $priority->created_by = Auth::guard('officer')->user()->id;
        $priority->status =$request->status;
        $priority->save();
        return redirect()->route('priority-master')
        ->with('success', 'Priority Added Successfully');
    }
    public function PriorityUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',

        ]);
        //  return $request;
        $priority =OfficePriority::where('id', $id)->update([
            'name' => $request->name,
            'status'=>$request->status,

        ]);
        return redirect()->route('priority-master')
        ->with('success', 'Updated Successfully');
    }

    public function PriorityDelete($id)
    {
        $priority = OfficePriority::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('priority-master')
        ->with('success', 'Deleted Successfully');
 
    }

}
