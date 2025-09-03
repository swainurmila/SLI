<?php

namespace App\Http\Controllers\Training\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Training\StudentRegister;




class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('training.auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'user_type' => ['required'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            'qualification' => ['required'],
            'course_name' => ['required'],
            'passing_year' => ['required'],
            "profile_photo" => 'sometimes|file|mimes:jpeg,png|max:1024',
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $unique_no = User::orderBy('id', 'DESC')->pluck('id')->first();
        if ($unique_no == null or $unique_no == "") {
            $unique_no = 1;
        } else {
            $unique_no = $unique_no + 1;
        }
        if($request->user_type == 5){
            // $role_name = ''
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
        $user->education = $request->input('qualification');
        $user->course_name = $request->input('course_name');
        $user->passing_year = $request->input('passing_year');
        $user->present_address = $request->input('present_address');
        $user->permanent_address = $request->input('permanent_address');
        $user->profile_photo = $profile_photo;
        $user->role = 'User';
        $user->role_id = 5;
        $user->created_by = 3;
        $user->is_training = '1';
        $user->is_delete = 2;
        $user->created_by = 'register';
        $user->password = Hash::make($request->input('password'));

        $user->save();

        if($user->save()){

            $user->assignRole('User');

            $email = $request->input('email');
                $mailData = [
                    'username' => $request->input('email'),
                    'msg' => 'you have successfully registered your credentials is',
                    'password' => $request->input('password'),
                ];
                // return $mailData;
            Mail::to($email)->send(new StudentRegister($mailData));

            return redirect()->route('training.login.show')
            ->with('success', 'User Registered Successfully');
        }else{
            return redirect()->back()
            ->with('error', "Something went's wrong !");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
