<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrAttendance extends Model
{
    use HasFactory;
    protected $table = 'cr_attendance';

    public function Course(){
        return $this->hasOne('App\Models\Course\CrCourse','id','course_id');
    }
    public function Class(){
        return $this->hasOne('App\Models\Course\CrSyllabusClass','id','class_id');
    }
}
