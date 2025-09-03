<?php

namespace App\Http\Controllers\Course\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\Course\CrExam;
use App\Models\Course\CrCourseCart;


class Cr_HomeController extends Controller
{
    public function index(){

        $enrolledCourses = CrCourseCart::getEnrolledCourseLists();
        $exams = CrExam::with('CrCart', 'Notification.Result', 'course')
            ->whereHas('CrCart', function($query) {
                $query->where('user_id', auth()->id())
                    ->where('enroll_status', 'completed');
            })
            ->whereHas('Notification.Result', function($query) {
                $query->where('user_id', auth()->id());
            })->orderBy('id', 'DESC')
            ->get();
        
        $completedCourse = 0;
        $activeCourse = 0;
        if(count($exams) > 0){
            foreach ($exams as $key => $exam) {
                if($exam->Notification->Result && $exam->Notification->Result->result == 'Pass'){
                    $completedCourse++;
                }else{
                    $activeCourse++;
                }
            }

        }else{
            $completedCourse = 0;
            $activeCourse = 0;
        }


        return view('course.user.home',compact('enrolledCourses','activeCourse','completedCourse'));
    }

    public function logout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('course.login.show');
    }
}
