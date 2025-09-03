<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course\CrCourse;
use App\Models\Course\CrCourseCart;
use DB;
use Auth;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    public function index(){

        $totalCourses = CrCourse::all();
        $enrolledCourses = CrCourseCart::where('enroll_status','completed')->get();
        $pendingUsers = User::getPendingCourseUsers();
        $rejectUsers = User::getRejectCourseUsers();


        // $user = Auth::user();
        // $role = Role::findByName('Course Admin');
        // $user->assignRole('Trainer');

        return view("course.admin.dashboard",compact('pendingUsers','rejectUsers','totalCourses','enrolledCourses'));
    }

    public function viewProfile(){

        $data = User::find(Auth::user()->id);

        $states = DB::table('states')->get();
        $cities =DB::table('cities')->where('state_id',Auth::user()->state_id)->get();


        return view('course.admin.view-profile',compact('data','states','cities'));
    }

    public function updateProfile(Request $request){

        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $request->id . '.' . $extension;
            $path = public_path('upload/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_photo/' . $filename;
        }else {
            $profile_photo = $request->profile_photo_old;
        }
       
        $update_user = User::where('id', Auth::user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' =>$request->user_name,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'profile_photo' => $profile_photo,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'contact_no'=>$request->contact_no
        ]);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }
}
