<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Research\RpCertificate;
use Auth;
use App\Models\User;
use App\Models\Research\RpSubmittedPaper;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $selectedCertificate = RpCertificate::orderBy('id','desc')->first();
        return view('research.admin.certificate.index',compact('selectedCertificate'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function assignCertificate(Request $request){
        $template_id = $request['template_id'];
       
        if(RpCertificate::count() == 0){
            $certificate_request = new RpCertificate();
            $certificate_request->template_id = $template_id;
            $certificate_request->save();
        }else{
            RpCertificate::where('id', 1)->update(['template_id' => $template_id]);
        }
        $data = [];
        return response()->json($data);
    }


    public function downloadCertificate($id){
        try{


           $user = User::where('id', Auth::user()->id)->first();
           $submittedPaper = RpSubmittedPaper::where('id', $id)->first();
           $setting_data = RpCertificate::orderBy('id', 'DESC')->first();
           $certified_date = RpSubmittedPaper::where('is_publish','1')->where('issue_certificate','1')->first();

        
            if($setting_data->template_id == 3){
                return view('research.user.certificate.certificatetwo',compact('user','submittedPaper', 'certified_date'));
            }else{
                return view('research.user.certificate.certificate',compact('user','submittedPaper', 'certified_date'));
            }
            $html = view('research.user.certificate.certificate')->render();
        
            $pdf = PDF::loadView('research.user.certificate.certificate');
        
            $pdf->setPaper('A4', 'portrait');
            $pdf->render();
            return $pdf->download('certificate.pdf');
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
