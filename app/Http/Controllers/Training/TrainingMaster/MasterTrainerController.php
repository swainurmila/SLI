<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use DB;
use Auth;
use App\Models\User;

use App\Mail\Training\TrainerApprove;
use App\Models\Training\TrTransactionTable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Models\Training\TrTrainingClass;
class MasterTrainerController extends Controller
{

    public function index(){


        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        if(Auth::user()->role_id == '3'){
            $user_detail_approve = User::where('role_id', 6)->where('is_training','1')->where('status',1)->orderBy('registration_no', 'desc')->with('createdBy')->get();
        }else{
            $user_detail_approve = User::where('role_id', 6)->where('is_training','1')->where('status',1)->orderBy('registration_no', 'desc')->with('createdBy')->where('created_by', 'sponsor-user')->get();
        }




        return view("training.training-master.trainer.index", compact('user_detail_approve','states','cities'));

    }

    function generateUniqueId($length = 4) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $uniqueId = '';

        for ($i = 0; $i < $length; $i++) {
            $uniqueId .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $uniqueId;
    }

    public function transaction()
    {

         $transaction = TrTransactionTable::with( 'Training', 'User') ->select('id', 'user_id', 'training_id', 'amount', 'txn_ref_no', 'created_at')
         ->get();
        return view("training.transactiondetails",compact('transaction'));

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            "first_name"=>'required',
            "last_name"=>'required',
            "user_name"=>'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "contact_no"=>'required',
            "profile_photo" => 'required|file|mimes:jpeg,png|max:1024',
            "state_id"=>'required',
            "district_id"=>'required',
            "present_address"=>'required',
            "permanent_address"=>'required',
            "password"=>'required'
        ]);

        //return Auth::user()->id;
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first())->withInput();
        }

        // Validate the request data
        // $request->validate($rules);
        $registration_no = 'TRAINER'.date('y').$this->generateUniqueId();
        //profile photo upload
        if ($file = $request->file('profile_photo')) {
            $data = $request->file('profile_photo');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . 'profile_photo' . $registration_no . '.' . $extension;
            $path = public_path('upload/user_profile_trainer/');
            $upload_success = $data->move($path, $filename);
            $profile_photo = '/upload/user_profile_trainer/' . $filename;
        }
        //storeing user details
        // dd("ddd");
        $user = new User();
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
        $user->profile_photo = $profile_photo;
        $user->role = 'Trainer';
        $user->role_id = 6;
        $user->status = 1;

        if(Auth::user()->role_id == '3'){
            $user->created_by = 'admin';
        }else{
            $user->created_by = 'sponsor-user';
        }

        $user->password = Hash::make($request->input('password'));
        $user->is_delete = $request->user_mode ?? 0;

        if($request->is_course == '1'){
            $user->is_course = '1';
        }else{
            $user->is_training = '1';
        }

        $user->save();


        if($user->save()){
            $user->assignRole('Trainer');

            $email = $request->input('email');
                $mailData = [
                    'username' => $request->input('email'),
                    'msg' => 'you have successfully registered your credentials is',
                    'url' => "URL::to('/login')",
                    'password'=>$request->input('password'),
                ];
                // return $mailData;
                Mail::to($email)->send(new TrainerApprove($mailData));

                return redirect()->back()->with('success','Trainer created successfully !');
        }else{
            return redirect()->back()->with('error',"Something wents's wrong !");
        }
    }

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
        if($request->status == 1){
            $email = $request->input('email');
            $mailData = [
                'username' => $request->email,
                'msg' => 'Your Account has Approved By Admin.Now you can Login with your User Name and Password',
                'url' => "URL::to('/login')",

            ];
            // return $mailData;
            Mail::to($email)->send(new UserApproveMail($mailData));

        }
        $data->update();
        return redirect()->back();

    }
    public function trainingAssignClass(Request $request, $id="" ){
        $traner_user_data="";
        if(Auth::user()->role_id == 3){
            $traner_user_data = User::where('id',$id)->first();
            $classes = TrTrainingClass::with('meetingDetails')->where('trainer_user_id',$id)->get();
         }else{
            $traner_user_data = User::where('id',Auth::user()->id)->first();
            $classes = TrTrainingClass::with('meetingDetails')->where('trainer_user_id',Auth::user()->id)->get();
        }
        return view("training.training-master.trainer.assignclass", compact('classes','traner_user_data'));

    }

}
