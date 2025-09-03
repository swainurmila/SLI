<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCourseCart;
use App\Models\Course\CrCourse;
use App\Exports\CourseEnrollExport;
use Maatwebsite\Excel\Facades\Excel;


class EnrollController extends Controller
{
    public function index(Request $request){
        if($request->course){
            $enrolledCourses = CrCourseCart::with('course','UserDetails')->where('enroll_status','completed')->where('course_id',$request->course)->orderBy('id','desc')->paginate(10);
        }else{
            $enrolledCourses = CrCourseCart::with('course','UserDetails')->where('enroll_status','completed')->orderBy('id','desc')->paginate(10);
        }

        $no_of_courses = CrCourse::all();

        return view('course.admin.enroll.index',compact('enrolledCourses','no_of_courses'));
    }
    // export enrolled student list
    public function export() 
    {
        return Excel::download(new CourseEnrollExport, 'Enroll-Students.xlsx');
    }
}
