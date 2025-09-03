<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training\TrTrainingDetail;

class ExamController extends Controller
{
    public function create($id){

        $training_details = TrTrainingDetail::find($id);

        return view('training.admin.exam.create',compact('training_details'));
    }

    public function store(Request $request){
        dd($request->all());
    }
}
