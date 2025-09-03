<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Session;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\Training\StudentRegister;

class AuthController extends Controller
{
    public function showLogin(){
        return view('research.auth.login');
    }

    public function attemptLogin(Request $request){

        $rules = ['captcha' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);

        $captchMessage = '';
        if ($validator->fails()) {
            Session::flash('error',"Captcha incorrect or not given !");
            return redirect()->back();
        } else {
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);


            $credentials = $request->only('email', 'password');
            $user = User::where('email', $request->email)->first();

            if($user->role_id == '12'){
                if (Auth::attempt($credentials,$request->filled('remember'))) {
                    return redirect()->route('research.admin.dashboard')
                                ->withSuccess('You have Successfully Logged in');
                }else{
                    Session::flash('error','Oppes ! You have entered invalid credentials');
                    return redirect()->back();
                }
            }else{

                if($user && Hash::check($request->password, $user->password)){
                    if (Auth::attempt($credentials,$request->filled('remember'))) {
                        return redirect()->route('research.admin.dashboard')
                                    ->withSuccess('You have Successfully Logged in');
                    }else{
                        Session::flash('error','Oppes ! You have entered invalid credentials');
                        return redirect()->back();
                    }
                }else{
                    Session::flash('error','Account not created yet or invalid credentials');
                    return redirect()->back();
                }
            }

        }



    }


    

    public function researchLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('research.login.show');
    }


    public function showRegister(){
        return view('research.auth.register');
    }

    public function storeRegister(Request $request){

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            "profile_photo" => 'sometimes|file|mimes:jpeg,png,jpg|max:1024',
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);


        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $path = public_path('upload/research/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/research/user_profile_photo/' . $filename;
        }
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
        $user->role = 'Research User';
        $user->role_id = 13;
        $user->is_delete = 1;
        $user->created_by = 'register';
        $user->is_research = '1';
        $user->password = Hash::make($request->input('password'));

        $user->save();

        if($user->save()){

            $user->assignRole('Research User');

            $email = $request->input('email');
                $mailData = [
                    'username' => $request->input('email'),
                    'msg' => 'you have successfully registered your credentials is',
                    'password' => $request->input('password'),
                ];
            Mail::to($email)->send(new StudentRegister($mailData));

            return redirect()->route('research.login.show')
            ->with('success', 'User Registered Successfully');
        }else{
            return redirect()->back()
            ->with('error', "Something went's wrong !");
        }
    }


    // public function caseStudiesRegister(Request $request){

    //     $request->validate([
    //         'first_name' => ['required', 'string', 'max:255'],
    //         'last_name' => ['required', 'string', 'max:255'],
    //         'user_name' => ['required', 'string', 'max:255'],
    //         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
    //         'contact_no' => ['required', 'numeric', 'digits:10'],
    //         'state_id' => ['required'],
    //         'district_id' => ['required'],
    //         "profile_photo" => 'sometimes|file|mimes:jpeg,png,jpg|max:1024',
    //         'present_address' => ['required'],
    //         'permanent_address' => ['required'],
    //         'password' => ['required', 'string', 'min:8', 'confirmed'],
    //     ]);


    //     if ($file = $request->file('profile_photo')) {
    //         $data = $request->file('profile_photo');
    //         $extension = $data->getClientOriginalExtension();
    //         $filename = time() . '_' . uniqid() . '.' . $extension;
    //         $path = public_path('upload/research/user_profile_photo/');
    //         $upload_success = $data->move($path, $filename);
    //         $profile_photo = '/upload/research/user_profile_photo/' . $filename;
    //     }
    //     $user = new User();
    //     $user->first_name = $request->input('first_name');
    //     $user->last_name = $request->input('last_name');
    //     $user->user_name = $request->input('user_name');
    //     $user->email = $request->input('email');
    //     $user->contact_no = $request->input('contact_no');
    //     $user->state_id = $request->input('state_id');
    //     $user->district_id = $request->input('district_id');
    //     $user->present_address = $request->input('present_address');
    //     $user->permanent_address = $request->input('permanent_address');
    //     $user->profile_photo = $profile_photo;
    //     $user->role = 'Research User';
    //     $user->role_id = 13;
    //     $user->is_delete = 1;
    //     $user->created_by = 'register';
    //     $user->is_research = '1';
    //     $user->password = Hash::make($request->input('password'));

    //     $user->save();

    //     if($user->save()){

    //         $user->assignRole('Research User');

    //         $email = $request->input('email');
    //             $mailData = [
    //                 'username' => $request->input('email'),
    //                 'msg' => 'you have successfully registered your credentials is',
    //                 'password' => $request->input('password'),
    //             ];
    //         Mail::to($email)->send(new StudentRegister($mailData));

    //         return redirect()->route('research.login.show')
    //         ->with('success', 'User Registered Successfully');
    //     }else{
    //         return redirect()->back()
    //         ->with('error', "Something went's wrong !");
    //     }
    // }
}

