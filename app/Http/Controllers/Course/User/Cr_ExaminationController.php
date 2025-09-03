<?php

namespace App\Http\Controllers\Course\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrStudentAppliedExam;
use App\Models\Course\CrExam;
use App\Models\Course\CrCourseCart;
use Auth;
use Session;

class Cr_ExaminationController extends Controller
{
    public function examApply(Request $request,$id){

        try {
            $appliedExamExist = CrStudentAppliedExam::where('exam_notification_id',$id)->where('user_id',Auth::user()->id)->first();
    
            if($appliedExamExist){
                $request->session()->flash('error', 'Already Applied !');
                return redirect()->back();
            }else{
                $appliedExam = new CrStudentAppliedExam;
                $appliedExam->user_id = Auth::user()->id;
                $appliedExam->exam_notification_id = $id;
    
                $appliedExam->save();
                $request->session()->flash('success', 'Successfully Applied !');
                return redirect()->route("user.course.view-student-examination");
            }
        } catch (\Throwable $th) {
            $request->session()->flash('error', "Something went's wrong !");
            return redirect()->back();
        }
    }
    public function viewStudentExam(){
        try{
            $datas = CrExam::with('CrCart', 'Notification.Result','Notification.ExamAnswers', 'course')
            ->whereHas('CrCart', function($query) {
                $query->where('user_id', auth()->id())
                    ->where('enroll_status', 'completed');
            })
            ->whereHas('Notification.Result', function($query) {
                $query->where('user_id', auth()->id());
            })->orderBy('id', 'DESC')
            ->get();


            
            return view("course.user.exam.view_exam", compact('datas'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
