<?php

namespace App\Http\Controllers\Course\ExamUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrExam;
use Carbon\Carbon;
use App\Models\Course\CrNotification;
use App\Models\Course\CrExamAnswer;
use App\Models\Course\CrExamQuestions;
use Auth;
use App\Models\Course\CrStudentAppliedExam;

class OnlineExamController extends Controller
{
    public function index($id){

        $userId = Auth::user()->id;

        $examNotification = CrNotification::where('exam_id',$id)->first();

        // if($examNotification){
            
        //     $examAnswers = CrExamAnswer::where('user_id',$userId)->where('exam_id',$id)->where('course_id',$examNotification->course_id)->get();

        //     if(count($examAnswers) <= 0){
        //         $examQuestions = CrExamQuestions::where('exam_id',$id)->where('course_id',$examNotification->course_id)->get();
        //         if(count($examQuestions) > 0){
        //             foreach ($examQuestions as $key => $question) {
        //                 $examAns = new CrExamAnswer;
        //                 $examAns->course_id = $examNotification->course_id;
        //                 $examAns->exam_id = $id;
        //                 $examAns->user_id = $userId;
        //                 $examAns->question_id = $question->id;
        //                 $examAns->answer = null;
        //                 $examAns->save();
        //             }
        //         }
        //     }
        // }


        return view('course.examination.index',compact('id'));
    }

    public function examScreen($id){

        $data = CrExam::where('id', $id)->with(['Questions' => function($query) use ($id) {
            $query->select('*')->from('cr_total_questions')
                  ->join('cr_exam_questions', 'cr_total_questions.question_type', '=', 'cr_exam_questions.question_type')
                  ->where('cr_exam_questions.exam_id', $id);
        }, 'Questions.ExamQuestion.Options','Notification.ExamAnswers'])->first();


        if(!$data->Notification->ExamAnswers->isEmpty()){
            return redirect()->route('user.course.view-student-examination');
        }


        $studentAppliedExam = CrStudentAppliedExam::where('user_id', Auth::user()->id)->where('exam_notification_id', $data->Notification->id)->first();
        if($studentAppliedExam){
            $studentAppliedExam->user_id = Auth::user()->id;
            $studentAppliedExam->exam_notification_id = $data->Notification->id;
            $studentAppliedExam->attendance = 1;
            $studentAppliedExam->save();
        }else{
            return redirect()->route('user.course.view-student-examination');
        }


        return view('course.examination.exam-screen',compact('data','id'));
    }


    public function getExamInfo($id)
    {

        $exam = CrNotification::where('exam_id',$id)->first();

        if($exam){

            $exam_date = $exam->exam_date." ".$exam->exam_start_time;
            $examStartTime = Carbon::parse($exam_date)->toIso8601String();
            $examDuration = $exam->hours_needed;

            // $exam_date = '2024-07-19 11:09:00';
            // $examStartTime = Carbon::parse($exam_date)->toIso8601String();
            // $examDuration = 1;
    
            return response()->json([
                'examStartTime' => $examStartTime,
                'examDuration' => $examDuration,
            ]);
        }
    }

    public function submitAnswer(Request $request){

        $data = $request->all();


        foreach ($data as $key => $value) {
            if (is_numeric($key)) {

                $crExamAnswer = new CrExamAnswer;
                $crExamAnswer->user_id = $data['user_id'];
                $crExamAnswer->course_id = $data['course_id'];
                $crExamAnswer->exam_id = $data['exam_id'];
                $crExamAnswer->exam_notification_id = $data['exam_notification_id'];
                $crExamAnswer->question_id = $key;
                $crExamAnswer->answer = $value ?? null;
                $crExamAnswer->save();
            }
        }

        return redirect()->route('user.course.view-student-examination');
    }
}
