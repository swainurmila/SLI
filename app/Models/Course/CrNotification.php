<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class CrNotification extends Model
{
    use HasFactory;
    protected $table = 'cr_notification';
    protected $fillable = [
        'course_id',
        'exam_id',
        'exam_date',
        'exam_location',
        'start_date',
        'end_date',
        'created_by'
    ];

    public function Course(){
        return $this->hasOne('App\Models\Course\CrCourse','id','course_id');
    }
    public function Exam(){
        return $this->hasOne('App\Models\Course\CrExam','id','exam_id');
    }

    public function ExamAnswers(){
        return $this->hasMany('App\Models\Course\CrExamAnswer','exam_id','exam_id')->where('user_id',Auth::user()->id);
    }

    public function Result(){
        return $this->hasOne('App\Models\Course\CrStudentAppliedExam','exam_notification_id','id')->where('user_id',Auth::user()->id);
    }

}
