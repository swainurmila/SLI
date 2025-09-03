<?php

namespace App\Models\Research;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RpSubmittedPaper extends Model
{
    use HasFactory;


    public function user(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

}
