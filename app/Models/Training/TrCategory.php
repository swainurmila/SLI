<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by'
    ];

    public function trainings(){
        return $this->hasMany('App\Models\Training\TrTraining','training_category_id','id');
    }

    public function trainingEnrollment(){
        return $this->hasOne('App\Models\Training\TrCategoryEnrollment','category_id','id')->orderBy('id','desc');
    }
}
