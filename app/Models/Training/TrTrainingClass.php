<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class TrTrainingClass extends Model
{
    use HasFactory;

    public function training(){
        return $this->hasOne('App\Models\Training\TrTraining','id','training_id');
    }

    public function batch(){
        return $this->hasOne('App\Models\Training\TrBatch','id','batch_id');
    }


    public function trainingDetail(){
        return $this->hasOne('App\Models\Training\TrTrainingDetail','id','training_details_id');
    }

    public function trainingAttendance(){
        return $this->hasOne('App\Models\Training\TrStudentAttendance','class_id','id')->where('student_id',Auth::user()->id);
    }

    public function meetingDetails(){
        return $this->hasOne('App\Models\Training\TrMeetingDetail','class_id','id')->where('meeting_for', 'training');
    }

    public function trainerDetails(){
        return $this->hasOne('App\Models\User','id','trainer_user_id');
    }
}
