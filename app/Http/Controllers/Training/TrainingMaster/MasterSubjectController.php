<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Models\Training\TrSubject;
use App\Models\Training\TrCourse;

use Session;

class MasterSubjectController extends BaseController
{
    protected $model = TrSubject::class;

    public function index(){

        if(Auth::user()->role_id != 5){
            $datas = $this->model::with('Course')->paginate(10);
        }else{
            $datas=[];
        }

        $courses = TrCourse::all();
        return view('training.training-master.subject.index',compact('datas','courses'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'course_id'=>'required'
        ]);

        $requestData = $request->all();
        $requestData['created_by'] = Auth::user()->id;

        $data = $this->model::create($requestData);


        if($data){
            Session::flash('success','Training Subject Created Successfully !');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'course_id'=>'required'
        ]);
    
        $data = $this->model::find($id);
    
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
    
        $requestData = $request->all();
        $data->update($requestData);
    
        Session::flash('success', 'Training Subject Updated Successfully !');
        return redirect()->back();
    }

    public function destroy($id){
        $data = $this->model::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Training Subject Deleted Successfully!');
        return redirect()->back();
    }
}
