<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Auth;
use App\Models\Training\TrCategory;
use Session;

class Master_CategoryController extends BaseController
{

    protected $model = TrCategory::class;

    public function index(){
        
        if(Auth::user()->role_id != 5){
            $datas = $this->model::paginate(10);
        }else{
            $datas=[];
        }
        return view('training.training-master.category.index',compact('datas'));
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required'
        ]);

        $requestData = $request->all();
        $requestData['created_by'] = Auth::user()->id;

        $data = $this->model::create($requestData);


        if($data){
            Session::flash('success','Training Category Created Successfully !');
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
    
        Session::flash('success', 'Training Category Updated Successfully !');
        return redirect()->back();
    }

    public function destroy($id){
        $data = $this->model::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Training Category Deleted Successfully!');
        return redirect()->back();
    }
}
