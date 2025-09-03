<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrAssignmentAnswer extends Model
{
    use HasFactory;
    protected $table = 'cr_assignment_answer';
    public function User(){
        return $this->hasOne('App\Models\User','id','user_id');
    }
}
