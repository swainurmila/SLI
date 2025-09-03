<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Workshop extends Model
{
    use HasFactory;
    protected $table = 'workshop';

    public function UserCourseCart(){
        return $this->hasOne('App\Models\Workshop\WsAddToCart','workshop_id','id')->where('user_id',Auth::user()->id);
    }
    public function schedule(){
        return $this->hasOne('App\Models\Workshop\WsSchedule','workshop_id','id');
    }
    public function allSchedule(){
        return $this->hasMany('App\Models\Workshop\WsSchedule','workshop_id','id');
    }
   
    
}
