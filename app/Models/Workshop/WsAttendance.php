<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class WsAttendance extends Model
{
    use HasFactory;
    protected $table = 'ws_attendance';

    public function user(){
        return $this->hasOne(User::class, 'id', 'student_id');
    }
    public function Workshop(){
        return $this->hasOne('App\Models\Workshop\Workshop','id','workshop_id');
    }
    public function Schedule(){
        return $this->hasOne('App\Models\Workshop\WsSchedule','id','schedule_id');
    }
}
