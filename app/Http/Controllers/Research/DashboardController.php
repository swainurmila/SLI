<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
use App\Models\Research\RpSubmittedPaper;
use App\Models\User;
use DB;


class DashboardController extends Controller
{
    public function dashboard(){

        // $user = Auth::user();
        // $role = Role::findByName('Research Admin');
        // $user->assignRole('Research User');

        if(Auth::user()->role_id == 12){
            $total_papers = RpSubmittedPaper::count();
            $published_papers = RpSubmittedPaper::where('is_publish','1')->count();
        }else{
            $total_papers = RpSubmittedPaper::where('user_id',Auth::user()->id)->count();
            $published_papers = RpSubmittedPaper::where('user_id',Auth::user()->id)->where('is_publish','1')->count();
        }
        return view('research.admin.dashboard',compact('total_papers','published_papers'));
    }


    public function viewProfile(){
        $data = User::find(Auth::user()->id);

        $states = DB::table('states')->get();
        $cities =DB::table('cities')->where('state_id',Auth::user()->state_id)->get();

        return view('research.profile',compact('data','states','cities'));
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
