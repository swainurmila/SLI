<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrTransactionTable extends Model
{
    use HasFactory;

    protected $table = 'cr_transaction';

    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
    public function Course(){
        return $this->hasOne('App\Models\Course\CrCourse','id','course_id');
    }
}
