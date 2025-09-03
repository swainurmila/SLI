<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class WsSchedule extends Model
{
    use HasFactory;
    protected $table = 'ws_schedule';
    public function Workshop(){
        return $this->hasOne('App\Models\Workshop\Workshop','id','workshop_id');
    }
    public function attendance(){
        return $this->hasMany('App\Models\Workshop\WsAttendance','schedule_id','id');
    }
    public function enrollDetails(){
        return $this->hasMany('App\Models\Workshop\WsAddToCart','workshop_id','workshop_id');
    }
    public function userAttendance(){
        return $this->hasOne('App\Models\Workshop\WsAttendance','schedule_id','id')->where('student_id',Auth::user()->id);
    }
    // public function schedule(){
    //     return $this->hasOne('App\Models\Workshop\WsSchedule','workshop_id','id');
    // }
}
