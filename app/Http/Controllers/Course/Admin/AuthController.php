<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Training\StudentRegister;
use Auth;
use Session;

class AuthController extends Controller
{
    public function showLogin(){
        return view('course.auth.login');
    }

    public function attemptLogin(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
            'captcha' => ['required', 'captcha'],
        ]);


        $credentials = $request->only('email', 'password');

        $user = User::where('email', $request->email)->first();


        if($user){

            if($user->status == '0'){
                Session::flash('error','Your account is not activated yet please try again later !');
                return redirect()->back();
            }

            if($user->status == '2'){
                Session::flash('error','Your account is rejected');
                return redirect()->back();
            }

            if($user && Hash::check($request->password, $user->password)){
                if ($user->status == 1 && $user->role_id == 5 && $user->is_course == 1) {
                    // Attempt to log in the training
                    if (Auth::attempt($credentials,$request->filled('remember'))) {
                        return redirect()->route('user.course.home')
                                    ->withSuccess('You have Successfully Logged in');
                    }else{
                        Session::flash('error','Oppes ! You have entered invalid credentials');
                        return redirect()->back();
                    }
                }else if($user->status == 1 && $user->role_id == 4 && $user->is_course == 1){
                    if (Auth::attempt($credentials,$request->filled('remember'))) {
                        return redirect()->route('admin.course.dashboard')
                                    ->withSuccess('You have Successfully Logged in');
                    }else{
                        Session::flash('error','Oppes ! You have entered invalid credentials');
                        return redirect()->back();
                    }
                }else if($user->status == 1 && $user->role_id == 6 && $user->is_course == 1){
                    if (Auth::attempt($credentials,$request->filled('remember'))) {
                        return redirect()->route('admin.course.dashboard')
                                    ->withSuccess('You have Successfully Logged in');
                    }else{
                        Session::flash('error','Oppes ! You have entered invalid credentials');
                        return redirect()->back();
                    }
                }else{
                    Session::flash('error','Oppes ! You have entered invalid credentials');
                    return redirect()->back();
                }
            }else{
                Session::flash('error','Account not created yet or invalid credentials');
                return redirect()->back();
            }
        }else{
            Session::flash('error','Oppes ! You have entered invalid credentials');
            return redirect()->back();
        }
    }

    public function create(){
        return view('course.auth.register');
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_photo' => 'required|file|mimes:jpeg,png|max:1024',
        ]);




        $unique_no = User::orderBy('id', 'DESC')->pluck('id')->first();
        if ($unique_no == null or $unique_no == "") {
            $unique_no = 1;
        } else {
            $unique_no = $unique_no + 1;
        }

        if ($file = $request->file('profile_photo')) {
        $data = $request->file('profile_photo');
        $extension = $data->getClientOriginalExtension();
        $filename = time() . 'profile_photo' . $unique_no . '.' . $extension;
        $path = public_path('upload/user_profile_photo/');
        $upload_success = $data->move($path, $filename);
        $profile_photo = '/upload/user_profile_photo/' . $filename;
        }
        //return $profile_photo;
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->state_id = $request->input('state_id');
        $user->district_id = $request->input('district_id');
        $user->present_address = $request->input('present_address');
        $user->permanent_address = $request->input('permanent_address');
        $user->profile_photo = $profile_photo;
        $user->role = 'User';
        $user->role_id = 5;
        $user->is_training = '0';
        $user->is_course = '1';

        $user->password = Hash::make($request->input('password'));

        $user->save();

        if($user->save()){
            $user->assignRole('User');
            $email = $request->input('email');
                $mailData = [
                    'username' => $request->input('email'),
                    'msg' => 'you have successfully registered your credentials is',
                    'password'=> $request->input('password'),
                ];
                // return $mailData;
            Mail::to($email)->send(new StudentRegister($mailData));

            return redirect()->route('course.login.show')
            ->with('success', 'User Registered Successfully');
        }else{
            return redirect()->back()
            ->with('error', "Something went's wrong !");
        }

    }
    public function adminLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('course.login.show');
    }
}
