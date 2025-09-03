<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrAssignmentAnswer extends Model
{
    use HasFactory;

    public function trainingBatch(){
        return $this->hasOne('App\Models\Training\TrBatch','id','batch_id');
    }

    public function trainingClass(){
        return $this->hasOne('App\Models\Training\TrTrainingClass','id','class_id');
    }

    public function trainingUser(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
