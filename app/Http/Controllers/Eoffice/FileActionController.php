<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\OfficeFileAction;


class FileActionController extends Controller
{
    public function FileActionMaster ()
    {
        $fileaction = OfficeFileAction::where('is_delete', 0)->get();
        return view("Eoffice.fileactionmaster",compact('fileaction'));
    }

    public function FileActionAdd(Request $request){
        //return $request;
        $request->validate([
            'name' => 'required',
            'status' => 'required|in:0,1',

        ]);
        $fileaction= new OfficeFileAction();
        $fileaction->name = $request->name;
        $fileaction->created_by = Auth::guard('officer')->user()->id;
        $fileaction->status =$request->status;
        $fileaction->save();
        return redirect()->route('fileaction-master')
        ->with('success', 'File Action Added Successfully');
    }

    public function FileActionUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',

        ]);
        //  return $request;
        $fileaction =OfficeFileAction::where('id', $id)->update([
            'name' => $request->name,
            'status'=>$request->status,

        ]);
        return redirect()->route('fileaction-master')
        ->with('success', 'File Action Updated Successfully');
    }

    public function FileActionDelete($id)
    {
        $priority = OfficeFileAction::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('fileaction-master')
        ->with('success', 'Deleted Successfully');

    }
}
