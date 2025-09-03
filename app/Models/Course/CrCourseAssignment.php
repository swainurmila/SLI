<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class CrCourseAssignment extends Model
{
    use HasFactory;
    protected $table = 'cr_course_assignment';

    public function Answer(){
        return $this->hasOne('App\Models\Course\CrAssignmentAnswer','assignment_id','id')->where('user_id', Auth::user()->id);
    }
    public function Answers(){
        return $this->hasMany('App\Models\Course\CrAssignmentAnswer','assignment_id','id');
    }
}
