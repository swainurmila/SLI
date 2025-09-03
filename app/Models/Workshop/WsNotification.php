<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WsNotification extends Model
{
    use HasFactory;

    protected $table = 'ws_notifications';

    protected $fillable = [
        'workshop_id',
        'notification_title',
        'start_date',
        'end_date',
        'created_by'
    ];

    public function Workshop(){
        return $this->hasOne('App\Models\Workshop\Workshop','id','workshop_id');
    }
}
