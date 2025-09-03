<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\OfficeSection;
use Illuminate\Validation\Rule;

class SectionController extends Controller
{
    public function sectionMaster(){

        $sect = OfficeSection::where('is_delete', 0)->get();
         return view("Eoffice.sectionmaster",compact('sect'));
    }
    public function SectionAdd(Request $request){
        //return $request;

         $sect = new OfficeSection();
         $sect->name = $request->name;
         $sect->created_by = Auth::guard('officer')->user()->id;
        $sect->status =$request->status;
        $sect->save();
        return redirect()->route('section-master')
        ->with('success', 'Section Added Successfully');
    }

    public function sectionUpdate(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255', // Ensure name is required and not empty
            'status' => 'required|in:0,1', // Assuming status can be either 0 or 1
        ]);
        $sect = OfficeSection::where('id', $id)->update([
            'name' => $request->name,
            'status'=>$request->status,

        ]);
        return redirect()->route('section-master')
        ->with('success', 'Section Updated Successfully');
    }

    public function sectionDelete ($id){
        //return $id;
        $sect= OfficeSection::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('section-master')
        ->with('success', 'Section deleted Successfully');
    }

}
