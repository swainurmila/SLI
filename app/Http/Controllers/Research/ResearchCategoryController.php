<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Research\RpSubjectCategory;

class ResearchCategoryController extends Controller
{
    public function CatagySubject(){

        $cat = RpSubjectCategory::where('is_delete', 0)->orderBy('id','desc')->get();
         return view("research.admin.categorySubject.index",compact('cat'));
    }

    public function categorysubjectAdd(Request $request){
        // return $request;
        $request->validate([
            'category_name' => 'required|unique:rp_subject_categories,category_name',
            'status' => 'required'
        ]);
        $cat = new RpSubjectCategory();
        $cat->category_name = $request->category_name;
        // $delv->created_by = Auth::guard('officer')->user()->id;
        $cat->status = $request->status;
        $cat->save();
        return redirect()->route('cat-sub-master')
        ->with('success', 'Category Subject  Added Successfully');
    }
    public function categorysubjectUpdate(Request $request, $id){
        //return $request;
        $cat = RpSubjectCategory::where('id', $id)->update([
            'category_name' => $request->category_name,
            'status'=>$request->status,

        ]);
        return redirect()->route('cat-sub-master')
        ->with('success', 'Category Subject Updated Successfully');
    }
    public function categorysubjectDelete($id){
        //return $id;
        $cat = RpSubjectCategory::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('cat-sub-master')
        ->with('success', 'Category Subject Deleted Successfully');
    }

    public function checkCategoryName(Request $request){
        $categoryName = $request->input('category_name');
        $categoryCount = RpSubjectCategory::where('category_name', $categoryName)->where('is_delete', 0)->count();
    
        if ($categoryCount > 0) {
            return response()->json(['msg' => 'true']);
        } else {
            return response()->json(['msg' => 'false']);
        }
    }
}
