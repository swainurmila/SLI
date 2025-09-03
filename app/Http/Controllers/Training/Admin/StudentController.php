<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training\TrTrainingOrder;
use App\Models\Training\TrBatch;
use App\Models\Training\TrTraining;
use App\Models\Training\TrTrainingDetail;
use Carbon\Carbon;

use Auth;
use App\Exports\StudentEnrollExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;


class StudentController extends Controller
{
    public function index(Request $request){
        if(Auth::user()->role_id == '3'){
            if($request->training && $request->batch){
                $trainingOrders = TrTrainingOrder::with('user','training','batch','userTrainingDetails')->where('training_id',$request->training)->where('batch_id',$request->batch)->orderBy('id','desc')->get();
            }else{
                if(isset($request->batch)){
                    $trainingOrders = TrTrainingOrder::with('user','training','batch','userTrainingDetails')->where('batch_id',$request->batch)->orderBy('id','desc')->get();
                }else{
                    $trainingOrders = TrTrainingOrder::with('user','training','batch','userTrainingDetails')->orderBy('id','desc')->get();
                }
            }
        }else{
            if($request->training && $request->batch){
                $trainingOrders = TrTrainingOrder::with('user','training','batch','userTrainingDetails')->where('training_id',$request->training)->where('batch_id',$request->batch)->whereHas('training', function($query) {
                    $query->where('created_by', Auth::user()->id);
                })->orderBy('id','desc')->get();
            }else{
                if(isset($request->batch)){
                    $trainingOrders = TrTrainingOrder::with('user','training','batch','userTrainingDetails')->where('batch_id',$request->batch)->whereHas('training', function($query) {
                        $query->where('created_by', Auth::user()->id);
                    })->orderBy('id','desc')->get();
                }else{
                    $trainingOrders = TrTrainingOrder::with('user','training','batch','userTrainingDetails')->whereHas('training', function($query) {
                        $query->where('created_by', Auth::user()->id);
                    })->orderBy('id','desc')->get();
                }
            }
        }

        $trainings = TrTraining::all();
        $batches = TrBatch::all();

        // dd($trainingOrders);

        return view('training.admin.student.index',compact('trainingOrders','trainings','batches'));
    }


    public function export()
    {
        return Excel::download(new StudentEnrollExport, 'Enroll-Students.xlsx');
    }

    public function studentBranchUpdate(Request $request,$studentid){

        $request->validate([
            "batch_id"=>'required',
        ]);


        try {
            $training_details = TrTrainingDetail::with('batch')->where('batch_id',$request->batch_id)->whereDate('start_date', '>', Carbon::today())->first();

            // dd($training_details);
            if($training_details){
                if ($training_details->batch->max_student > TrTrainingOrder::where('batch_id', $request->batch_id)->where('training_details_id',$training_details->id)->count()) {
                    $studentBranch = TrTrainingOrder::find($studentid);

                    if($studentBranch){
                        $studentBranch->batch_id = $request->batch_id;
                        $studentBranch->training_details_id = $training_details->id;
                        $studentBranch->save();
                    }
                } else {
                    $batchCounter = 0;
                    while (true) {
                      $nextBatch = TrTrainingDetail::with('batch')->where('batch_id', $request->batch_id)
                          ->where('start_date', '>', $training_details->start_date)
                          ->whereDate('start_date', '>', Carbon::today())
                          ->orderBy('start_date')
                          ->skip($batchCounter)
                          ->first();
                      if ($nextBatch && $nextBatch->batch->max_student > TrTrainingOrder::where('batch_id', $nextBatch->batch_id)->where('training_details_id',$nextBatch->id)->count()) {
                          // Next batch found and maximum students not reached, insert data for the next batch
                        $studentBranch = TrTrainingOrder::find($studentid);

                        if($studentBranch){
                            $studentBranch->batch_id = $request->batch_id;
                            $studentBranch->training_details_id = $nextBatch->id;
                            $studentBranch->save();
                        }
                        break;
                      }else{
                        $studentBranch = TrTrainingOrder::find($studentid);

                        if($studentBranch){
                            $studentBranch->batch_id = $request->batch_id;
                            $studentBranch->training_details_id = null;
                            $studentBranch->save();
                        }
                        break;
                      }
                      $batchCounter++;
                    }
                }
            }else{
                $studentBranch = TrTrainingOrder::find($studentid);

                if($studentBranch){
                    $studentBranch->batch_id = $request->batch_id;
                    $studentBranch->training_details_id = null;
                    $studentBranch->save();
                }
            }

            $request->session()->flash('success', "Batch Updated Successfully !");
            return redirect()->back();
        } catch (\Throwable $th) {
            $request->session()->flash('error', "Something went's wrong !");
            return redirect()->back();
        }
    }
}
