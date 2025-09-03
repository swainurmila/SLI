<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Training\TrStudentReview;
use App\Models\Training\TrAssignmentAnswer;
use Auth;
use Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        // $user = User::with('trainingOrders')->where('id',Auth::user()->id)->first();


     $user = User::with([
            'trainingOrders.batch.training.TrainingImage',
            'trainingOrders.batch.training.TrainingReviews',
            'trainingOrders.trainingClasses',
            'trainingOrders.trainingCategory',
            'trainingOrders.userTrainingDetails',
            'trainingOrders.batch.trainingDetailsByBatch' => function ($query) {
                $query->whereHas('trainingClasses.trainingAttendance', function ($subquery) {
                    $subquery->where('attendance_type', '1');
                })->with(['trainingClasses' => function ($query) {
                    $query->with(['trainingAttendance' => function ($subquery) {
                        $subquery->where('attendance_type', '1');
                    }]);
                }]);
            },
        ])
        ->orderBy('id','desc')
        ->where('id', Auth::user()->id)
        ->first();

        return view('training.traininguser.profile.index',compact('user'));
    }


    public function enrolledCourses(){
        // $user = User::with('trainingOrders.batch.training.TrainingImage','trainingOrders.batch.trainingDetails','trainingOrders.batch.trainingClass.trainingAttendance')->where('id',Auth::user()->id)->first();

        // $user = User::with([
        //     'trainingOrders.batch.training.TrainingImage',
        //     // 'trainingOrders.batch.trainingDetailsByBatch.trainingClasses.trainingAttendance',
        //     'trainingOrders.batch.trainingDetailsByBatch' => function ($query) {
        //         $query->with([
        //             'trainingClasses' => function ($query) {
        //                 $query->with(['trainingAttendance' => function ($query) {
        //                     $query->where('attendance_type', '1');
        //                 }]);
        //             },
        //         ]);
        //     },
        // ])
        // ->where('id', Auth::user()->id)
        // ->first();

        //return Auth::user()->id;
         $user = User::with([
            'trainingOrders.batch.training.TrainingImage',
            'trainingOrders.batch.training.TrainingReviews',
            'trainingOrders.trainingClasses',
            'trainingOrders.trainingCategory',
            'trainingOrders.userTrainingDetails',
            'trainingOrders.batch.trainingDetailsByBatch' => function ($query) {
                $query->whereHas('trainingClasses.trainingAttendance', function ($subquery) {
                    $subquery->where('attendance_type', '1');
                })->with(['trainingClasses' => function ($query) {
                    $query->with(['trainingAttendance' => function ($subquery) {
                        $subquery->where('attendance_type', '1');
                    }]);
                }]);
            },
        ])
        ->orderBy('id','desc')
        ->where('id', Auth::user()->id)
        ->first();


        // if($user->trainingOrders->batch && count($user->trainingOrders->batch->trainingClass) > 0){
        //     $totalClasses = 0;
        //     $totalAttendanceCount = $user->trainingOrders->reduce(function ($count, $trainingOrder) {
        //         foreach ($trainingOrder->batch->trainingClass as $trainingClass) {
        //             if ($trainingClass->trainingAttendance) {
        //                 foreach ($trainingClass->trainingAttendance as $attendance) {
        //                     if ($attendance->attendance_type == '1') {
        //                         $count++;
        //                     }
        //                 }
        //             }
        //         }
        //         return $count;
        //     }, 0);


        //     $classCompletedPercentage = ($totalAttendanceCount / count($user->trainingOrders->batch->trainingClass)) * 100;
        // }else{
        //     $classCompletedPercentage = 0 ;
        // }

            // dd($user);
        return view('training.traininguser.profile.enrolled-course',compact('user'));
    }

    public function feedback(){
        $feedbacks = TrStudentReview::with('trainingDetails')->where('user_id',Auth::user()->id)->paginate(5);
        return view('training.traininguser.profile.feedbacks',compact('feedbacks'));
    }

    public function feedbackDestroy($id){
        $feedbacks = TrStudentReview::find($id)->delete();
        Session::flash('success','Review Successfully Removed !');
        return redirect()->back();


    }

    public function settingInfo(){
        $user = User::find(Auth::user()->id);
        return view('training.traininguser.profile.settings',compact('user'));
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

        Session::flash('success','Info Successfully Updated !');
        return redirect()->back();


    }


    public function submitAssignment(Request $request){

        try {

            $validator = Validator::make($request->all(), [
                'file' => 'required|file|max:5120',
            ]);


            if ($validator->fails()) {
                return redirect()->back()->with('error', $validator->errors()->first())->withInput();
            }


            $file = $request->file('file');
            $fileName = time() . '.' .$file->extension();
            $file->move(public_path('uploads/assignment-answer'), $fileName);

            $assignment_answer = new TrAssignmentAnswer;
            $assignment_answer->class_id = $request->class_id;
            $assignment_answer->assignment_id = $request->assignment_id;
            $assignment_answer->training_details_id = $request->training_details_id;
            $assignment_answer->batch_id = $request->batch_id;
            $assignment_answer->assignment_answer = $fileName;
            $assignment_answer->user_id = Auth::user()->id;

            $assignment_answer->save();
            return redirect()->back()->with('success', 'File has been uploaded successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            Session::flash('error','Something wents wrong!');
            return redirect()->back();
        }
    }
}
