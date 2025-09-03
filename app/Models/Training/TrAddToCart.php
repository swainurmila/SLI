<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrAddToCart extends Model
{
    use HasFactory;

    public function trainingImage(){
        return $this->hasOne('App\Models\Training\TrainingImages','training_id','training_id');
    }

    public function training(){
        return $this->hasOne('App\Models\Training\TrTraining','id','training_id');
    }
}
