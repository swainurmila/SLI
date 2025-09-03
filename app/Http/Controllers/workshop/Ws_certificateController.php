<?php

namespace App\Http\Controllers\workshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\WsCertificate;

class Ws_certificateController extends Controller
{
    public function index(){

        $selectedCertificate = WsCertificate::orderBy('id','desc')->first();
        return view('workshop.admin.certificate.index',compact('selectedCertificate'));
    }

    public function assignCertificate(Request $request){
        $template_id = $request['template_id'];

        if(WsCertificate::count() == 0){
            $certificate_request = new WsCertificate();
            $certificate_request->template_id = $template_id;
            $certificate_request->save();
        }else{
            WsCertificate::where('id', 1)->update(['template_id' => $template_id]);
        }
        $data = [];
        return response()->json($data);
    }

}
