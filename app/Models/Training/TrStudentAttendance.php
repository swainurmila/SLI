<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrStudentAttendance extends Model
{
    use HasFactory;

    public function TrainingDetails(){
        return $this->hasOne('App\Models\Training\TrTrainingDetail','id','training_details_id');
    }

    public function ClassDetails(){
        return $this->hasOne('App\Models\Training\TrTrainingClass','id','class_id');
    }

    public function Batch(){
        return $this->hasOne('App\Models\Training\TrBatch','id','batch_id');
    }
}
