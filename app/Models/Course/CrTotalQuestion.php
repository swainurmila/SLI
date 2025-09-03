<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrTotalQuestion extends Model
{
    use HasFactory;
    protected $table = 'cr_total_questions';
    public function ExamQuestion(){
        return $this->hasMany('App\Models\Course\CrExamQuestions','exam_id','exam_id');
    }

}
