<?php

namespace App\Http\Controllers\Finance\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Finance\BankDetails;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Session;
use DB;
use Auth;

class AdminController extends Controller
{
    public function userIndex(){
        try{

            $states = DB::table('states')->get();
            $cities = DB::table('cities')->get();
            $finance_user = User::where('is_finance', '1')->orderBy('id', 'desc')->get();
            return view("finance.admin.user.index", compact('states', 'cities', 'finance_user'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function storeFinanceUser(Request $request){
        try{

            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'user_name' => ['required', 'string', 'max:255'],
                'email' => 'required|email|unique:users,email',
                'contact_no' => ['required', 'numeric', 'digits:10'],
                "profile_photo" => 'sometimes|file|mimes:jpeg,png|max:1024',
                'present_address' => ['required'],
                'permanent_address' => ['required'],
                 'user_mode' => ['required'],
                'assigned_role' => ['required'],
            ]);

             $user_role = Role::where('id', $request->assigned_role)->first();

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
            $user->present_address = $request->input('present_address');
            $user->permanent_address = $request->input('permanent_address');
           
            $user->role = $user_role->name;
            $user->role_id = $user_role->id;
            $user->is_finance = '1';

            // For Local turn on this one
            // if($user_role->id == '26'){
            //     $user->status = 0;
            // }else{
            //     $user->status = 1;
            // }

            // This is for server
            if($user_role->id == '25'){
                $user->status = 0;
            }else{
                $user->status = 1;
            }

            $user->password = Hash::make($request->input('password'));

            $user->save();

            //25 is for server & 26 is for local .
            if($request->assigned_role == '25'){
                $user->assignRole('Finance Admin');
            }else{
                $user->assignRole('Finance User');
            }
            return redirect()->back()
                ->with('success', 'User Added Successfully');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function updateFinanceUser(Request $request, $id){
        try{

            $request->validate([
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'user_name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'contact_no' => ['required', 'numeric', 'digits:10'],
                "profile_photo" => 'sometimes|file|mimes:jpeg,png|max:1024',
                'present_address' => ['required'],
                'permanent_address' => ['required'],
                'assigned_role' => ['required'],
            ]);
            //return $request;
            $user_role = Role::where('id', $request->assigned_role)->first();
            $user = User::find($id);
            if (!$user) {
                // Handle case when user is not found
                Session::flash('error', 'User not found.');
                return redirect()->back()->withInput();
            }
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->user_name = $request->user_name;
            $user->email = $request->email;
            $user->contact_no = $request->contact_no;
            $user->present_address = $request->present_address;
            $user->permanent_address = $request->permanent_address;


            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            if ($file = $request->file('profile_photo')) {
                $data = $request->file('profile_photo');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . 'profile_photo' . $id . '.' . $extension;
                $path = public_path('upload/user_profile_photo/');
                $upload_success = $data->move($path, $filename);
                $profile_photo = '/upload/user_profile_photo/' . $filename;
                $user-> profile_photo = $profile_photo;
            }else{
                $user-> profile_photo = $request->old_profile_photo;
            }
            // if($user_role->id == '26'){
            //     $user->status = 0;
            // }else{
            //     $user->status = 1;
            // }

            if($user_role->id == '25'){
                $user->status = 0;
            }else{
                $user->status = 1;
            }





            $user->role = $user_role->name;
            $user->role_id = $user_role->id;
            $user->save();

            if($request->assigned_role == '25'){
                $user->assignRole('Finance Admin');
            }else{
                $user->assignRole('Finance User');
            }

            return redirect()->back()
            ->with('success', 'User Updated Successfully');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
