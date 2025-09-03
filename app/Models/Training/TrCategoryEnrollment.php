<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TrCategoryEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'enrollment_start_date',
        'enrollment_end_date',
    ];


    public function trainingCategory(){
        return $this->hasOne('App\Models\Training\TrCategory','id','category_id');
    }


    // ->where('enrollment_end_date',">",Carbon::today()->format('Y-m-d'));
}
