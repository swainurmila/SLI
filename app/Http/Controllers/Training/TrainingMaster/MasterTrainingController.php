<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training\TrTraining;
use Crypt;
use App\Exports\TrainingListExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Training\TrStudentReview;
use Auth;
use App\Models\Training\TrTrainingOrder;
use App\Models\Training\TrTrainingDetail;
use App\Models\Training\TrBatch;
use App\Mail\TrainingAssignedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Session;
use DB;
class MasterTrainingController extends Controller
{
    public function index($id){
        $training = TrTraining::with('TrainingImage','Place','TotalBatches.trainingOrder','TotalBatches.trainingDetailsByBatch.training','TotalBatches.trainingDetailsByBatch.trainingClasses.meetingDetails','TotalEnrollOrders','language','TrainingCategory','TrainingReviews')->where('id',$id)->first();

        // $training = TrTraining::with('TrainingImage','Place','TotalBatches.trainingOrder','TotalBatches.trainingDetailsByBatch.training','TotalBatches.trainingDetailsByBatch.trainingClasses.meetingDetails','TotalEnrollOrders','language','TrainingCategoryEnrollments','TrainingCategory','TrainingReviews')->where('id',$id)->first();
        // dd($training);
        
        $avg_ratings = TrStudentReview::where('training_id', $id)->avg('rate');
        $roundedAverageRating = min(5, round($avg_ratings, 2));
        return view('training.admin.training.batch.batch-list',compact('training','roundedAverageRating'));
    }



    // public function trainingListType($id){

    //     $id = Crypt::decryptString($id);
    //     $trainings_paid = TrTraining::where('training_type',$id)->where('payment_type',1)->orderBy('id','desc')->paginate(10);

    //     $trainings_unpaid = TrTraining::where('training_type',$id)->where('payment_type',0)->orderBy('id','desc')->paginate(10);
    //     if($id == 0){
    //         $training_type = "Training with Certificate";

    //     }else{
    //         $training_type = "Training with out Certificate";

    //     }
    //     return view('training.training-master.training.index',compact('trainings_paid','trainings_unpaid','training_type','id'));

    // }


    public function trainingList(Request $request){



        if(Auth::user()->role_id == '3'){
            $trainings = TrTraining::with('User')->orderBy('id','desc')->get();
        }else{
            $trainings = TrTraining::with('User')->orderBy('id','desc')->where('created_by', Auth::user()->id)->get();
        }
        
        return view('training.training-master.training.index',compact('trainings'));
    }


    public function exportList(){
        return Excel::download(new TrainingListExport, 'Training-list.xlsx');
    }

