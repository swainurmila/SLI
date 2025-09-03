<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrCourseRating extends Model
{
    use HasFactory;

    public function userDetails(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function courseDetails(){
        return $this->hasOne('App\Models\Course\CrCourse','id','course_id');
    }
}
