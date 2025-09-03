<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrExamAnswer extends Model
{
    use HasFactory;

    public function question(){
        return $this->hasOne('App\Models\Course\CrExamQuestions','id','question_id');
    }

}
