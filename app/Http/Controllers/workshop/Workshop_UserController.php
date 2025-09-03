<?php

namespace App\Http\Controllers\workshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Workshop\Workshop;
use App\Models\Workshop\WsAddToCart;
use App\Models\Workshop\WsTransactionTable;
use DB;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;
use App\Mail\WorkshopUserApproveMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminApprovalMail;


class Workshop_UserController extends Controller
{
    //
    public function index()
    {

        // return 1;
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $user_detail = User::where('role_id', 5)->orderBy('id', 'desc')->get();
        $user_detail_pending = User::where('role_id', 5)->orderBy('id', 'desc')->where('status',0)->where('is_workshop','1')->with('createdBy')->get();
        $user_detail_approve = User::where('role_id', 5)->where('status',1)->orderBy('id', 'desc')->where('is_workshop','1')->with('createdBy')->get();
        $user_detail_reject = User::where('role_id', 5)->where('status',2)->orderBy('id', 'desc')->where('is_workshop','1')->with('createdBy')->get();

       $enrolled_student = WsAddToCart::with('transaction', 'workshop', 'user')->get();

        return view('workshop.admin.users.index',compact('user_detail_pending', 'states', 'cities','user_detail_approve','user_detail_reject','user_detail', 'enrolled_student'));

    }

// YourController.php



    public function userstore(Request $request)
    {
        //   return $request;
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'password' => ['required'],
           'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'profile_photo' => ['sometimes', 'file', 'mimes:jpeg,png', 'max:1024'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'user_mode' => ['required'],

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
        $user->education = $request->input('qualification');
        $user->course_name = $request->input('course_name');
        $user->passing_year = $request->input('passing_year');
        $user->present_address = $request->input('present_address');
        $user->permanent_address = $request->input('permanent_address');
        $user->profile_photo = $profile_photo;
        $user->role = 'User';
        $user->role_id = 5;
        $user->is_training = '0';
        $user->is_course = '0';
        $user->is_workshop = '1';
        $user->status = $request->input('user_mode');

        $user->password = Hash::make($request->input('password'));

        $user->save();

        if ($user->save()) {
            $user->assignRole('User');
            $email = $request->input('email');
            $mailData = [
                'first' => $request->input('first_name'),
                'last' => $request->input('last_name'),
                'msg' => 'you have successfully registered your credentials is',
                'id' => $request->input('email'),
                'password' => $request->input('password'),
            ];
            Mail::to($email)->send(new WorkshopUserApproveMail($mailData));

            return redirect()->route('workshop.users')
                ->with('success', 'User Added Successfully');
        } else {
            return redirect()->back()
                ->with('error', "Something went's wrong !");
        }
    }

    // public function updateStatus(Request $request, $id, $status)
    // {


    //     if ($status == 'approve') {

    //         $user = User::find($id);
    //         $user->status = '1';
    //         $user->save();
    //         Mail::to($user->email)->send(new WorkshopUserApproveMail($user));

    //         Session::flash('success', $user->email . ' approved successfully!');
    //     } else if ($status == 'reject') {
    //         $user = User::find($id);
    //         $user->status = '2';
    //         $user->save();

    //     } else {
    //         $user = User::find($id)->delete();
    //         Session::flash('error', $user->email . ' deleted successfully !');
    //         return redirect()->back();
    //     }

    //     if ($user->save()) {
    //         Session::flash('error', $user->email . ' status successfully changed !');
    //         return redirect()->back();
    //     }
    // }


    // public function edit($id)
    // {
    //     $user = User::find($id);
    //     return view('workshop.admin.users.edit', compact('user'));
    // }
    public function getCities(Request $request)
    {
        $cities = DB::table('cities')->where('state_id', $request->state_id)->get();
        return response()->json(['city' => $cities]);
    }

    public function update(Request $request , string $id ,  $status)
    {



        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'profile_photo' => ['sometimes|file|mimes:jpeg,png|max:1024'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
            'verify_user' => ['required'],

        ]);
        // return $request;
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $id . '.' . $extension;
            $path = public_path('upload/user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_photo/' . $filename;
        }else{
            $profile_photo = $request->profile_photo_old;
        }

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->user_name = $request->user_name;
        $user->email = $request->email;
        $user->contact_no = $request->contact_no;
        $user->state_id = $request->state_id;
        $user->district_id = $request->district_id;
        $user->present_address = $request->present_address;
        $user->permanent_address = $request->permanent_address;
        $user->profile_photo = $profile_photo;
        if($request->verify_user){
            $user->status = $request->verify_user;
        }

        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

         $user->save();
            $emailData = [
                'user_name' => $user->first_name,
                'last_name' => $user->last_name,

            ];
            Mail::to($user->email)->send(new AdminApprovalMail($emailData));
            Session::flash('sucess', $user->email . 'status successfully changed !');
            return redirect()->route('workshop.users');
    }
}
