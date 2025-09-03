<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
class CrExam extends Model
{
    use HasFactory;
    protected $table = 'cr_examination';

    public function Questions(){
        return $this->hasMany('App\Models\Course\CrTotalQuestion','exam_id','id');
    }
    public function AllQuestions(){
        return $this->hasMany('App\Models\Course\CrExamQuestions','exam_id','id');
    }
    public function Notification(){
        return $this->hasOne('App\Models\Course\CrNotification','exam_id','id');
    }
    public function Course(){
        return $this->hasOne('App\Models\Course\CrCourse','id','course_id');
    }
    public function CourseCart(){
        return $this->hasOne('App\Models\Course\CrCourseCart','course_id','course_id')->where('user_id',Auth::user()->id);
    }
    public function CrCart(){
        return $this->hasOne('App\Models\Course\CrCourseCart','course_id','course_id')->where('user_id',Auth::user()->id)->where('enroll_status', 'completed');
    }
}
