<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrStudentAppliedExam extends Model
{
    use HasFactory;

    public function notification(){
        return $this->hasOne('App\Models\Course\CrNotification','id','exam_notification_id');
    }

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

   
    
}
