<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrSubject extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'course_id',
        'created_by'
    ];

    public function Course(){
        return $this->hasOne('App\Models\Training\TrCourse','id','course_id');
    }
}
