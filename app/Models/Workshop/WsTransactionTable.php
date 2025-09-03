<?php

namespace App\Models\Workshop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WsTransactionTable extends Model
{
    use HasFactory;
    protected $table = 'ws_transaction';

    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function Workshop(){
        return $this->hasOne('App\Models\Workshop\Workshop','id','workshop_id');
    }
}
