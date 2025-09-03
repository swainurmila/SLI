<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\User;
use Carbon\Carbon;

class CrCourseCart extends Model
{
    use HasFactory;

    public static function getCheckoutCourseLists()
    {
        return self::with('course')->where('user_id',Auth::user()->id)->where('enroll_status','pending')->orderBy('id','desc')->get();
    }

    public static function getEnrolledCourseLists()
    {
        return self::with('course')->where('user_id',Auth::user()->id)->where('enroll_status','completed')->orderBy('id','desc')->get();
    }

    public static function removeEnrolledCourse($id)
    {
        return self::find($id)->delete();
    }


    public function course() {
        return $this->hasOne(CrCourse::class, 'id', 'course_id');
    }

    public function UserDetails() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function UserData() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function courseNotification(){
        return $this->hasMany('App\Models\Course\CrNotification','course_id','course_id')->where('end_date', '>', Carbon::today());
    }
    public function Exam() {
        return $this->hasMany('App\Models\Course\CrExam','course_id','course_id');
    }
    

    
}
