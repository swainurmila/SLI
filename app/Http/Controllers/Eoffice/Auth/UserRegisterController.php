<?php

namespace App\Http\Controllers\Eoffice\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\e_office\officeUser;
use App\Models\e_office\UserIdentity;
use Session;
use Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Training\StudentRegister;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{


    public function registerShow(){
        return view('Eoffice.auth.register');
    }


    public function EofficeUserStore(Request $request){
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:office_users'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'state_id' => ['required'],
            'company' => ['required'],
            'designation' => ['required'],
            'district_id' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            "profile_photo" => 'sometimes|file|mimes:jpeg,png,jpg|max:1024',
        ]);




        $unique_no = officeUser::orderBy('id', 'DESC')->pluck('id')->first();
        if ($unique_no == null or $unique_no == "") {
            $unique_no = 1;
        } else {
            $unique_no = $unique_no + 1;
        }
        
        $user = new officeUser();
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() .'.' . $extension;
            $path = public_path('upload/eoffice_user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/eoffice_user_profile_photo/' . $filename;
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
        $user->company = $request->input('company');
        $user->designation = $request->input('designation');
        $user->role = 'Eoffice User';
        $user->role_id = 24;
        $user->password = Hash::make($request->input('password'));

        $user->save();

        if($user->save()){
            $user->assignRole('Eoffice User');
            $check_identity = UserIdentity::where('user_id',$user->id)->first();
            if(!$check_identity){
                $user_identity = new UserIdentity;
                $user_identity->user_id = $user->id;
                $user_identity->identity_type = 'Aadhaar Card';
                $user_identity->identity_number = $request->identity_number;
                $user_identity->save();
            }
            $email = $request->input('email');
            $mailData = [
                'username' => $request->input('email'),
                'password'=> $request->input('password'),
                'msg' => 'you have successfully registered your credentials is',
            ];
            Mail::to($email)->send(new StudentRegister($mailData));
    
            return redirect()->route('office.login.show')
            ->with('success', 'User Registered Successfully');
        }else{
            return redirect()->back()
            ->with('error', "Something went's wrong !");
        }

    }
    public function checkAdhaar(Request $request){
        // return $request;
         $adhaarExists = UserIdentity::where('identity_number', $request->identity)->exists();
         $data['adhaarExists'] = $adhaarExists ? 1 : 0;
        return response()->json($data);
    }
}
