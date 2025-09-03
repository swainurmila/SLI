<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrStudentReview extends Model
{
    use HasFactory;

    public function userDetails(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function trainingDetails(){
        return $this->hasOne('App\Models\Training\TrTraining','id','training_id');
    }
}
