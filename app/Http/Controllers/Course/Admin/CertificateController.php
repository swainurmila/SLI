<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCertificateSetting;
use App\Models\User;
use App\Models\Course\CrExam;
use App\Models\Course\CrStudentAppliedExam;
use Auth;
class CertificateController extends Controller
{
    public function index(){

        $selectedCertificate = CrCertificateSetting::orderBy('id','desc')->first();

        return view('course.admin.certificate.index',compact('selectedCertificate'));
    }

    public function assignCertificate(Request $request){
        $template_id = $request['template_id'];
       
        if(CrCertificateSetting::count() == 0){
            $certificate_request = new CrCertificateSetting();
            $certificate_request->template_id = $template_id;
            $certificate_request->save();
        }else{
            CrCertificateSetting::where('id', 1)->update(['template_id' => $template_id]);
        }
        $data = [];
        return response()->json($data);
    }

    //Download Certificate
    public function downloadCertificate($id){
        try{
        //   return $id;
           $user = User::where('id', Auth::user()->id)->first();
           $course = CrExam::with('Course')->where('id', $id)->first();
           $setting_data = CrCertificateSetting::orderBy('id', 'DESC')->first();
           $certified_date = CrStudentAppliedExam::with('notification')
                        ->whereHas('notification', function($query) use ($id) {
                            $query->where('exam_id', $id);
                        })
                        ->first();

        
            if($setting_data->template_id == 3){
            return view('course.user.certificate.certificatetwo',compact('user','course', 'certified_date'));
            }
            else{
            return view('course.user.certificate.certificate',compact('user','course', 'certified_date'));
            }


            $html = view('course.user.certificate.certificate')->render();
        
            $pdf = PDF::loadView('course.user.certificate.certificate');
        
            $pdf->setPaper('A4', 'landscape');
            $pdf->render();
            return $pdf->download('certificate.pdf');
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