    public function assignTraining($id){
        try{
            // return $id;
              $training = TrTraining::with('Batch')
            ->whereHas('Batch', function ($query) use ($id) {
                $query->where('id', $id);
            })
            ->first();


            $users = User::with('createdBy')->where('role_id', 5)
            ->where('status', 1)
            ->where('is_training', '1')
            ->where('created_by','sponsor-user')
            // ->orwhereIn('created_by', [Auth::user()->id, '3'])
            ->get();
            // $reserved_user = User::with('trainingOrders')->whereIn('created_by', [Auth::user()->id, '3'])->get();
            $trainings = TrTrainingDetail::get(['start_date', 'end_date']);
            $trainingsArray = $trainings->toArray();
            // $trainingsJSON = json_encode($trainingsArray);
            $training_details = TrTrainingDetail::with('trainingOrder.user')->where('batch_id', $id)->first();

            // return $training_details;

            return view("training.training-master.assign_training.index", compact('training', 'users', 'trainingsArray', 'training_details'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
       }
    }
    public function assignTrainingStore(Request $request){
        try{

            $student_ids = array_filter($request->all(), function($key) {
                return is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);


            $batch = TrBatch::where('id',$request->batch_id)->first();

            $training_orders = TrTrainingOrder::where('training_id',$request->training_id)->where('batch_id',$batch->id)->count();





            if($batch && $training_orders < $batch->max_student){

                if(count($student_ids) > 0){
                    if(count($student_ids) > $batch->max_student){
                        Session::flash('error','Only '.$batch->max_student.' can attend this batch !');
                        return redirect()->back();
                    }else{

                        $training = TrTraining::find($request->training_id);

                        $training_details = TrTrainingDetail::where('training_id', $request->training_id)->first();
                        $batch = TrBatch::where('id', $request->batch_id)->first();
                        //Storing Batch details

                        if (!$request->training_details) {
                            $batch_details = new TrTrainingDetail;
                            $batch_details->training_id = $training->id;
                            $batch_details->batch_id = $request->batch_id;
                            $batch_details->start_date = $request->start_date;
                            $batch_details->end_date = $request->end_date;
                            $batch_details->save();
                        }

                        foreach ($student_ids as $key => $value) {


                            $trainingStudentCounts = TrTrainingOrder::where('training_id',$request->training_id)->where('batch_id',$batch->id)->count();


                            if($trainingStudentCounts < $batch->max_student){

                                $user_details = User::where('id', $value)->first(['first_name', 'last_name', 'email']);
                                $email_id = $user_details->email;

                                $is_training_order = TrTrainingOrder::where('training_id',$request->training_id)->where('user_id',$value)->first();

                                if($is_training_order){
                                    $is_training_order->training_details_id = $request->training_details;
                                    $is_training_order->batch_id = $request->batch_id;
                                    $is_training_order->save();
                                }else{



                                    $training_order = new TrTrainingOrder;
                                    $training_order->user_id = $value;
                                    $training_order->training_id = $training->id;
                                    $training_order->training_start_date = $request->start_date;
                                    $training_order->training_end_date = $request->end_date;
                                    $training_order->training_course_id = $training->training_course_id;
                                    $training_order->training_place_id = $training->training_place_id;
                                    $training_order->subject_id = $training->subject_id;
                                    $training_order->training_category_id = $training->training_category_id;
                                    $training_order->training_details_id = $request->training_details ? $request->training_details : $batch_details->id;
                                    $training_order->training_duration_type = $training->training_duration_type;
                                    $training_order->training_duration = $training->training_duration;
                                    $training_order->selling_price = $training->price;
                                    $training_order->original_price = $training->price;
                                    $training_order->payment_type = $training->payment_type;
                                    $training_order->training_type = $training->training_type;
                                    $training_order->batch_id = $request->batch_id;
                                    $training_order->training_name = $training->name;
                                    $training_order->language_id = $training->language_id;
                                    $training_order->description = $training->description;
                                    $training_order->created_by = Auth::user()->id;
                                    $training_order->save();
                                }

                                $mailData = [
                                    "name"   => $user_details->first_name. ' ' .$user_details->last_name,
                                    'sponsor_name' => Auth::user()->first_name. ' '.Auth::user()->last_name,
                                    "training_name" => $training->name,
                                    "training_duration" => $training->training_duration. ' ' .$training->training_duration_type,
                                    "start_date" => $request->start_date,
                                    "start_time" => $batch->start_time,
                                    "end_time" => $batch->end_time,
                                ];
                                Mail::to($email_id)->send(new TrainingAssignedMail($mailData));
                            }else{
                                Session::flash('error','Batch limit already exceed !');
                                return redirect()->back();
                            }
                        }
                        Session::flash('success','Training Successfully Assigned !');
                        return redirect()->back();
                    }
                }else{
                    Session::flash('error','Choose one student or no more student left !');
                    return redirect()->back();
                }
            }else{
                Session::flash('error','Batch limit already exceed !');
                return redirect()->back();
            }


        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function getTrainingId(Request $request)
    {
        $batch = DB::table('tr_batches')->where('training_id', $request->training_id)->orderBy('batch_name', 'asc')->get();
        return response()->json(['batch' => $batch]);
    }


}
