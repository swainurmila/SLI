<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibTransaction extends Model
{
    use HasFactory;
    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function Book(){
        return $this->hasOne('App\Models\Book','id','book_id');
    }
}
