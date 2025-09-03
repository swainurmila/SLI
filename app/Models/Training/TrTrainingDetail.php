<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrTrainingDetail extends Model
{
    use HasFactory;

    public function training(){
        return $this->hasOne('App\Models\Training\TrTraining','id','training_id');
    }

    public function batch(){
        return $this->hasOne('App\Models\Training\TrBatch','id','batch_id');
    }

    public function trainingOrders(){
        return $this->hasMany('App\Models\Training\TrTrainingOrder','training_details_id','id');
    }
    public function trainingOrder(){
        return $this->hasMany('App\Models\Training\TrTrainingOrder','training_id','training_id');
    }

    public function trainingClasses(){
        return $this->hasMany('App\Models\Training\TrTrainingClass','training_details_id','id');
    }
    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }


}
