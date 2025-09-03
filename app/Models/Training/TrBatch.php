<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrBatch extends Model
{
    use HasFactory;

    public function trainingOrder(){
        return $this->hasMany('App\Models\Training\TrTrainingOrder','batch_id','id');
    }

    public function training(){
        return $this->hasOne('App\Models\Training\TrTraining','id','training_id');
    }

    public function trainingDetails(){
        return $this->hasOne('App\Models\Training\TrTrainingDetail','batch_id','id');
    }

    public function checkTrainingDetailsData(){
        return $this->hasOne('App\Models\Training\TrTrainingDetail','batch_id','id')->where('start_date',">=",Carbon::today()->format('Y-m-d'));
    }

    public function trainingDetailsByBatch(){
        return $this->hasMany('App\Models\Training\TrTrainingDetail','batch_id','id');
    }

    public function trainingDetailsAccBatch(){
        $currentDate = Carbon::now();
        $currentDate = $currentDate->toDateString();
        return $this->hasOne('App\Models\Training\TrTrainingDetail','batch_id','id')->where('end_date',">=",$currentDate)->latest();
    }

    public function trainingClass(){
        return $this->hasMany('App\Models\Training\TrTrainingClass','batch_id','id');
    }
}
