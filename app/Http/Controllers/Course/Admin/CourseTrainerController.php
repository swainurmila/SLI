<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Course\CrSyllabusClass;

class CourseTrainerController extends Controller
{
    public function courseAssignClass($id){
        if(Auth::user()->role_id == 4){
            $classes = CrSyllabusClass::with('courseDetails','meetingDetails')->get();
         }else{
            $classes = CrSyllabusClass::with('courseDetails','meetingDetails')->where('trainer_user_id',$id)->get();
        }

        $traner_user_data = User::find($id);


        return view("course.admin.trainer.assignClass", compact('classes','traner_user_data'));
    }
}
