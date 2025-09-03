<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Course\CrNotification;
use App\Models\Course\CrCourse;
use App\Models\Course\CrCourseCart;
use App\Models\Course\CrStudentAppliedExam;
use App\Models\Course\CrExamAnswer;
use App\Models\Course\CrExam;
use Illuminate\Support\Facades\Mail;
use App\Mail\CrExamNotification;
use Session;


class NotificationController extends Controller
{
    public function notificationIndex(){
        try {
          $data = CrNotification::with('Course', 'Exam')->get();
          $course = CrCourse::get();
          $exam = CrExam::get();


          
          return view('course.admin.notification.index',compact('data', 'course', 'exam'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function notificationStore(Request $request){
     try {
            $request->validate([
                'course_id'=> 'required',
                'exam_id'=>'required',
                'add_start_date'=>'required',
                'add_end_date'=>'required',
                'exam_date'=> 'required',
                'exam_location' => 'required',
                'exam_start_time'=>'required',
                'hours_needed'=>'required'
            ]);
            //  return $request;
           
            $requestData = $request->all();
            $requestData['created_by'] = Auth::user()->id;
            $requestData['start_date'] = $request->add_start_date;
            $requestData['end_date'] = $request->add_end_date;
            $requestData['exam_date'] = $request->exam_date;
            $requestData['exam_start_time'] = $request->exam_start_time;
            $requestData['hours_needed'] = $request->hours_needed;

            $data = CrNotification::create($requestData);
            $course_user = CrCourseCart::with('course', 'UserData')->where('course_id', $request->course_id)->get();
            $exam_name = CrExam::where('id', $request->exam_id)->first();
            foreach( $course_user as $val){
                $emailData = [
                    'user_name' => $val->UserData->first_name,
                    'course_name' => $val->course->course_name,
                    'exam_name' => $exam_name->exam_title,
                    'apply_start' => $request->add_start_date,
                    'apply_end' => $request->add_end_date,
                    'exam_date' => $request->exam_date,
                    'exam_location' => $request->exam_location,
                    'exam_start_time' => $request->exam_start_time
                ];
                Mail::to($val->UserData->email)->send(new CrExamNotification($emailData));
            }
            
           
            if($data){
                Session::flash('success','Course Notification Created Successfully !');
                return redirect()->back();
            }
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function notificationUpdate(Request $request, $id){
     try {
        $request->validate([
            'course_id'=> 'required',
            'exam_id'=>'required',
            'add_start_date'=>'required',
            'add_end_date'=>'required',
            'exam_date'=>'required',
            'exam_location'=>'required',
            'exam_start_time'=>'required',
            'hours_needed'=>'required'

        ]);
    

        
        $data = CrNotification::find($id);
    
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        
        $data->start_date = $request->add_start_date;
        $data->end_date = $request->add_end_date;
        $data->exam_date = $request->exam_date;

        // $data->exam_start_time = $request->exam_start_time;
        // $data->hours_needed = $request->hours_needed;
        $requestData = $request->all();

        $data->update($requestData);
    
        Session::flash('success', 'Course Notification Updated Successfully !');
        return redirect()->back();
    } catch (ValidationException $e) {
        Log::error('Validation errors: ' . json_encode($e->errors()));
        return back()->withErrors($e->errors())->withInput();
    }
    }

    public function notificationDestroy($id){
    try {
        $data = CrNotification::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Course Notification Deleted Successfully!');
        return redirect()->back();
    } catch (ValidationException $e) {
        Log::error('Validation errors: ' . json_encode($e->errors()));
        return back()->withErrors($e->errors())->withInput();
    }
    }


    public function appliedStudents(Request $request,$id){
        try{
             $appliedStudents = CrStudentAppliedExam::with('notification.Exam.Course','user')->where('exam_notification_id',$id)->get();
             $notification_id = CrNotification::where('id', $id)->first();
            return view('course.admin.notification.applied-users.index',compact('appliedStudents', 'notification_id'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
        
    }
    public function getExam(Request $request)
    {
        $exam = CrExam::where('course_id', $request->course_id)->get();
        return response()->json([
            'exam' => $exam,
        ]);
    }
    public function getCourse(Request $request){
        $course_date = CrCourse::where('id', $request->course_id)->first('course_start_date');
        return response()->json([
            'course_date' => $course_date
        ]);
    }
    //Store Exam Attendance
    public function storeExamAttendance(Request $request, $id){
        try{
            //return $id;
            foreach ($request->attendance_type as $key => $value) {
                $attendance = CrStudentAppliedExam::where('user_id', $request->student_id[$key])->where('exam_notification_id', $id)
                                                   ->first();
                    $attendance->attendance = $value;
                    $attendance->save();
            }
            Session::flash('success', 'Attendance Taken Successfully!');
          return redirect()->route("course-notification-index");
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function examResult($id){
        try{
            $data = CrStudentAppliedExam::with('notification.Exam.Course','user')->where('exam_notification_id',$id)->where('attendance', 1)->get();
            $notification_id = CrNotification::where('id', $id)->first();
            return view("course.admin.exam.exam_result", compact("data", "notification_id"));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function storeExamResult(Request $request, $id){
        try{
            //return $id;
            foreach ($request->exam_score as $key => $value) {
                 $result = CrStudentAppliedExam::where('user_id', $request->student_id[$key])->where('exam_notification_id', $id)
                                                   ->first();
                    if($request->pass_mark[$key] > $value){
                        $res = 'Fail';
                    }else{
                        $res = 'Pass';
                    }
                    $result->score = $value;
                    $result->result = $res;
                    $result->save();
            }
            Session::flash('success', 'Result Stored Successfully!');
            return redirect()->route("course-notification-index");
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function answerList($id){
        $questionAnswers = CrStudentAppliedExam::with('user','notification.Course','notification.Exam')->where('exam_notification_id',$id)->get();

        return view("course.admin.notification.applied-users.question_answer", compact("questionAnswers"));

    }

    public function studentAnswer(Request $request){

        $notification_id = $request->input('notification_id');
        $student_id = $request->input('student_id');

        $answers = CrExamAnswer::with('question')->where('exam_notification_id',$notification_id)->where('user_id',$student_id)->get();

        return response()->json(['answers' => $answers]);


    }

}