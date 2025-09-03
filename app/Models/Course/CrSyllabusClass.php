<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrSyllabusClass extends Model
{
    use HasFactory;

    public function trainerDetails(){
        return $this->hasOne('App\Models\User','id','trainer_user_id');
    }

    public function courseDetails(){
        return $this->hasOne('App\Models\Course\CrCourse','id','course_id');
    }

    public function meetingDetails(){
        return $this->hasOne('App\Models\Training\TrMeetingDetail', 'class_id', 'id')->where('meeting_for','course');
    }

    public function enrollDetails(){
        return $this->hasMany('App\Models\Course\CrCourseCart', 'course_id', 'course_id')->where('enroll_status','completed');
    }

    public function Attendance(){
        return $this->hasMany('App\Models\Course\CrAttendance', 'class_id', 'id');
    }
}
