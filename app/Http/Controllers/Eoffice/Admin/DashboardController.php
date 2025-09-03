<?php

namespace App\Http\Controllers\Eoffice\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\e_office\OfficeAppointment;
use Carbon\Carbon;
use DB;
use App\Models\e_office\officeUser;
use App\Models\e_office\OfficeFile;


class DashboardController extends Controller
{
    public function index(){

        // $user = Auth::guard('officer')->user();


        // $role = SecondaryRole::where('name', 'Secretary')->where('guard_name', 'officer')->first();


        // $user->assignRole('Eoffice Additional Secretary');

        // $permissionNames = $user->getAllPermissions()->where('guard_name', 'officer');

        // dd($permissionNames);
        // $permissions = $user->permissions; 
        
        // get all permissions for the user, either directly, or from roles, or from both
        // $permissions = $user->getDirectPermissions();
        // $permissions = $user->getPermissionsViaRoles();
        // $permissions = $user->getAllPermissions();
        // dd($permissions);
//         Auth::setDefaultGuard('officer');

//         $guardName = Auth::guard('officer')->getName();
// dd($guardName);

//         dd($user->getGuardName());
//         $user->givePermissionTo('user-management-module','officer');

//         dd($user);
// dd(Auth::guard('officer')->user()->getAllPermissions());
        // if(Auth::guard('officer')->user()->hasPermissionTo('role-module','officer')){
        //     dd('aa');
        // }else{
        //     dd('bb');
        // }

            // dd(Auth::guard('officer')->user()->hasPermissionTo('user-management-module', 'officer'));
            // dd(Auth::guard('officer')->user()->getPermissionsViaRoles());
            // $userHasPermission = Auth::guard('officer')->user();
            //  dd($userHasPermission);

        
        
        // $user = Auth::guard('officer')->user();
        // dd(Auth::guard('officer')->user()->getRoleNames()[0]);
        // $directPermissions = $user->getDirectPermissions()->pluck('name');
        // $role = SecondaryRole::where('name', 'Admin')->where('guard_name','officer')->first();

        // // Get the permissions associated with the role
        // $permissions = $role->permissions->pluck('name');
        // dd($permissions);



        $events = [];


        $appointments = OfficeAppointment::with('TodUser')->where('user_request_id',Auth::guard('officer')->user()->id)->get();


        
        foreach ($appointments as $appointment) {
            $todayDate = date('Y-m-d');

            if($appointment->status == 0 && ($appointment->visiting_date == $todayDate || $appointment->visiting_date > Carbon::today()->format('Y-m-d'))){
                $backgroundColor='#0e81e6';
            }elseif($appointment->status == 1){
                $backgroundColor = '#02bf21';
            }elseif($appointment->status == 2){
                $backgroundColor = '#f50206';
            }else{
                $backgroundColor = '#ff4912';
            }

            $events[] = [
                'title' => $appointment->purpose,
                'start' => $appointment->visiting_date,
                'backgroundColor' => $backgroundColor,
                'textColor'=>'white',
                'details' => [
                    'purpose' => $appointment->purpose,
                    'requested_form' => $appointment->FromUser->first_name . ' ' . $appointment->FromUser->last_name,
                    'user_name' => $appointment->TodUser->first_name . ' ' . $appointment->TodUser->last_name,
                    'approved_date'=>$appointment->approved_date == null ? 'Not specified' : \Carbon\Carbon::parse($appointment->approved_date)->format('Y-m-d') ,
                    'start_time'=>$appointment->approved_date ? \Carbon\Carbon::parse($appointment->from_time)->format('H:i:s') : 'Not specified',
                    
                ]
            ];
        }
 
        $approved_appointment = OfficeAppointment::where('user_request_id',Auth::guard('officer')->user()->id)->where('status','1')->get();
        $pending_appointment = OfficeAppointment::where('user_request_id',Auth::guard('officer')
        ->user()->id)->where('status','0')
        ->where(function($query) {
            $query->where('visiting_date', Carbon::today()->format('Y-m-d'))
                  ->orWhere('visiting_date', '>', Carbon::today()->format('Y-m-d'));
        })
        ->get();

        $expired_appointment = OfficeAppointment::where('user_request_id',Auth::guard('officer')->user()->id)->where('status','0')->where('visiting_date','<',Carbon::today()->format('Y-m-d'))->get();

        $rejected_appointment  =OfficeAppointment::where('user_request_id',Auth::guard('officer')->user()->id)->where('status','2')->count();

        return view('Eoffice.admin.dashboard',compact('approved_appointment','pending_appointment','expired_appointment','events','rejected_appointment'));
    }


    public function viewProfile(){

        $data = officeUser::find(Auth::guard('officer')->user()->id);

        $states = DB::table('states')->get();
        $cities =DB::table('cities')->where('state_id',Auth::guard('officer')->user()->state_id)->get();

        return view('Eoffice.admin.view-profile',compact('data','states','cities'));
    }


    public function updateProfile(Request $request){

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
       
        $update_user = officeUser::where('id', Auth::guard('officer')->user()->id)->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_name' =>$request->user_name,
            'present_address' => $request->present_address,
            'permanent_address' => $request->permanent_address,
            'profile_photo' => $profile_photo,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'contact_no'=>$request->contact_no
        ]);
        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }
}
