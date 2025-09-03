<?php

namespace App\Http\Controllers\Eoffice\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\e_office\officeUser;
use DB;
use Session;
use Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Support\Facades\Mail;
use App\Mail\Eoffice\ApprovedUser;

class EofficeUserController extends Controller
{

    protected $model = officeUser::class;

    public function index(){

        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();

        if(Auth::guard('officer')->user()->getRoleNames()[0] == 'Eoffice Deputy Secretary' || Auth::guard('officer')->user()->getRoleNames()[0] == 'Eoffice Secretary' || Auth::guard('officer')->user()->getRoleNames()[0] == 'Eoffice Additional Secretary'){
            $user_detail_pending = officeUser::orderBy('id', 'desc')->where('status',0)->whereIn('role_id', [2, 3, 4])->whereNotIn('id', [Auth::guard('officer')->user()->id])->get();
           $user_detail_approve = officeUser::where('status',1)->orderBy('id', 'desc')->whereIn('role_id', [2, 3, 4])->whereNotIn('id', [Auth::guard('officer')->user()->id])->get();
            $user_detail_reject = officeUser::where('status',2)->orderBy('id', 'desc')->whereIn('role_id', [2, 3, 4])->whereNotIn('id', [Auth::guard('officer')->user()->id])->get();
        }else{

            $user_detail_pending = officeUser::orderBy('id', 'desc')->where('status',0)->whereNotIn('id', [Auth::guard('officer')->user()->id])->get();
            $user_detail_approve = officeUser::where('status',1)->orderBy('id', 'desc')->whereNotIn('id', [Auth::guard('officer')->user()->id])->get();
            $user_detail_reject = officeUser::where('status',2)->orderBy('id', 'desc')->whereNotIn('id', [Auth::guard('officer')->user()->id])->get();
        }
        $roles = Role::where('guard_name','officer')->get();


        return view('Eoffice.admin.users.index',compact('user_detail_pending','user_detail_approve','user_detail_reject','states','cities','roles'));
    }


    public function storeEofficeUser(Request $request){


        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = public_path('upload/eoffice_user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/eoffice_user_profile_photo/' . $filename;

        }else{
            $profile_photo = null;
        }

        $requestData = $request->all();
        $requestData['profile_photo'] = $profile_photo;


        $data = $this->model::create($requestData);

        $role = Role::where('id', $request->role_id)->where('guard_name', 'officer')->first();
        $data->assignRole($role);

        if($data){


            $email = $data->email;
            $mailData = [
                'username' => $email,
                'msg' => 'Your account is successfully activated for the role ' . $role->name,
            ];
            Mail::to($email)->send(new ApprovedUser($mailData));

            // Session::flash('success','User Created Successfully !');
            return redirect()->back()->with('success', 'User Added Successfully');
        }else{
            // Session::flash('error',"Something went's wrong !");
            return redirect()->back()->with('error', "Something went's wrong !");
        }
//         return redirect()->route('workshop.users')
//         ->with('success', 'User Added Successfully');
// } else {
//     return redirect()->back()
//         ->with('error', "Something went's wrong !");
// }
    }


    public function updateEofficeUser(Request $request, $id){


        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . '.' . $extension;
            $path = public_path('upload/eoffice_user_profile_photo/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/eoffice_user_profile_photo/' . $filename;
        }else {
            $profile_photo = $request->profile_photo_old;
        }



        $data = $this->model::find($id);

        if (!$data) {
            Session::flash('error', 'Record not found.');
            return redirect()->back();
        }

        $requestData = $request->all();
        $requestData['profile_photo'] = $profile_photo;
        if($request->password){
            $requestData['password'] = Hash::make($request->password);
        }else{
            $requestData['password'] =  $data->password;
        }
        $data->update($requestData);

        $role = Role::where('id', $request->role_id)->where('guard_name', 'officer')->first();
        $data->assignRole($role);


        $email = $data->email;
        $mailData = [
            'username' => $email,
            'msg' => 'Your account is successfully approved',
        ];
        Mail::to($email)->send(new ApprovedUser($mailData));

        Session::flash('success', 'User Updated Successfully !');
        return redirect()->back();
    }
}
