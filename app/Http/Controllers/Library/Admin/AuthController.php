<?php

namespace App\Http\Controllers\Library\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Mail;
use Auth;
use Session;
use DB;

class AuthController extends Controller
{
    public function libraryLogin(){
        return view('library.auth.login');
    }
    public function login(Request $request)
    {
        // return $request;
        // Validate the input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => ['required', 'captcha']
        ]);

        $user = User::where('email', $request->email)->first();
        $credentials = $request->only('email', 'password');
        if($user){
            if($user->status == 1 && $user->is_library == 1){

                if (Auth::attempt($credentials)) {
                    $session['name'] = $user->name;
                    $session['email'] = $user->email;
                    $session['id'] = $user->id;
                    //return 55;
                    $request->session()->put('userdata', $session);
                    return redirect()->intended('/portal/admin/home');
                }
                else{
                    return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
                }
            }elseif($user->status != 1 && $user->is_library == 1){
                return redirect()->back()->withErrors(['email' => 'Your account is not active currently! Please contact to admin.']);
            }else{
                return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
            }
        }else{
            Session::flash('error', 'Oppes ! You have entered invalid credentials');
                        return redirect()->back();
        }


    }
    public function libraryRegister(){
        return view('auth.register');
    }
    //get all cities based on states
    public function getCity(Request $request)
    {
        $city = DB::table('cities')->where('state_id', $request->state_id)->orderBy('name', 'asc')->get();
        return response()->json(['city' => $city]);
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
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'profile_photo' => 'required|file|mimes:jpeg,png|max:1024',
            // 'confirm_password' => ['required', 'string', 'min:8'],
        ]);


        // $request->validate($rules);
        $unique_no = User::orderBy('id', 'DESC')->pluck('id')->first();
        if ($unique_no == null or $unique_no == "") {
            $unique_no = 1;
        } else {
            $unique_no = $unique_no + 1;
        }

        $user = new User();
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $unique_no . '.' . $extension;
            $path = public_path('upload/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_photo/' . $filename;
            $user->profile_photo = $profile_photo;
        }
        //return $profile_photo;

        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->state_id = $request->input('state_id');
        $user->district_id = $request->input('district_id');
        $user->present_address = $request->input('present_address');
        $user->permanent_address = $request->input('permanent_address');

        $user->role = 'User';
        $user->role_id = 5;
        $user->is_library = '1';
        $user->password = Hash::make($request->input('password'));

        $user->save();

        if($user->save()){
            $user->assignRole('User');

            $email = $request->input('email');
                $mailData = [
                    'username' => $request->input('email'),
                    'msg' => 'you have successfully registered your credentials is',
                    'url' => "URL::to('/library.login')",
                    'password'=>$request->input('password'),

                ];
                Mail::to($email)->send(new RegisterMail($mailData));

            return redirect()->route('library.login')
            ->with('success', 'User Registered Successfully');
        }else{
            return redirect()->back()
            ->with('error', "Something went's wrong !");
        }
    }

}
