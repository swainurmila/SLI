<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrTransactionTable extends Model
{
    use HasFactory;

    protected $table = 'tr_transaction';

    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function Training(){
        return $this->hasOne('App\Models\Training\TrTraining','id','training_id');
    }
   
}
