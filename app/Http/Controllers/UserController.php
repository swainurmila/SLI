<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminApprovalMail;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {

        if(Auth::user()->role_id == 3){
            $data = User::with('Role')->orderBy('id', 'DESC')->where('status', 1)->where('is_delete', 0)->where('is_training','1')->where('role_id',5)->get();
        }else{
            $data = User::with('Role')->orderBy('id', 'DESC')->get();
        }


        return view('users.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $roles = Role::whereNotIn('name',['Eoffice Admin','Eoffice Deputy Secretary','Eoffice Secretary','Eoffice Additional Secretary','Eoffice User'])->get();

        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'contact_no' => 'required|unique:users,contact_no',
            'password' => 'required|same:confirm-password',
            'role_id' => 'required',
        ]);

        $input = $request->only([
            'first_name',
            'last_name',
            'email',
            'user_name',
            'contact_no',
            'registration_no',
            'role',
            'status',
            'role_id',
            'password',
        ]);
        // return $request;
        $role = Role::find($request->role_id);
        $input['password'] = Hash::make($input['password']);
        $input['role'] = $role->name;
        if($role->name == 'Finance User'){
            $input['status'] = 1;
            $input['is_finance'] = '1';
        }

        if($role->name == 'Finance Admin'){
            $input['status'] = 0;
            $input['is_finance'] = '1';
        }

        if($role->name == 'Research Admin' || $role->name == 'Research User'){
            $input['status'] = 1;
            $input['is_research'] = '1';
        }

        if($role->name == 'Course Admin'){
            $input['status'] = 1;
            $input['is_course'] = '1';
        }
        if($role->name == 'User'){
            $input['status'] = 1;

            if($request->user_for == 'training'){
                $input['is_training'] = '1';
            }elseif($request->user_for == 'library'){
                $input['is_library'] = '1';
            }elseif($request->user_for == 'course'){
                $input['is_course'] = '1';
            }elseif($request->user_for == 'workshop'){
                $input['is_workshop'] = '1';
            }
        }
        if($role->name == 'Training Admin'){
            $input['status'] = 1;
            $input['is_training'] = '1';
        }
        if($role->name == 'Library Admin'){
            $input['status'] = 1;
            $input['is_library'] = '1';
        }
        if($role->name == 'Training Sponsor User'){
            $input['status'] = 1;
            $input['is_training'] = '1';
        }
        if($role->name == 'Workshop Admin'){
            $input['status'] = 1;
            $input['is_workshop'] = '1';
        }
        if($role->name == 'Trainer'){
            $input['status'] = 1;
            if($request->trainer_for == 'training'){
                $input['is_training'] = '1';
            }elseif($request->trainer_for == 'library'){
                $input['is_library'] = '1';
            }
        }



        $input['remember_token'] = $request->_token;

        $user = User::create($input);

        // Retrieve the role name based on the role_id
        $user->assignRole($role->name);

        return redirect()->route('users.index')->with('success', 'User created successfully');
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
        $user = User::find($id);

        $roles = Role::whereNotIn('name',['Eoffice Admin','Eoffice Deputy Secretary','Eoffice Secretary','Eoffice Additional Secretary','Eoffice User'])->get();


        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //  return $request;

        $update_user = User::find($id);
        $update_user->first_name = $request->first_name;
        $update_user->last_name = $request->last_name;
        $update_user->user_name = $request->user_name;
        $update_user->email = $request->email;
        $update_user->contact_no = $request->contact_no;
        $update_user->role_id = $request->role_id;

        if(isset($request->password)){
            $update_user->password = $request->password;
        }
        $update_user->registration_no = $request->registration_no;

        $roleName = Role::find($request->role_id)->name;
        $update_user->role = $roleName;

        if($roleName == 'Trainer'){
            $input['status'] = 1;
            if($request->trainer_for == 'training'){
                $update_user->is_training = '1';
            }elseif($request->trainer_for == 'library'){
                $update_user->is_library = '1';
            }
        }

        if($roleName == 'User'){
            $input['status'] = 1;

            if($request->user_for == 'training'){
                $update_user->is_training = '1';
            }elseif($request->user_for == 'library'){
                $update_user->is_library = '1';
            }elseif($request->user_for == 'course'){
                $input['is_course'] = '1';
                $update_user->is_course = '1';
            }elseif($request->user_for == 'workshop'){
                $input['is_workshop'] = '1';
                $update_user->is_workshop = '1';
            }
        }


        if($roleName == 'Finance User' || $roleName == 'Finance Admin'){
            $update_user->is_finance = '1';
        }

        if($roleName == 'Research Admin' || $roleName == 'Research User'){
            $update_user->is_research = '1';
        }

        if($roleName == 'Course Admin'){
            $update_user->is_course = '1';
        }

        if($roleName == 'Training Admin'){

            $update_user->is_training = '1';
        }
        if($roleName == 'Library Admin'){
            $update_user->is_library = '1';
        }
        if($roleName == 'Training Sponsor User'){
            $update_user->is_training = '1';
        }
        if($roleName == 'Workshop Admin'){
            $update_user->is_workshop = '1';
        }

        $update_user->save();
        $user = User::find($id);
        // $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($roleName);
        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //return $id;
        User::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
  //Use details view
    // public function approveUser(){
    //     $states = DB::table('states')->get();
    //     $cities = DB::table('cities')->get();
    //     $user_detail_pending = User::where([['role_id', 5],['status',0]])->get();
    //     $user_detail_approve = User::where([['role_id', 5],['status',1]])->get();
    //     $user_detail_reject = User::where([['role_id', 5],['status',2]])->get();
    //     // $user_detail        = User::where([['role_id', 5],['is_training',0],['is_course',0],['is_library',0]])->get();
    //      $user_detail = User::where('role_id', 5)->get();
    //     return view("libadmin.approve_user", compact('user_detail','user_detail_pending','user_detail_approve','user_detail_reject' ,'states', 'cities'));
    // }
    //Update user details and approval
    public function updateUserDetails(Request $request, $id){

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

        $pre = 'ELIB';
        $year = date('y');
        // $unique_id = $pre . $year;
        $unique_id = $pre;

         $last_reg = User::where('registration_no', 'like', '%' . $unique_id . '%')
            ->orderByRaw('CAST(SUBSTR(`registration_no`, ' . (strlen($unique_id) + 1) . ') as SIGNED) DESC')
            ->first('registration_no');
        if ($last_reg) {
            $extracted_part = substr($last_reg->registration_no, 0, 6);
            $last_number = (int)substr($last_reg->registration_no, strlen($extracted_part));
            $next_number = $last_number + 1;
        } else {
            $next_number = 1;
        }
        $registration_no = $pre . $year . str_pad($next_number, 4, '0', STR_PAD_LEFT);
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
        $data->education = $request->qualification ? $request->qualification : null;
        $data->course_name = $request->course_name ? $request->course_name : null;
        $data->passing_year = $request->passing_year ? $request->passing_year : null;
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

        if($request->user_mode){
            $data->is_delete = $request->user_mode;
        }
        if($request->status == 1 && Auth::user()->role_id != 12){
            $data->registration_no = $registration_no;
        }

        $data->update();

        $user = User::where('id', $id)->first();

        if ($request->status == 1) {
        $emailData = [
            'user_name' => $user->first_name,
            'last_name' => $user->last_name,

        ];
        Mail::to($user->email)->send(new AdminApprovalMail($emailData));
    }

        return redirect()->back()->with('success', 'User updated successfully');
    }
    public function getCity(Request $request)
    {
        $city = DB::table('cities')->where('state_id', $request->state_id)->orderBy('name', 'asc')->get();
        return response()->json(['city' => $city]);
    }
    //Add user details
    public function addUserDetails(Request $request){


        $validator = Validator::make($request->all(), [
            "first_name"=>'required',
            "last_name"=>'required',
            "user_name"=>'required',
            'email' => 'required|email|unique:users,email',
            "contact_no"=>'required',
            "profile_photo" => 'required|file|mimes:jpeg,png|max:1024',
            "state_id"=>'required',
            "district_id"=>'required',
            "present_address"=>'required',
            "permanent_address"=>'required'
        ]);

        // return Auth::user()->role_id;
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        // Validate the request data
        //generation of unique registration number
        $pre = 'ELIB';
        $year = date('y');
        $count = 0;
        $pattern = $pre . $year;
        $reg_no = $pre . $year . str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        $last_redg = User::where('registration_no', 'like', $pattern . '%')
         ->orderBy('registration_no', 'desc')
         ->pluck('registration_no')
         ->first();
         $numeric_part = substr($last_redg, -4);
         $new_numeric_part = str_pad((int)$numeric_part + 1, 4, '0', STR_PAD_LEFT);
         $new_reg_no = substr($last_redg, 0, -4) . $new_numeric_part;

         if ($last_redg != $reg_no) {
             $registration_no = $new_reg_no;
         }else{
            $registration_no = $reg_no;
         }

        //generation of unique number
        $unique_no = User::orderBy('id', 'DESC')->pluck('id')->first();
        if ($unique_no == null or $unique_no == "") {
            $unique_no = 1;
        } else {
            $unique_no = $unique_no + 1;
        }
        //profile photo upload
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $unique_no . '.' . $extension;
            $path = public_path('upload/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_photo/' . $filename;
        }else{
            $profile_photo = null;
        }
        //storeing user details
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->user_name = $request->input('user_name');
        $user->email = $request->input('email');
        $user->contact_no = $request->input('contact_no');
        $user->registration_no = $registration_no;
        $user->state_id = $request->input('state_id');
        $user->district_id = $request->input('district_id');
        $user->education = $request->input('qualification') ? $request->input('qualification') : null;
        $user->course_name = $request->input('course_name') ? $request->input('course_name') : null;
        $user->passing_year = $request->input('passing_year') ? $request->input('passing_year') : null;
        $user->present_address = $request->input('present_address');
        $user->permanent_address = $request->input('permanent_address');
        $user->profile_photo = $profile_photo;
        $user->role = Auth::user()->role_id == '12' ? 'Research User' : 'User';
        $user->role_id = Auth::user()->role_id == '12' ? 13 : 5;
        $user->status = $request->user_mode == '1' ? 0 : 1;

        if(Auth::user()->role_id == '3'){
            $user->created_by = 'admin';
        }elseif(Auth::user()->role_id == '9'){
            $user->created_by = 'sponsor-user';
        }else{
            $user->created_by = 'register';
        }
        $user->is_library = Auth::user()->role_id == '2' ? '1' : '0';
        $user->is_training = Auth::user()->role_id == '3' ||  Auth::user()->role_id == '9' ? '1' : '0';
        $user->is_course = Auth::user()->role_id == '4' ? '1' : '0';
        $user->is_research = Auth::user()->role_id == '12' ? '1' : '0';
        $user->password = Hash::make($request->input('password'));
        $user->is_delete = $request->user_mode;
        $user->save();

        if($user->save()){
            if(Auth::user()->role_id == '12'){
                $user->assignRole('Research User');
            }else{
                $user->assignRole('User');
            }
            $request->session()->flash('success', "User Successfully Added !");
            return redirect()->back();
        }

    }
    public function userProfile(){
        $data = User::where('id', Auth::user()->id)->first();
        return view('users.profile', compact('data'));
    }
    public function updateProfile(Request $request){
          //return $request;
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
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'profile_photo' => $profile_photo,
        ]);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }

    public function viewProfile(){


        $data = User::find(Auth::user()->id);
        $states = DB::table('states')->get();
        $cities =DB::table('cities')->where('state_id',Auth::user()->state_id)->get();

        return view('libadmin.view-profile',compact('data','states','cities'));
    }

    public function updateUserProfile(Request $request){
       // return $request;
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
            'contact_no'=>$request->contact_no,
            'password' => Hash::make($request->input('password'))
        ]);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }

    public function changePassword(Request $request)
    {
        // Validate th
        $request->validate([
            'password' => ['required', 'confirmed', Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()],
        ]);

        // Get the authenticated user

        $change_password = User::where('id', Auth::user()->id)->update([
            'password' => $request->password,
        ]);
        // Update the user's password
        // $user->password = Hash::make($request->password);
        // $user->save();

        // Redirect back with a success message
        return back()->with('status', 'Password changed successfully!');
    }
}
