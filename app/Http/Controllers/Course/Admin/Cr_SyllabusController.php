<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrSyllabus;
use App\Models\Course\CrStudyMaterial;
use App\Models\Course\CrCourseAssignment;
use App\Models\Course\CrCoursePresentation;
use App\Models\Course\CrAssignmentAnswer;
use Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class Cr_SyllabusController extends Controller
{
    public function storeSyllabus(Request $request){
        try{
            $data = $this->validate($request, [
                'syllabus_title' => 'required',
            ]);

            $syllabus = new CrSyllabus();
            $syllabus->course_id = $request->cr_id;
            $syllabus->syllabus_title = $request->syllabus_title;
            $syllabus->save();

            Session::flash('success', 'Syllabus added successfully');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function editSyllabus(Request $request){
        try{

            $data = $this->validate($request, [
                'syllabus_title' => 'required',
            ]);
            $syllabus = CrSyllabus::where('id', $request->syl_id)->update(
                [
                    'syllabus_title' => $request->syllabus_title,
                ]
            );
            Session::flash('success', 'Syllabus added successfully');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //View Study Material
    public function viewStudyMaterial($id){
        try{
            $data = CrSyllabus::with('Note', 'Assignment.Answers', 'Presentation', 'Course')->where('id',$id)->first();
            return view('course.admin.course.study_material.index', compact('data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Store Study Material
    public function storeStudyMaterial(Request $request){
        try{
            $data = $this->validate($request, [
                'material_title'=>'required',
                'learning_material' => 'required|file|mimes:pdf,jpeg,png,gif|max:20971520',
            ]);
            //return $request;
            if ($file = $request->file('learning_material')) {
                $data = $request->file('learning_material');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'learning_material' . '.' . $extension;
                $path = public_path('/upload/course/learning_material/');
                $upload_success = $data->move($path, $filename);
                $upload_file = '/upload/course/learning_material/' . $filename;
            }
            $data = new CrStudyMaterial();
            $data->course_id = $request->cr_id;
            $data->syllabus_id = $request->syl_id;
            $data->material_title = $request->material_title;
            $data->material_file = $upload_file;
            $data->save();

            Session::flash('success', 'Study Material added successfully');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Delete Lecture Notes
    public function deleteLectureNotes(Request $request, $id){
        try{
            // return $id;
            $delete_note = CrStudyMaterial::where('id', $id)->delete();
            Session::flash('success', trans('Deleted Successfully'));
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Store Assignment
    public function storeCourseAssignment(Request $request){
        try{
            $data = $this->validate($request, [
                'assignment_title'=>'required',
                'question_type' => 'required',
                'question_level'=>'required',
                'start_date'=>'required',
                'last_submission_date'=>'required',
                'pass_score' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
                'question_file'=>'required|file|mimetypes:application/pdf,image/*|max:20971520',


            ]);
            //return $request;
            if ($file = $request->file('question_file')) {
                $data = $request->file('question_file');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'question_file' . '.' . $extension;
                $path = public_path('/upload/course/assignment_question/');
                $upload_success = $data->move($path, $filename);
                $assignment_file = '/upload/course/assignment_question/' . $filename;
            }
            $data = new CrCourseAssignment();
            $data->course_id = $request->cr_id;
            $data->syllabus_id = $request->syl_id;
            $data->assignment_title = $request->assignment_title;
            $data->question_type = $request->question_type;
            $data->question_level = $request->question_level;
            $data->start_submission_date = $request->start_date;
            $data->end_submission_date = $request->last_submission_date;
            $data->pass_score = $request->pass_score;
            $data->question_file = $assignment_file;

            $data->save();

            Session::flash('success','Assignment Added Successfully !');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //View Submitted Assignment
    public function viewSubmittedAssignment($id){
        try{
            $data = CrCourseAssignment::with('Answers.User')->where('id', $id)->first();
            return view("course.admin.course.study_material.submitted_answer", compact('data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    //Store assignment mark
    public function storeAssignmentMark(Request $request, $id){
        try{
            $result = $request->input('result');
            $user = $request->input('user');

            $answer = CrAssignmentAnswer::where('user_id', $user)
                                            ->where('assignment_id', $id)
                                            ->first();
            $assignment = CrCourseAssignment::where('id', $id)->first();
            if ($answer) {

                if($result > $assignment->pass_score){
                    Session::flash('error', 'Score cannot greater than pass score !');
                    return redirect()->back();
                }else{
                    $answer->result = $result;
                    $answer->save();
                }
            }
            return redirect()->back();

        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    // Store Course Presentation
    public function storeCoursePresentation(Request $request){
        try{
            $data = $this->validate($request, [
                'media_title' => 'required',
                'media_type' => 'required',
                'media_file' => 'required',

            ]);
            //return $request;
            if ($file = $request->file('media_file')) {
                $data = $request->file('media_file');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'media_file' . '.' . $extension;
                $path = public_path('/upload/course/presentation_file/');
                $upload_success = $data->move($path, $filename);
                $media_file = '/upload/course/presentation_file/' . $filename;
            }
            $data = new CrCoursePresentation();
            $data->course_id = $request->cr_id;
            $data->syllabus_id =  $request->syl_id;
            $data->media_title = $request->media_title;
            $data->media_type = $request->media_type;
            $data->media_file = $media_file;
            $data->save();

            Session::flash('success', 'Media file added successfully !');
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //Delete Presentations
    public function deletePresentation(Request $request, $id){
        try{
            $presentation = CrCoursePresentation::where('id', $id)->delete();
            Session::flash('success', trans('Deleted Successfully'));
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
