<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class CrCourse extends Model
{
    use HasFactory;
    protected $table = 'cr_course';

    public static function getCourseLists()
    {
        return self::with('CourseCart')->orderBy('id','desc')->paginate(9);

    }

    public static function getCourseDetails($id)
    {
        return self::with('Category','Language','CourseCart','CourseEnrolled', 'Syllabus', 'Syllabus.Class')->find($id);

    }
    public function CourseEnrolled(){
        return $this->hasMany('App\Models\Course\CrCourseCart','course_id','id')->where('enroll_status','completed');
    }

    public function UserCourseCart(){
        return $this->hasOne('App\Models\Course\CrCourseCart','course_id','id')->where('user_id',Auth::user()->id);
    }

    public function CourseCart(){
        return $this->hasOne('App\Models\Course\CrCourseCart','course_id','id')->where('user_id',Auth::user()->id);
    }

    public function Place(){
        return $this->hasOne('App\Models\Course\CrPlaceMaster','id','place');
    }

    public function Syllabus(){
        return $this->hasMany('App\Models\Course\CrSyllabus','course_id','id');
    }

    public function Module(){
        return $this->hasOne('App\Models\Course\CrSyllabus','course_id','id');
    }

    public function Category(){
        return $this->hasOne('App\Models\Course\CrCategoryMaster','id','course_category_id');
    }

    public function Language(){
        return $this->hasOne('App\Models\Language','id','language_id');
    }

    public function Ratings(){
        return $this->hasMany('App\Models\Course\CrCourseRating','course_id','id');
    }

    public function Exam(){
        return $this->hasMany('App\Models\Course\CrExam','course_id','id');
    }

    public function Question(){
        return $this->hasMany('App\Models\Course\CrExamQuestions','course_id','id');
    }
    public function Class(){
        return $this->hasMany('App\Models\Course\CrSyllabusClass','course_id','id');
    }
    public function AttendClass(){
        return $this->hasOne('App\Models\Course\CrSyllabusClass','course_id','id');
    }
   
}
