<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrTotalQuestion;
use App\Models\Course\CrExam;
use App\Models\Course\CrExamQuestions;
use App\Models\Course\CrQuestionOptions;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Cr_ExamController extends Controller
{
    public function examTotalQuestions(Request $request){
        try {
            //return $request;
            $data = $this->validate($request, [
                'exam_mode' => 'required',
                'exam_title' => 'required',
                'total_mark' => 'required',
                'passing_mark' => 'required',
            ]); 
            if($request->exam_mode == 'online'){
                $data = $this->validate($request, [
                    'multiple_qs' => 'required',
                    'long_qs' => 'required',
                    'short_qs' => 'required',
                ]); 
            }
            $courseId = $request->cr_id;
            $questionTypes = [
                1 => $request->multiple_qs,
                2 => $request->long_qs,
                3 => $request->short_qs,
            ];
            $exam = new CrExam();
            $exam->course_id = $courseId;
            $exam->exam_title = $request->exam_title;
            $exam->exam_mode = $request->exam_mode;
            $exam->exam_mark = $request->total_mark;
            $exam->passing_mark = $request->passing_mark;
            $exam->save();
            foreach ($questionTypes as $questionType => $numberOfQuestions) {
                if ($numberOfQuestions) {
                    $data = new CrTotalQuestion();
                    $data->course_id = $courseId;
                    $data->exam_id = $exam->id;
                    $data->question_type = $questionType;
                    $data->no_of_questions = $numberOfQuestions;
                    $data->save();
                }
            }
    
            Session::flash('success', trans('Number of questions added successfully'));
            return redirect()->back();
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Add Questions
    public function examAddQuestions($id){
        try{
             $data = CrExam::with('Questions')->where('id', $id)->first();
            return view("course.admin.exam.create_questions", compact('data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Store Questions
    public function examStoreQuestions(Request $request){
        try{
            //return $request;
            if ($request->has('no_of_multiple_question') && $request->no_of_multiple_question) {
                for ($i = 1; $i <= $request->no_of_multiple_question; $i++) {
                    $data = new CrExamQuestions;
                    $data->course_id = $request->course_id;
                    $data->exam_id = $request->exam_id;
                    $data->question_type = 1;
                    $data->question = $request->input("multiple_question_$i");
                    $data->save();
                    //$questions[] = $request->input("multiple_question_$i");
                    //return $data->id;
                    for ($j = 1; $j <= 4; $j++) {
                        $qs_option = new CrQuestionOptions;
                        $qs_option->course_id = $request->course_id;
                        $qs_option->exam_id = $request->exam_id;
                        $qs_option->question_id = $data->id;
                        $qs_option->option_title = $request->input("option_${i}_${j}");
                        $qs_option->save();
                        $options[] = $request->input("option_${i}_${j}");
                    }
                }
            }
            if ($request->has('no_of_long_question') && $request->no_of_long_question) {
                for ($i = 1; $i <= $request->no_of_long_question; $i++) {
                        // $questions[] = $request->input("long_question_$i");
                        $long_qs = new CrExamQuestions;
                        $long_qs->course_id = $request->course_id;
                        $long_qs->exam_id = $request->exam_id;
                        $long_qs->question_type = 2;
                        $long_qs->question = $request->input("long_question_$i");
                        $long_qs->save();
                }
                
            }
            if ($request->has('no_of_short_question') && $request->no_of_short_question) {
                for ($i = 1; $i <= $request->no_of_short_question; $i++) {
                        // $questions[] = $request->input("short_question_$i");
                        $short_qs = new CrExamQuestions;
                        $short_qs->course_id = $request->course_id;
                        $short_qs->exam_id = $request->exam_id;
                        $short_qs->question_type = 3;
                        $short_qs->question = $request->input("short_question_$i");
                        $short_qs->save();
                }
                
            }
            Session::flash('success', trans('Number of questions added successfully'));
            return redirect()->route('course.admin.course-view', ['id' => $request->course_id]);
            
            
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //edit question
    public function examEditQuestions($id){
        try{
                $data = CrExam::with('Questions.ExamQuestion.Options')->where('id', $id)->first();

                // dd($data);
            return view("course.admin.exam.edit_questions", compact( 'data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //update questions
    public function examUpdateQuestions(Request $request, $id){

        try{
            
            if($request->no_of_multiple_question > 0){

                $count = 0;
                foreach ($request->multiple_question_id as $key => $questionId) {
                    $question = CrExamQuestions::findOrFail($questionId);
                    $question->question = $request->multiple_question[$key];
                    $question->save();
                    if ($request->has('option')) {
                        $options = array_slice($request->option, $key * 4, 4, true);
                        $questionOptions = CrQuestionOptions::where('question_id',$questionId)->get();
                        foreach ($questionOptions as $key1 => $value) {
                            $value->option_title = $options[$count];
                            $value->save();
                            $count++;
                        }
                    }
                }
            }

            if($request->no_of_long_question > 0){
                for($i=0;$i < $request->no_of_long_question ; $i++){
                    $question = CrExamQuestions::where('id',$request->long_question_id[$i])->first();
                    $question->question = $request->long_question[$i];
                    $question->save();
                    
                }
            }

            if($request->no_of_short_question > 0){
                for($i=0;$i < $request->no_of_short_question ; $i++){
                    $question = CrExamQuestions::where('id',$request->short_question_id[$i])->first();
                    $question->question = $request->short_question[$i];
                    $question->save();
                    
                }
            }

            Session::flash('success', trans('Number of questions edited successfully'));
            return redirect()->route('course.admin.course-view', ['id' => $request->course_id]);;
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //View Questions
    public function examViewQuestions($id){
        try{
             $data = CrExam::where('id', $id)->with(['Questions' => function($query) use ($id) {
                $query->select('*')->from('cr_total_questions')
                      ->join('cr_exam_questions', 'cr_total_questions.question_type', '=', 'cr_exam_questions.question_type')
                      ->where('cr_exam_questions.exam_id', $id);
            }, 'Questions.ExamQuestion.Options'])->first();



            // dd($data->Questions);

            return view("course.admin.exam.view_questions", compact( 'data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    
}