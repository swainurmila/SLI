<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\OfficeMailContent;

class MailContentController extends Controller
{
    public function MailMaster()
    {

        $mail = OfficeMailContent::where('is_delete', 0)->get();
        return view("Eoffice.MailContentMaster",compact('mail'));
    }
    public function MailAdd(Request $request){
        //return $request;
        $request->validate([
                'mail_title' => 'required',
                'status' => 'required|in:0,1',
                 'mail_content' => 'required',
            ]);

        $mail= new  OfficeMailContent();
        $mail->mail_title = $request->mail_title;
        $mail->mail_content = $request-> mail_content;
        $mail->status =$request->status;
        $mail->save();
        return redirect()->route('mailcontent-master')
        ->with('success', 'Added Successfully');
    }
    public function MailUpdate(Request $request, $id){
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'status' => 'required|in:0,1',
        // ]);
        $mail =OfficeMailContent::where('id', $id)->update([
            'mail_title' => $request->mail_title,
            'mail_content'=>$request->mail_content,
            'status'=>$request->status,

        ]);
        return redirect()->route('mailcontent-master')
        ->with('success', 'Updated Successfully');
    }

    public function MailDelete ($id){
        //return $id;
        $mail= OfficeMailContent::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('mailcontent-master')
        ->with('success', 'deleted Successfully');
    }
}
