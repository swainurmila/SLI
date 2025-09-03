<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\e_office\OfficePurpose;
use Illuminate\Support\Facades\Auth;

class PurposeController extends Controller
{
    public function PurposeMaster(){
 
        $purpose = OfficePurpose::where('is_delete', 0)->get();
       return view("Eoffice.purposemaster",compact('purpose'));
    }
    public function PurposeAdd(Request $request){
    //return $request;

    $dept = new OfficePurpose();
    $dept->name = $request->name;
    $dept->created_by = Auth::guard('officer')->user()->id;
    $dept->status = $request->status;
    $dept->save();
    return redirect()->route('purpose-master')
    ->with('success', 'Purpose Added Successfully');
    }
    public function PurposeUpdate(Request $request, $id){
    //return $request;
    $dept = OfficePurpose::where('id', $id)->update([
        'name' => $request->name,
        'status'=>$request->status,

    ]);
    return redirect()->route('purpose-master')
    ->with('success', 'Purpose Updated Successfully');
    }
    public function PurposeDelete($id){
    //return $id;
    $dept= OfficePurpose::where('id', $id)->update([
        'is_delete' => 1,
    ]);
    return redirect()->route('purpose-master')
    ->with('success', 'Purpose deleted Successfully');
    }
}
