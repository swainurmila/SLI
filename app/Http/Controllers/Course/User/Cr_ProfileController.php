<?php

namespace App\Http\Controllers\Course\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCourseCart;
use App\Models\Course\CrCourse;
use App\Models\Course\CrSyllabus;
use App\Models\Course\CrAssignmentAnswer;
use Auth;
use App\Models\User;
use Session;

class Cr_ProfileController extends Controller
{
    public function enrolledList(){
        $enrolledCourses = CrCourseCart::getEnrolledCourseLists();


        return view('course.user.profile.enrolled-course',compact('enrolledCourses'));
    }

    public function settingInfo(){
        $user = User::find(Auth::user()->id);
        return view('course.user.profile.settings',compact('user'));
    }

    public function settingInfoUpdate(Request $request){
        $user = User::find(Auth::user()->id);

        $oldPasswordHash = $user->password;
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'user_name'=>'required',
            'email'=>'required',
            'contact_no'=>'required',
            'present_address'=>'required',
            'new_password' => [
                'required_with:new_password|string|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@$!%*#?&]/',
            ],
            'confirm_password' => 'required_with:new_password|same:new_password',
            'current_password' => 'required_with:new_password'
        ], [
            'new_password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
            'confirm_password.same' => 'The confirm password must match the password.',
            'current_password.required_with' => 'The current password field is required.',
        ]);


        if(isset($request->current_password) || isset($request->new_password)){

            if (!Hash::check($request->current_password, $oldPasswordHash)) {
                throw ValidationException::withMessages(['current_password' => 'Current password is not matched with old password.']);
            }else{
                $user->password = bcrypt($request->new_password);
            }
           
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->present_address = $request->present_address;
        $user->contact_no = $request->contact_no;
        $user->save();

        Session::flash('success','Profile info Successfully Updated !');
        return redirect()->back();
    }

    //View Course Syllabus
    public function viewCourseSyllabus($id){
        try{
        $syllabus = CrCourse::with('Syllabus')->where('id', $id)->first();
            // dd($syllabus);
            return view("course.user.syllabus.view_syllabus", compact('syllabus'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    //View enrolled class
    public function viewEnrolledClass($id){
        try{
            $classes = CrCourse::with('Class')->where('id', $id)->first();
            return view("course.user.class.view_class", compact('classes'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function viewStudyMaterial($id){
        try{
            //return Auth::user()->id;
              $data = CrSyllabus::with('Note', 'Assignment.Answer', 'Presentation')
             ->where('id', $id)
            //  ->whereHas('Assignment.Answer', function($query) {
            //      $query->where('user_id', Auth::user()->id);
            //  })
             ->first();
         
            return view("course.user.class.view_study_material", compact('data'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function storeAssignmentAnswer(Request $request, $id){
        try{
            //return Auth::user()->id;
            if ($file = $request->file('answer_file')) {
                $data = $request->file('answer_file');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'answer_file' . '.' . $extension;
                $path = public_path('/upload/course/assignment-answer/');
                $upload_success = $data->move($path, $filename);
                $answer_file = '/upload/course/assignment-answer/' . $filename;


                $answer = new CrAssignmentAnswer();
                $answer->course_id = $request->course_id;
                $answer->syllabus_id = $request->syllabus_id;
                $answer->assignment_id = $request->assignment_id;
                $answer->user_id = Auth::user()->id;
                $answer->assignment_answer = $answer_file;
                $answer->save();
    
                Session::flash('success','Answer Submitted Successfully!');
                return redirect()->back();
            }else{
                Session::flash('error','Please upload your answer sheet !');
                return redirect()->back();
            }
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    
}
