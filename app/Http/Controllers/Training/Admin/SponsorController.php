<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Auth;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $sponsor_users = User::where('role_id', 9)->where('is_training','1')->where('is_training_role','1')->where('status',1)->orderBy('registration_no', 'desc')->get();

        return view('training.admin.sponsors.index',compact('states','cities','sponsor_users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "first_name"=>'required',
            "last_name"=>'required',
            "user_name"=>'required',
            "email"=>'required|email',
            "contact_no"=>'required',
            "profile_photo" => 'required|file|mimes:jpeg,png|max:1024',
            "state_id"=>'required',
            "district_id"=>'required',
            "present_address"=>'required',
            "permanent_address"=>'required',
            "password"=>'required'
        ]);
        

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }
        //return $request;
        // Validate the request data
        // $request->validate($rules);
        $registration_no = 'SPONSOR'.date('y').$this->generateUniqueId();
        //profile photo upload
        $user = new User();

        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $registration_no . '.' . $extension;
            $path = public_path('upload/sponsor_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/sponsor_photo/' . $filename;
            $user->profile_photo = $profile_photo;
        }
        //storeing user details
        // dd("ddd");
        
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->registration_no = $registration_no;
        $user->state_id = $request->input('state_id');
        $user->district_id = $request->input('district_id');
        $user->present_address = $request->input('present_address');
        $user->permanent_address = $request->input('permanent_address');
        $user->created_by = Auth::user()->id;
        $user->role = 'Training Sponsor User';
        $user->role_id = 9;
        $user->status = '1';
        $user->password = Hash::make($request->input('password'));
        if($request->user_mode == 1){
            $user->is_delete = '2';
        }else{
            $user->is_delete = '0';
        }
        $user->is_training = '1';
        $user->is_training_role = '1';


        $user->save();
        

        if($user->save()){
            $user->assignRole('Training Sponsor User');

            $email = $request->input('email');
                $mailData = [
                    'username' => $request->input('email'),
                    'msg' => 'you have successfully registered your credentials is',
                    'url' => "URL::to('/login')",
                    'password'=>$request->input('password'),
                ];
                // return $mailData;
                // Mail::to($email)->send(new TrainerApprove($mailData));
                
                return redirect()->back()->with('success','Sponsor created successfully !');
        }else{
            return redirect()->back()->with('error',"Something wents's wrong !");
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

        $validator = Validator::make($request->all(), [
            "first_name"=>'required',
            "last_name"=>'required',
            "user_name"=>'required',
            "email"=>'required|email',
            "contact_no"=>'required',
            "profile_photo" => 'sometimes|file|mimes:jpeg,png|max:1024',
            "state_id"=>'required',
            "district_id"=>'required',
            "present_address"=>'required',
            "permanent_address"=>'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        // return $registration_no;
        
        //return $request;
        $data = User::where('id', $id)->first();
        $data->first_name = $request->first_name;
        if(isset($request->password)){
            $data->password = Hash::make($request->password);
        }
        $data->last_name = $request->last_name;
        $data->user_name = $request->user_name;
        $data->email = $request->email;
        $data->contact_no = $request->contact_no;
        $data->state_id = $request->state_id;
        $data->district_id = $request->district_id;
        $data->present_address = $request->present_address;
        $data->permanent_address = $request->permanent_address;
        if($request->status){
            $data->status = $request->status;
        }
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $id . '.' . $extension;
            $path = public_path('upload/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_photo/' . $filename;
            $data->profile_photo = $profile_photo;
        }
        $data->is_delete = $request->user_mode ?? 0;
        // $user->status = $request->user_mode ?? 0;
        $data->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
