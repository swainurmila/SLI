<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training\TrCategoryEnrollment;
use App\Models\Training\TrCategory;
use Session;
use App\Models\Training\TrTraining;

class MasterEnrollmentController extends Controller
{
    protected $model = TrCategoryEnrollment::class;

    public function index(){

        $categoryEnrollments = TrCategoryEnrollment::with('trainingCategory')->orderBy('id','desc')->get();
        $categories = TrCategory::all();
        return view('training.training-master.enrollment.index',compact('categoryEnrollments','categories'));
    }

    public function store(Request $request){
        $request->validate([
            'category_id'=>'required',
            'enrollment_start_date'=>'required',
            'enrollment_end_date'=>'required'
        ]);
    
        $requestData = $request->all();
        $data = $this->model::create($requestData);

        if($data){
            Session::flash('success','Training Module Created Successfully !');
            return redirect()->back();
        }else{
            Session::flash('error','Training Module Not Created !');
            return redirect()->back();
        }
    }


    public function update(Request $request,$id){
        $request->validate([
            'category_id'=>'required',
            'enrollment_start_date'=>'required',
            'enrollment_end_date'=>'required'
        ]);
    
        $data = $this->model::find($id);
    
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
    
        $requestData = $request->all();
        $data->update($requestData);
    
        Session::flash('success', 'Training Enrollment Updated Successfully !');
        return redirect()->back();
    }


    public function getCategory(Request $request){

        $category = $request->input('category');
        $data = TrTraining::where('training_category_id', $category)->get();
        return response()->json($data);
    }
}
