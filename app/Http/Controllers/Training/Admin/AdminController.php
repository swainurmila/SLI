<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;

use App\Models\Training\TrCategory;
// use App\Models\Training\TrCategory;
use App\Models\Training\TrCourse;
use App\Models\Training\TrModule;
use App\Models\Training\TrSubject;
use App\Models\Training\TrTrainingPlace;
use App\Models\Training\TrTraining;
use App\Models\Training\TrBatch;
use App\Models\Training\TrainingImages;
use App\Models\Training\TrCertificateSetting;
use App\Models\Language;
use App\Models\Training\TrTrainingDetail;
use Illuminate\Http\Request;
use Session;
use Auth;
use Crypt;
use Carbon\Carbon;
use App\Models\Training\TrTrainingOrder;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{

    public function batchList(){

        $batches = TrBatch::all();
        return view('training.admin.batch.index-batch',compact('batches'));
    }


    public function createTraining(){
        // dd($id);
        // $id = Crypt::encryptString($id);

        $tr_categores = TrCategory::get();
        $tr_courses = TrCourse::get();
        $tr_subjects = TrSubject::get();
        $tr_training_places = TrTrainingPlace::get();
        $languages = Language::get();

        return view('training.admin.batch.create-batch',compact('tr_categores','tr_courses','tr_subjects','tr_training_places','languages'));
    }



    public function editTraining(Request $request, $id){
        $tr_categores = TrCategory::get();
        $tr_courses = TrCourse::get();
        $tr_subjects = TrSubject::get();
        $tr_training_places = TrTrainingPlace::get();
        $languages = Language::get();
        $training_datas = TrTraining::with('TrainingImage')->where('id',$id)->first();

        // dd($training_datas);
        $batch_datas = TrBatch::where('training_id',$id)->get();
        return view('training.admin.batch.edit-batch',compact('tr_categores','tr_courses','tr_subjects','tr_training_places','languages','batch_datas','training_datas'));
    }
    public function adminLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('admin.training.login');
    }

    public function createTrainingStore(Request $request)
    {


        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'training_place_id' => 'required',
            'name' => 'required|unique:tr_training',
            'training_category_id' => 'required',
            'training_duration_type' => 'required',
            'training_duration' => 'required',
            // 'price'=>'required',
            'price' => 'required_if:payment_type,1',
            'payment_type' => 'required',
            'language_id' => 'required',
            'description'=> 'required',
            'book_image' => 'required|file|mimes:jpeg,png,jpg|max:1024',
            'enroll_start_date' => 'required',
            'enroll_end_date'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        // return $request;
        $data = new TrTraining();
        // $data->category_id = $request->category_id;
        $data->language_id = $request->language_id;
        $data->training_place_id = $request->training_place_id;
        $data->name = $request->name;
        $data->training_category_id = $request->training_category_id;
        $data->training_duration_type = $request->training_duration_type;
        $data->training_duration = $request->training_duration;
        $data->price = $request->price;
        $data->payment_type = $request->payment_type;
        $data->training_type = 0;
        $data->language_id = $request->language_id;
        $data->description = $request->description;
        $data->enroll_start_date = $request->enroll_start_date;
        $data->enroll_end_date = $request->enroll_end_date;
        $data->created_by = Auth::user()->id;
        $data->save();

        // if(isset($request->batch_name)){
        //     foreach($request->batch_name as $key => $rank) {  
        //         $location_data = new TrBatch(); 
        //         $location_data->start_time = $request->start_time[$key]; 
        //         $location_data->training_id = $data->id; 
        //         $location_data->batch_name = $request->batch_name[$key];
        //         $location_data->end_time = $request->end_time[$key];
        //         $location_data->max_student = $request->max_student[$key];
        //         $location_data->total_class = $request->total_class[$key];
        //         $location_data->save();
        //     } 
        // }

        if(isset($request->batch_name)){
            $batch_data = new TrBatch(); 
            $batch_data->start_time = $request->input("start_time"); 
            $batch_data->training_id = $data->id; 
            $batch_data->batch_name = $request->input("batch_name");
            $batch_data->end_time = $request->input("end_time");
            $batch_data->max_student = $request->input("max_student");
            $batch_data->total_class = $request->input("total_class");
            $batch_data->save();
        }

        $key = 0;
        if(isset($request->{"batch_name_$key"})) {
            while($request->has("batch_name_$key")) {
                $location_data = new TrBatch(); 
                $location_data->start_time = $request->input("start_time_$key"); 
                $location_data->training_id = $data->id; 
                $location_data->batch_name = $request->input("batch_name_$key");
                $location_data->end_time = $request->input("end_time_$key");
                $location_data->max_student = $request->input("max_student_$key");
                $location_data->total_class = $request->input("total_class_$key");
                $location_data->save();
                $key++;
            } 
        }

        if ($file = $request->file('book_image')) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . '.' . $extension;
            $path = public_path('public/upload/training/training_image/');
            $upload_success = $file->move($path, $filename);
            $profile_photo = '/public/upload/training/training_image/' . $filename;

            $image_data =   new TrainingImages();
            $image_data->training_id = $data->id;
            $image_data->file_name = $filename;
            $image_data->save();
        }


        // $id = Crypt::encryptString($request->training_type);

        Session::flash('success', trans('Training Added Successfully !'));
        return redirect()->route('training.admin.trainingList');
        // return redirect()->route('training.admin.trainingListType',$id);

    }
    public function editTrainingStore(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'training_place_id' => 'required',
            'name' => 'required',
            'training_category_id' => 'required',
            'training_duration_type' => 'required',
            'training_duration' => 'required',
            'price' => 'required_if:payment_type,1',
            'payment_type' => 'required',
            'language_id' => 'required',
            'description'=> 'required',
            "book_image" => 'sometimes|file|mimes:jpeg,png|max:1024',
            'enroll_start_date' => 'required',
            'enroll_end_date'=> 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        // dd("dd");
        $data = TrTraining::where('id',$id)->first();
        // $data->category_id = $request->category_id;
        $data->language_id = $request->language_id;
        $data->training_place_id = $request->training_place_id;
        $data->name = $request->name;
        $data->training_category_id = $request->training_category_id;
        $data->training_duration_type = $request->training_duration_type;
        $data->training_duration = $request->training_duration;
        $data->price = $request->price;
        $data->payment_type = $request->payment_type;
        // $data->payment_type = $request->payment_type;
        // $data->training_type = $request->training_type;
        $data->language_id = $request->language_id;
        $data->description = $request->description;
        $data->enroll_start_date = $request->enroll_start_date;
        $data->enroll_end_date = $request->enroll_end_date;

        $data->update();
        // $delete_batch

        // if(isset($request->batch_name)){

        //     foreach($request->batch_name as $key => $rank) {  
        //         if($request->batch_id[$key] == 0){    
        //             $location_data = new TrBatch(); 
        //             $location_data->start_time = $request->start_time[$key]; 
        //             $location_data->training_id = $data->id; 
        //             $location_data->batch_name = $request->batch_name[$key];
        //             $location_data->end_time = $request->end_time[$key];
        //             $location_data->max_student = $request->max_student[$key];
        //             $location_data->total_class = $request->total_class[$key];
        //             $location_data->save();}
        //         else{
        //                 $location_data = TrBatch::where('id',$request->batch_id[$key])->first(); 
        //                 $location_data->start_time = $request->start_time[$key]; 
        //                 $location_data->training_id = $data->id; 
        //                 $location_data->batch_name = $request->batch_name[$key];
        //                 $location_data->end_time = $request->end_time[$key];
        //                 $location_data->max_student = $request->max_student[$key];
        //                 $location_data->total_class = $request->total_class[$key];
        //                 $location_data->update();
        //         }
        //     } 
        // }

         $key = 0;

            while($request->has("batch_name_$key")) {
                $batch_id = $request->input("batch_id_$key");

                if($batch_id == 0) {    
                    $location_data = new TrBatch(); 
                } else {
                    $location_data = TrBatch::find($batch_id); 
                }

                $location_data->start_time = $request->input("start_time_$key"); 
                $location_data->training_id = $data->id; 
                $location_data->batch_name = $request->input("batch_name_$key");
                $location_data->end_time = $request->input("end_time_$key");
                $location_data->max_student = $request->input("max_student_$key");
                $location_data->total_class = $request->input("total_class_$key");

                if($batch_id == 0) {
                    $location_data->save();
                } else {
                    $location_data->update();
                }

                $key++;
            }

        if ($file = $request->file('book_image')) {
            $extension = $file->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . '.' . $extension;
            $path = public_path('public/upload/training/training_image/');
            $upload_success = $file->move($path, $filename);
            $profile_photo = '/public/upload/training/training_image/' . $filename;

            $image_data = TrainingImages::where('training_id',$id)->first();
            $image_data->training_id = $data->id;
            $image_data->file_name = $filename;
            $image_data->save();
        }


        Session::flash('success', trans('Training Updated Successfully'));
        return redirect()->route('training.admin.trainingList');

    }


    public function removeBatches(Request $request){

        $batch = TrBatch::where('id',$request->id)->first();

        if($batch){
            $batch->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Batch remove successfully',
            ]);
        }else{
            return response()->json([
                'status' => 200,
                'message' => 'something wents wrong',
            ]);
        }


    }


    public function fetchBatchList($id){
        $batches = TrBatch::where('training_id',$id)->get();

        return response()->json($batches);
    }


    public function batchDetails($trainingid,$batchid){

        $trainingDetails = TrTrainingDetail::with('training','batch','trainingOrders')->where('training_id',$trainingid)->where('batch_id',$batchid)->orderBy('id','desc')->get();
        $training = TrTraining::with('TrainingImage','TotalBatches','TotalEnrollOrders','language')->where('id',$trainingid)->first();

        return view('training.training-master.training.batch-details.index',compact('trainingDetails','trainingid','batchid','training'));
    }

    public function batchDetailsStore(Request $request,$trainingid,$batchid){

        $batch_details = new TrTrainingDetail;
        $batch_details->training_id = $trainingid;
        $batch_details->batch_id = $batchid;
        $batch_details->start_date = $request->start_date;
        $batch_details->end_date = $request->end_date;
        $batch_details->save();


        if($batch_details->save()){
            $nextBatch = TrTrainingDetail::with('batch')->where('batch_id', $batchid)
                ->whereDate('start_date', '>=', Carbon::today())
                ->orderBy('start_date')
                ->first();
            $batchCounter = 0;
            while (true) {
                if($nextBatch->batch->max_student > TrTrainingOrder::where('batch_id', $batchid)->where('training_details_id',$batch_details->id)->count()){
                    $training_orders = TrTrainingOrder::where('batch_id', $batchid)->where('training_details_id',null)->first();
                    if($training_orders){

                        $training_orders->training_details_id = $batch_details->id;
                        $training_orders->save();
                        continue;
                    }else{

                        break;
                    }
                }else{
                    break;
                }
            }
            $batchCounter++;
        }

        return redirect()->back();
    }



    public function certificateSetting(){
        $tr_categores = TrCategory::get();
        $tr_courses = TrCourse::get();
        $tr_subjects = TrSubject::get();
        $tr_training_places = TrTrainingPlace::get();
        $languages = Language::get();

        $selectedCertificate = TrCertificateSetting::orderBy('id','desc')->first();

        return view('training.admin.batch.certificate-setting',compact('tr_categores','tr_courses','tr_subjects','tr_training_places','languages','selectedCertificate'));
    }

    public function CertificateSettingSave(Request $request)
    {
        // dd("dd");

       $template_id = $request['template_id'];

       if(TrCertificateSetting::count() == 0){
        $book_request = new TrCertificateSetting();

        $book_request->template_id = $template_id;

        $book_request->save();
    }else{
        TrCertificateSetting::where('id', 1)->update(['template_id' => $template_id]);

    }
         $data = [];
      return response()->json($data);
    }

    //Sponsor Added Trainings
    public function sponsorAddedTraining(){
        try{
             $training_data = TrTrainingOrder::with('users', 'batch', 'training_det')->where('created_by', '!=', 3) ->groupBy('batch_id')->get();
            return view("training.admin.sponsors.sponsor_added_training", compact('training_data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
       }
    }
    //view training user
    public function viewtrainingUser($id){
        try{
             $training_details = TrTrainingDetail::with('trainingOrder.user', 'training', 'batch')->where('batch_id', $id)->first();
            return view("training.admin.sponsors.sponsor_added_users", compact('training_details'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
       }
    }


}
