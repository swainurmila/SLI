<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WsWorkshopRating extends Model
{
    use HasFactory;
    protected $table = 'ws_workshop_ratings';
    public function userDetails(){
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function workshopDetails(){
        return $this->hasOne('App\Models\Workshop\Workshop','id','workshop_id');
    }


}
