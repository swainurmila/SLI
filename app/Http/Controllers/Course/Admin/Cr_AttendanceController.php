<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrSyllabusClass;
use App\Models\Course\CrAttendance;
use App\Models\Course\CrCourse;
use Auth;
use Session;
class Cr_AttendanceController extends Controller
{
  public function attendanceIndex($id){
    try{

        $class_data = CrSyllabusClass::with(['enrollDetails.UserData.Cr_Attendance' => function($query) use ($id) {
            $query->where('class_id', $id);
        }])->where('id', $id)->first();
        // return $class_data->course_id;
        $course = CrCourse::where('id', $class_data->course_id)->first('course_name');
        $class_count = CrSyllabusClass::where('id',$id)->count();
        $attendance_count = CrAttendance::where('class_id', $id)->count();
        $timestamp = strtotime($class_data->class_date);
        $formattedDate = date("d M Y", $timestamp);
        return view("course.admin.course.attendance.index", compact("formattedDate", "class_count", "class_data", "attendance_count", "course"));
    }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();   
    }
  }
  // Store Attendance
  public function attendanceStore(Request $request){
    try{
       // return $request;
    //     foreach ($request->attendance_type as $key => $value) {
    //     $attendance = new CrAttendance();
    //        $attendance->attendance_type = $value;
    //        $attendance->course_id = $request->course_id;
    //        $attendance->class_id = $request->class_id;
    //        $attendance->syllabus_id = $request->syllabus_id;
    //        $attendance->check_in = $request->clock_in_time[$key]; 
    //        $attendance->student_id = $request->student_id[$key]; 
    //        $attendance->check_out = $request->clock_out_time[$key];
    //        $attendance->save();
    //    }
    // return $request;
    $counter = 0;
    while ($request->has("attendance_type_$counter")) {
        $attendance = new CrAttendance();
        $attendance->attendance_type = $request->input("attendance_type_$counter");
        $attendance->course_id = $request->course_id;
        $attendance->class_id = $request->class_id;
        $attendance->syllabus_id = $request->syllabus_id;
        $attendance->check_in = $request->input("clock_in_time_$counter");
        $attendance->student_id = $request->input("student_id_$counter");
        $attendance->check_out = $request->input("clock_out_time_$counter");
        $attendance->save();

        $counter++;
    }
        return redirect()->back()->with('success', 'Attendance stored successfully');
    }catch (ValidationException $e) {
        Log::error('Validation errors: ' . json_encode($e->errors()));
        return back()->withErrors($e->errors())->withInput();
    }
  }
  public function viewStudentAttendance(){
    try{
          $data = CrAttendance::with('Class', 'Course')->where('student_id', Auth::user()->id)->get();
        
        return view("course.user.attendance.index", compact('data'));
    }catch (ValidationException $e) {
        Log::error('Validation errors: ' . json_encode($e->errors()));
        return back()->withErrors($e->errors())->withInput();
    }
  }
  public function userAttendanceregularization(Request $request)
    {
        try{
            $attendance = CrAttendance::where('id',$request['id'])->first();
                $attendance->regularization_remark = $request['remark'];
                
                $attendance->update();
                $data = [];
            
            return response()->json($data);
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function regularizationSubmit(Request $request,$id)
    { 
        try{
           // return $request;
            $attendance = CrAttendance::where('id',$id)->first();
            $attendance->regularization_remark = $request->remark;
            $attendance->attendance_type = $request->attendance_type;
            $attendance->check_in = $request->clock_in_time;
            $attendance->check_out = $request->clock_out_time;
            $attendance->update();
            return redirect()->back()->with('success', 'Attendance stored successfully');
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
        
         
    }
}