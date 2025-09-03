<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Models\Training\TrCourse;
use Session;
use App\Models\Training\TrCategory;


class MasterCourseController extends BaseController
{
    protected $model = TrCourse::class;

    public function index(){


        if(Auth::user()->role_id != 5){
            $datas = $this->model::paginate(10);
        }else{
            $datas=[];
        }

        $categories = TrCategory::all();
        return view('training.training-master.course.index',compact('datas','categories'));
    }

    public function store(Request $request){
        $request->validate([
            'course_name'=>'required',
            'course_desc'=>'required',
            'categories_id'=>'required'
        ]);

        $requestData = $request->all();
        $requestData['created_by'] = Auth::user()->id;

        $data = $this->model::create($requestData);
        if($data){
            Session::flash('success','Training Course Created Successfully !');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'course_name'=>'required',
            'course_desc'=>'required',
            'categories_id'=>'required'
        ]);
    
        $data = $this->model::find($id);
    
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
    
        $requestData = $request->all();
        $data->update($requestData);
    
        Session::flash('success', 'Training Course Updated Successfully !');
        return redirect()->back();
    }

    public function destroy($id){
        $data = $this->model::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Training Course Deleted Successfully!');
        return redirect()->back();
    }
}
