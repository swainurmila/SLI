<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

use Auth;
use App\Models\Training\TrTrainingPlace;
use Session;

class MasterPlaceController extends BaseController
{
    protected $model = TrTrainingPlace::class;

    public function index(){

        if(Auth::user()->role_id != 5){
            $datas = $this->model::paginate(10);
        }else{
            $datas=[];
        }

        return view('training.training-master.training-place.index',compact('datas'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);

        $requestData = $request->all();
        $requestData['created_by'] = Auth::user()->id;


        $data = $this->model::create($requestData);


        if($data){
            Session::flash('success','Training Place Created Successfully !');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'description'=>'required'
        ]);

        $data = $this->model::find($id);

        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }

        $requestData = $request->all();
        $data->update($requestData);

        Session::flash('success', 'Training Place Updated Successfully !');
        return redirect()->back();
    }

    public function destroy($id){
        $data = $this->model::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Training Place Deleted Successfully!');
        return redirect()->back();
    }
}
