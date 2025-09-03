<?php

namespace App\Http\Controllers\workshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Workshop\WsAddToCart;
use App\Models\Workshop\WsSchedule;
use Illuminate\Support\Facades\Hash;
use Session;

class Ws_profileController extends Controller
{


    public function enrolledList(){
        $enrolledCourses = WsAddToCart::getEnrolledCourseLists();


        return view('workshop.user.profile.enrolled-workshop',compact('enrolledCourses'));
    }

    public function viewSchedule(Request $request ,$id){
        try{
            // return $request;
            $schedule = WsSchedule::where('workshop_id', $id)->get();
            // dd($syllabus);
            return view("workshop.user.schedule.schedule_view", compact('schedule'));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function settingInfo(){
        $user = User::find(Auth::user()->id);
        return view('workshop.user.profile.settings',compact('user'));
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
}
