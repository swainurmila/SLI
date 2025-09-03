<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;

class TrClassAssignment extends Model
{
    use HasFactory;

    public function assignmentAnswer(){
        return $this->hasOne('App\Models\Training\TrAssignmentAnswer','assignment_id','id')->where('user_id',Auth::user()->id);
    }
}
