<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Training\TrCategory;

class TrTrainingOrder extends Model
{
    use HasFactory;

    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function training(){
        return $this->hasOne('App\Models\Training\TrTraining','id','training_id');
    }

    public function batch(){
        return $this->hasOne('App\Models\Training\TrBatch','id','batch_id');
    }

    public function trainingCategory(){
        return $this->hasOne('App\Models\Training\TrCategory','id','training_category_id');
    }

    public function trainingClasses(){
        return $this->hasMany('App\Models\Training\TrTrainingClass','training_details_id','training_details_id');
    }


    public function userTrainingDetails(){
        return $this->hasOne('App\Models\Training\TrTrainingDetail','id','training_details_id');
    }

    public function trainingDetails(){
        $currentDate = Carbon::now();
        $currentDate = $currentDate->toDateString();
        return $this->hasOne('App\Models\Training\TrTrainingDetail','id','training_details_id')->where('end_date' ,">=" ,$currentDate);
    }

    public function users(){
        return $this->hasOne('App\Models\User','id','created_by');
    }
    public function training_det(){
        return $this->hasOne('App\Models\Training\TrTrainingDetail','batch_id','batch_id');
    }
    
}
