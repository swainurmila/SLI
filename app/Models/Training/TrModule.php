<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrModule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'created_by'
    ];
}
