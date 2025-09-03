<?php

namespace App\Http\Controllers\Eoffice\Admin;
use App\Models\e_office\officeUser;
use App\Models\e_office\OfficeAppointment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\e_office\UserIdentity;
use Illuminate\Support\Facades\Mail;
use App\Mail\Eoffice\ApprovedAppointment;
use App\Models\e_office\OfficeDepartment;
use App\Models\e_office\OfficePurpose;


class AppointmentController extends Controller
{
    
    public function index(){
        $user_lists = officeUser::where('id', '!=', Auth::guard('officer')->user()->id)->get();
        $userIdentity = UserIdentity::where('user_id',Auth::guard('officer')->user()->id)->first();

       $request_appointment = OfficeAppointment::with('FromUser', 'TodUser')->where('user_request_id', '=', Auth::guard('officer')->user()->id)->get();

       $recived_appointment = OfficeAppointment::where('to_user_id', '=', Auth::guard('officer')->user()->id)->get();

       $departments = OfficeDepartment::where('status','1')->get();
       $purposes = OfficePurpose::where('status','1')->get();


        return view('Eoffice.admin.appointment.index',compact('departments','purposes','user_lists','request_appointment','recived_appointment','userIdentity'));
    }


    public function allAppointments(){

        $request_appointment = OfficeAppointment::where('user_request_id', '!=', Auth::guard('officer')->user()->id)->get();
      
       
        return view('Eoffice.admin.appointment.all-appointments',compact('request_appointment'));
    }


    public function getAuthority(Request $request){
        $officeUsers = officeUser::whereIn('role_id', [$request->role_id])->where('id','!=',Auth::guard('officer')->user()->id)->get();
        return response()->json([
            'users' => $officeUsers,
        ]);
    }

    public function saveRequestAppointment(Request $request){

        $data = $this->validate($request, [
            'visiting_office'=>'required',
            'department'=>'required',
            'designation'=>'required',
            'officer'=>'required',
            'purpose'=>'required',
            'visiting_date'=>'required',
            // 'identity_number'=>'required'
        ]); 
        // return $request;
        $todayAppointmentDay = OfficeAppointment::where('visiting_date',$request->visiting_date)->where('to_user_id',$request->officer)->where('user_request_id',Auth::guard('officer')->user()->id)->first();

        if(!$todayAppointmentDay){

            // dd($request->all());
            $data = new OfficeAppointment();
            $data->user_request_id = Auth::guard('officer')->user()->id;
            $data->to_user_id = $request->officer; 
            // $data->from_date = $request->from_date;
            // $data->to_date = $request->to_date; 
            $data->causes = $request->causes; 
            $data->visiting_office = $request->visiting_office;
            $data->department = $request->department;
            $data->officer = $request->designation;
            $data->purpose = $request->purpose;
            $data->visiting_date = $request->visiting_date;
            $data->identity_type = "Aadhaar Card";
            // $data->identity_number = $request->identity_number;
            $data->status=0;
            $data->save();

            if($data->save()){

                // $check_identity = UserIdentity::where('user_id',Auth::guard('officer')->user()->id)->first();

                // if(!$check_identity){

                //     $user_identity = new UserIdentity;
                //     $user_identity->user_id = Auth::guard('officer')->user()->id;
                //     $user_identity->identity_type = 'Aadhaar Card';
                //     $user_identity->identity_number = $request->identity_number;
                //     $user_identity->save();
                // }

                Session::flash('success','Appointment Created Successfully !');
                return redirect()->back();
            }else{
                Session::flash('error','Something wents wrong !');
                return redirect()->back();
            }
        }else{
            Session::flash('error','One appoinment already created for today please try again tomorrow !');
            return redirect()->back();
        }  
    }
    public function saveapproveAppointment(Request $request){
        $issue_app = OfficeAppointment::where('id',$request['id'])->first();
        $issue_app->approved_date = $request['approved_date'];
        $issue_app->from_time = $request['from_time'];
        $issue_app->to_time = $request['to_time'];
        $issue_app->status = 1;
       
        $issue_app->update();

        $email = $issue_app->FromUser->email;
        $mailData = [
            'username' => $email,
            'msg' => 'Your appointment is successfully approved and your appointment time is '. $request['from_time'] .' to '. $request['to_time'],
        ];
        Mail::to($email)->send(new ApprovedAppointment($mailData));
       
        $data = [];
        return response()->json($data);
 
    }
 
    public function rejectAppoitment(Request $request){
        // dd($request['approved_date']);
        $issue_app = OfficeAppointment::where('id',$request['id'])->first();
        $issue_app->reject_remark = $request['reject_remark'];
       
        $issue_app->status = 2;
       
        $issue_app->update();

        $email = $issue_app->FromUser->email;
        $mailData = [
            'username' => $email,
            'msg' => 'Your appointment is rejected',
        ];
        Mail::to($email)->send(new ApprovedAppointment($mailData));
       
        $data = [];
        return response()->json($data);
 
    }
 
 
    public function momSubmit(Request $request){
 
        $data = $this->validate($request, [
            'mom_file' => 'required',
            'mom_description' => 'required',
                   
        ]);
        $images = $request->file('mom_file');
        foreach($images as $key => $image) {                    
           
            if($image){
                $file1 = $image;
                $mime_type_array1 = array(
                    "jpeg" => "image/jpeg",
                    "jpg" => "image/jpeg",
                     "pdf" => "application/pdf"
                );
                $ext1 = pathinfo($_FILES['mom_file']['name'][0], PATHINFO_EXTENSION);
                $finfo1 = finfo_open(FILEINFO_MIME_TYPE);
               
                    $total_image1 = uniqid().'.'.$ext1;
                   
                    $base_path1 = $file1->move('public/upload/e_office/mom_file',$total_image1);
                    chmod($base_path1, 0777);
                     
            }
 
 
        }
 
        $issue_app = OfficeAppointment::where('id',$request->appoitment_id)->first();
        $issue_app->mom_description = $request->mom_description;
        $issue_app->mom_file = $total_image1;
       
         
        $issue_app->update();
 
        return redirect()->route('admin.office.appointment.index');
    }

}
