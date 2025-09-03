<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrPlaceMaster extends Model
{
    use HasFactory;
    protected $table = 'cr_place_master';
    protected $fillable = [
        'name',
        'description',
        'created_by'
    ];
}
