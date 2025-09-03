<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrSyllabus extends Model
{
    use HasFactory;
    protected $table = 'cr_syllabus';

    public function Note(){
        return $this->hasMany('App\Models\Course\CrStudyMaterial','syllabus_id','id');
    }

    public function Assignment(){
        return $this->hasMany('App\Models\Course\CrCourseAssignment','syllabus_id','id');
    }

    public function Presentation(){
        return $this->hasMany('App\Models\Course\CrCoursePresentation','syllabus_id','id');
    }
    public function Class(){
        return $this->hasMany('App\Models\Course\CrSyllabusClass','syllabus_id','id');
    }
    public function Course(){
        return $this->hasOne('App\Models\Course\CrCourse','id','course_id');
    }
}
