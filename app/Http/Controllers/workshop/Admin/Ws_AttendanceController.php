<?php

namespace App\Http\Controllers\workshop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\Workshop;
use App\Models\Workshop\WsSchedule;
use App\Models\Workshop\WsAttendance;
use App\Models\Workshop\WsCertificate;
use App\Models\User;
use Session;
use Auth;


class Ws_AttendanceController extends Controller
{
    public function attendanceIndex($id){
        try{
            $workshop = WsSchedule::with('Workshop', 'attendance.user', 'enrollDetails.user')->where('id', $id)->first();
            $class_count = WsSchedule::where('id',$id)->count();
            $attendance_count = WsAttendance::where('schedule_id', $id)->count();
            $timestamp = strtotime($workshop->schedule_date);
            $formattedDate = date("d M Y", $timestamp);
            return view("workshop.admin.workshop.attendance.index", compact("formattedDate", "class_count", "workshop", "attendance_count"));
        }catch (ValidationException $e) {
                Log::error('Validation errors: ' . json_encode($e->errors()));
                return back()->withErrors($e->errors())->withInput();
        }
      }
      // Store Attendance
      public function attendanceStore(Request $request){
        try{
        $counter = 0;
            while ($request->has("attendance_type_$counter")) {
                $attendance = new WsAttendance();
                $attendance->attendance_type = $request->input("attendance_type_$counter");
                $attendance->workshop_id = $request->workshop_id;
                $attendance->schedule_id = $request->schedule_id;
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
      public function viewAttendance(){
        try{
          $data = WsAttendance::with('schedule', 'Workshop')->where('student_id', Auth::user()->id)->get();
          return view("workshop.user.attendance.index", compact('data'));
        }catch (ValidationException $e) {
          Log::error('Validation errors: ' . json_encode($e->errors()));
          return back()->withErrors($e->errors())->withInput();
        }
      }

      public function userAttendanceregularization(Request $request){
        try{
            //return $request;
            $attendance = WsAttendance::where('id',$request['id'])->first();
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
            $attendance = WsAttendance::where('id',$id)->first();
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
    public function getCertificate(Request $request, $id)
    {
        $user = User::where('id', Auth::user()->id)->first();
        $traing_data = Workshop::where('id', $id)->first();
        $setting_data = WsCertificate::first();
        // return view('training.traininguser.profile.classes.certificate',compact('user','oder_data','traing_data'));
        if($setting_data->template_id == 3){
         return view('workshop.user.certificate.certificatetwo',compact('user', 'traing_data'));}
        else{

        return view('workshop.user.certificate.certificate',compact('user', 'traing_data'));
        }
        $html = view('workshop.user.certificate.Certificate')->render();

        // Create a new Dompdf instance
        $pdf = PDF::loadView('training.traininguser.profile.classes.Certificate');

        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->download('certificate.pdf');
    }

}
