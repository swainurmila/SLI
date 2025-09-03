<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\CategoryMaster;
use App\Models\Finance\SubCategoryMaster;
use App\Models\Finance\BankDetails;
use Session;

class MasterController extends Controller
{
    public function categoryMaster(){
        try{
            $category = CategoryMaster::get();
            return view("finance.user.category.category_master", compact('category'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function storeCategoryMaster(Request $request){
        try{
            //return $request;
            $request->validate([
                'category_name' => 'required|string|max:255|unique:fi_category_master,category_name',
                'cat_status' => 'required',
            ],[
                'category_name.required' => 'The scheme name is required.',
                'category_name.string' => 'The scheme name must be a string.',
                'category_name.max' => 'The scheme name must not exceed 255 characters.',
                'category_name.unique' => 'The scheme name has already been taken.',
                'cat_status.required' => 'The scheme status is required.',
            ]);
            $cat = new CategoryMaster();
            $cat->category_name = $request->category_name;
            $cat->status = $request->cat_status;
            $cat->save();
            // Session::flash('success', trans('flash.AddedSuccessfully'));
            // Session::flash('success', 'Scheme added successfully');
            return redirect()->back()->with('success', 'Scheme added successfully');

        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function updateCategoryMaster($id, Request $request){
        try{
            $request->validate([
                'category_name_edit' => 'required|string|max:255',
                'cat_status_edit' => 'required',
            ]);
            //return $id;
            //return $request;
            $cat = CategoryMaster::find($id);
            $cat->category_name = $request->category_name_edit;
            $cat->status = $request->cat_status_edit;
            $cat->update();
            // Session::flash('success', trans('flash.AddedSuccessfully'));
            return redirect()->back()->with('success', 'Scheme updated successfully');
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function subCategoryMaster(){
        try{
             $category = CategoryMaster::get();
             $subcategory = SubCategoryMaster::with('Category')->get();
             $bank = BankDetails::get();
            return view("finance.user.category.sub_category_master", compact('category', 'subcategory', 'bank'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function storeSubCategoryMaster(Request $request){
        try{
            $request->validate([
                'cat_id' => 'required',
                'subcategory_name' => 'required|string|max:255|unique:fi_subcategory_master,sub_category_name',
                'acc_no' => 'required|string|max:20|unique:fi_subcategory_master,account_number',
                'sub_cat_status' => 'required',
            ]);
            //return $request;
            $cat = new SubCategoryMaster();
            $cat->category_id = $request->cat_id;
            $cat->sub_category_name = $request->subcategory_name;
            $cat->account_number = $request->acc_no;
            $cat->status = $request->sub_cat_status;
            $cat->save();
            // Session::flash('success', trans('flash.AddedSuccessfully'));
            Session::flash('success', 'Sub-Scheme added successfully');
            return redirect()->back();

        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
   public function updateSubCategoryMaster(Request $request, $id){
        try{
            $request->validate([
                'cat_id_edit' => 'required',
                'subcategory_name_edit' => 'required|string|max:255',
                'acc_no_edit' => 'required|string|max:20',
                'sub_cat_status_edit' => 'required',
            ]);
            //return $id;
            //return $request;
            $cat = SubCategoryMaster::find($id);
            $cat->category_id = $request->cat_id_edit;
            $cat->sub_category_name = $request->subcategory_name_edit;
            $cat->account_number = $request->acc_no_edit;
            $cat->status = $request->sub_cat_status_edit;
            $cat->update();
            // Session::flash('success', trans('flash.AddedSuccessfully'));
            Session::flash('success', 'Sub-Scheme updated successfully');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
   }

}
