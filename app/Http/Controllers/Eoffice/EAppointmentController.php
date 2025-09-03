<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Models\e_office\officeUser;
use App\Models\e_office\OfficeAppointment;
use App\Models\e_office\UserIdentity;
use Auth;
use Http;

class EAppointmentController extends Controller
{

    public function index(){
        $officeUsers = officeUser::whereIn('role_id',['21','22','23'])->get();

        $userIdentity = UserIdentity::where('user_id',Auth::guard('officer')->user()->id)->first();

        return view('Eoffice.Appointment.index',compact('officeUsers','userIdentity'));
    }


    public function myAppointments(){

       $request_appointment = OfficeAppointment::with('TodUser')->where('user_request_id', '=', Auth::guard('officer')->user()->id)->get();


       return view('Eoffice.admin.appointment.all-appointments',compact('request_appointment'));
    }

    public function sendOtp(Request $request){
        $uid = $request->aadhaarno;


        // Server Aadhar IP : http://10.150.9.44:8080
        // For Local : http://164.100.141.79

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://10.150.9.44:8080/authekycv4/api/generateOTP', [
            "uid" => $uid,
            "uidType" => "A",
            "consent" => null,
            "subAuaCode" => "0002590000",
            "txn" => null,
            "isPI" => null,
            "isBio" => null,
            "isOTP" => null,
            "bioType" => null,
            "name" => null,
            "dob" => null,
            "gender" => null,
            "rdInfo" => null,
            "rdData" => null,
            "otpValue" => null,
        ]);

        // $data = $response->json();

        // $response1 = Http::withHeaders([
        //     'Content-Type' => 'application/json',
        // ])->post('http://164.100.141.79/authekycv4/api/authenticate', [
        //     "uid" => $uid,
        //     "uidType" => "A",
        //     "consent" => "Y",
        //     "subAuaCode" => "0002590000",
        //     "txn" => $data['txn'],
        //     "isPI" => "n",
        //     "isBio" => "n",
        //     "isOTP" => "n",
        //     "bioType" => null,
        //     "name" => "Soumyaranjan Sahoo",
        //     "dob" => "07/06/1999",
        //     "gender" => "M",
        //     "rdInfo" => null,
        //     "rdData" => null,
        //     "otpValue" => null,
        // ]);

        // $data1 = $response1->json();

        // return response()->json($data1);

        if ($response->successful()) {
            $data = $response->json();
            $data['uid'] = $uid;
            return response()->json($data);
        }
    }

    public function verifyOtp(Request $request){
        $otp = $request->otp;
        $uid = $request->uid;
        $txn = $request->txn;
        



        // Server Aadhar IP : http://10.150.9.44:8080
        // For Local : http://164.100.141.79

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('http://10.150.9.44:8080/authekycv4/api/authenticate', [
            "uid" => $uid,
            "uidType" => "A",
            "consent" => "Y",
            "subAuaCode" => "0002590000",
            "txn" => $txn,
            "isPI" => "n",
            "isBio" => "n",
            "isOTP" => "y",
            "bioType" => null,
            "name" => null,
            "dob" => null,
            "gender" => null,
            "rdInfo" => null,
            "rdData" => null,
            "otpValue" => $otp,
        ]);
        if ($response->successful()) {
            $data = $response->json();
            $data['uid'] = $uid;
            return response()->json($data);
        }
    }
}
