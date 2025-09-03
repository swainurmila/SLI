<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrExamQuestions extends Model
{
    use HasFactory;
    protected $table = 'cr_exam_questions';
   
    public function Options(){
        return $this->hasMany('App\Models\Course\CrQuestionOptions', 'question_id', 'id');
    }
}
