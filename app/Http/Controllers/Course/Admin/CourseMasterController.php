<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Course\CrCategoryMaster;
use App\Models\Course\CrPlaceMaster;
use Session;


class CourseMasterController extends Controller
{
    protected $model = CrCategoryMaster::class;
    public function index(){
        $data = $this->model::get();
        return view("course.admin.category_master.index", compact('data'));
    }
    public function store(Request $request){

        $request->validate([
            'name'=>'required'
        ]);
        $requestData = $request->all();
        $requestData['created_by'] = Auth::user()->id;

        $data = $this->model::create($requestData);


        if($data){
            Session::flash('success','Course Category Created Successfully !');
            return redirect()->back();
        }
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required'
        ]);

        $data = $this->model::find($id);

        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }

        $requestData = $request->all();
        $data->update($requestData);

        Session::flash('success', 'Course Category Updated Successfully !');
        return redirect()->back();
    }

    public function destroy($id){
        $data = $this->model::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Course Category Deleted Successfully!');
        return redirect()->back();
    }

    //Course Place Master
    public function placeIndex(){
        $datas = CrPlaceMaster::all();
        return view('course.admin.place_master.index',compact('datas'));
    }

    public function placeStore(Request $request){

        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);
        //return $request;
        $requestData = $request->all();
        $requestData['created_by'] = Auth::user()->id;


        $data = CrPlaceMaster::create($requestData);


        if($data){
            Session::flash('success','Course Place Created Successfully !');
            return redirect()->back();
        }
    }

    public function placeUpdate(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);

        $data = CrPlaceMaster::find($id);

        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }

        $requestData = $request->all();
        $data->update($requestData);

        Session::flash('success', 'Course Place Updated Successfully !');
        return redirect()->back();
    }

    public function placeDestroy($id){
        $data = CrPlaceMaster::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Course place Deleted Successfully!');
        return redirect()->back();
    }
}
