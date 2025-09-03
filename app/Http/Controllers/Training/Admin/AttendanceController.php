<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
use App\Models\Training\TrTrainingOrder;

use App\Models\Training\TrTrainingClass;
use Session;
use Auth;
use DB;
use App\Models\Training\TrStudentAttendance;
class AttendanceController extends Controller
{
    public function __construct()
    {}


  
 
    public function index(Request $request,$id)
    {
        $dateString = date("Y-m-d");
       
        if ($request->isMethod('POST')) {
             $dateString = $request->attendance_date;
         }
        //  dd($id);
 
        $class_data = TrTrainingClass::where('id',$id)->first();
         
        // dd($class_data);
        $class_count = TrTrainingClass::where('id',$id)->count();

        $attendance_data ='';
        $attendance_count = 0;      
        if(isset($class_data->id)){
           
            $attendance_data = TrStudentAttendance::where('class_id',$class_data->id)->get();
        
            $attendance_count = TrStudentAttendance::where('class_id',$class_data->id)->count();
        }
 
       
        $timestamp = strtotime($class_data->class_date);
 
        $formattedDate = date("d M Y", $timestamp);
        $student_order = TrTrainingOrder::where('training_details_id',$class_data->training_details_id)->get();

        // dd($id);
        // dd($attendance_count);

        return view('training.admin.attendances.index',compact('formattedDate','student_order','id','dateString','class_data','class_count','attendance_data','attendance_count'));
       
    }
 
    public function store(Request $request)
    {
       
        //return $request;
        $class_id = TrTrainingClass::where('id',$request->class_id)->first();


        // $attendances = array_filter($request->input('attendance_type'), function($key) {
        //     return is_numeric($key);
        // }, ARRAY_FILTER_USE_KEY);

        // $attendanceType = array_values($attendances);

        // if(count($attendanceType) > 0){
            
        //     foreach ($attendanceType as $key => $value) {
        //         $attendance = new TrStudentAttendance();
        //         $attendance->attendance_type = $value;
        //         $attendance->training_details_id = $class_id->training_details_id;
        //         $attendance->class_id = $class_id->id;
        //         $attendance->batch_id = $class_id->batch_id;
        //         $attendance->student_id = $request->student_id[$key];
        //         $attendance->save();
               
        //     }
        // }

        $counter = 0;
        while ($request->has("attendance_type_$counter")) {
            $attendance = new TrStudentAttendance();
            $attendance->attendance_type = $request->input("attendance_type_$counter");
            $attendance->training_details_id = $class_id->training_details_id;
            $attendance->class_id = $class_id->id;
            $attendance->batch_id = $class_id->batch_id;
            $attendance->student_id = $request->input("student_id_$counter");
            $attendance->save();
            $counter++;
        }
 
        Session::flash('success', trans('Attendance Added Successfully'));
        return redirect()->route('attendance.index', ['id' => $class_id->id]);
 
    }
   
        public function userAttendance(Request $request)
    {
        $attendance_data = TrStudentAttendance::with('TrainingDetails.training','ClassDetails','Batch')->where('student_id',Auth::user()->id)->get();
 
        return view('training.admin.attendances.userAttendance',compact('attendance_data'));
       
    }
 
    public function userAttendanceregularizationRequest(Request $request)
    {   

        $attendance = TrStudentAttendance::where('id',$request['id'])->first();
            $attendance->regularization_remark = $request['remark'];
           
            $attendance->update();
            $data = [];
       
        return response()->json($data);
    }
 
 
    public function regularizationSubmit(Request $request,$id)
    {
        $attendance = TrStudentAttendance::where('id',$id)->first();

        // dd($attendance);
       $attendance->regularization_remark = $request->remark;
       $attendance->attendance_type = $request->attendance_type;
 
       
    //    $attendance->check_in = $request->clock_in_time;
 
       
    //    $attendance->check_out = $request->clock_out_time;
       
       
       $attendance->update();
        $request->session()->flash('success', 'Attendance Successfully Updated !');
        return redirect()->back();
    //    return redirect()->route('attendance.index', ['id' => $attendance->training_details_id]);
         
    }
 
}

