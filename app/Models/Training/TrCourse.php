<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_desc',
        'categories_id',
        'created_by'
    ];

    
}
