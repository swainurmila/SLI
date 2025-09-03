<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use DB;
use Auth;
class Tr_UserController extends Controller
{
    public function index(){


        // $status = request('status');

        // if($status == '0'){
        //     $users = User::where('status','0')->where('is_training','1')->get();
        // }else if ($status == '1'){
        //     $users = User::where('status','1')->where('is_training','1')->get();
        // }else{
        //     $users = User::where('status','2')->where('is_training','1')->get();
        // }
        // return Auth::user()->role_id;
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $user_detail = User::where('role_id', 5)->orderBy('id', 'desc')->get();
        if(Auth::user()->role_id == '3'){
            $user_detail_pending = User::where('role_id', 5)->orderBy('id', 'desc')->where('status',0)->where('is_training','1')->with('createdBy')->get();
            $user_detail_approve = User::where('role_id', 5)->where('status',1)->orderBy('id', 'desc')->where('is_training','1')->with('createdBy')->get();
            $user_detail_reject = User::where('role_id', 5)->where('status',2)->orderBy('id', 'desc')->where('is_training','1')->with('createdBy')->get();
        }else{
            $user_detail_pending = User::where('role_id', 5)->orderBy('id', 'desc')->where('status',0)->where('is_training','1')->with('createdBy')->where('created_by', 'sponsor-user')->get();
            $user_detail_approve = User::where('role_id', 5)->where('status',1)->orderBy('id', 'desc')->where('is_training','1')->with('createdBy')->where('created_by', 'sponsor-user')->get();
            $user_detail_reject = User::where('role_id', 5)->where('status',2)->orderBy('id', 'desc')->where('is_training','1')->with('createdBy')->where('created_by', 'sponsor-user')->get();
        }
    //    return 2132;
        return view('training.admin.users.index',compact('user_detail_pending', 'states', 'cities','user_detail_approve','user_detail_reject','user_detail'));

    }


    public function updateStatus(Request $request,$id,$status){


        if($status == 'approve'){

            $user = User::find($id);
            $user->status = '1';
            $user->save();
        }else if($status == 'reject'){
            $user = User::find($id);
            $user->status = '2';
            $user->save();
        }else{
            $user = User::find($id)->delete();
            Session::flash('error',$user->email.' deleted successfully !');
            return redirect()->back();
        }

        if($user->save()){
            Session::flash('error',$user->email.' status successfully changed !');
            return redirect()->back();
        }
    }


    public function edit($id){
        $user = User::find($id);
        return view('training.admin.users.edit',compact('user'));
    }


    public function update(Request $request,$id){


        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'contact_no' => ['required', 'numeric', 'digits:10'],
            'state_id' => ['required'],
            'district_id' => ['required'],
            'present_address' => ['required'],
            'permanent_address' => ['required'],
        ]);


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

        if($request->password){
            $user->password = bcrypt($request->password);
        }

        $user->save();
        if($user->save()){
            Session::flash('success','User updated successfully !');
            return redirect()->route('training.users');
        }
    }
}
