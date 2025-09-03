<?php

namespace App\Http\Controllers\workshop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\Workshop;
use App\Models\Workshop\WsNotification;
use Session;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class Ws_NotificationController extends Controller
{
    //
    public function notificationIndex(Request $request)
    {

        try {
            $data = WsNotification::with('Workshop')->get();
            $workshop = Workshop::get();
            return view('workshop.notification.index', compact('data', 'workshop'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function notificationStore(Request $request){
        try {

        //    return $request;
           $requestData = $request->all();
           $data = WsNotification::create($requestData);
           if($data){
               Session::flash('success','Workshop Notification Created Successfully !');
               return redirect()->back();
           }
       } catch (ValidationException $e) {
           Log::error('Validation errors: ' . json_encode($e->errors()));
           return back()->withErrors($e->errors())->withInput();
       }
       }

    //    public function notificationUpdate(Request $request, $id){
    //     try {

    //       $request->validate([

    //    if (!$data) {
    //            return redirect()->back()->withErrors(['Record not found.']);
    //        }
    //     //    $data->workshop_id=$request->workshop_id;
    //        $data->notification_title = $request->notification_title;
    //        $data->start_date = $request->add_start_date;
    //        $data->end_date = $request->add_end_date;
    //        $requestData = $request->all();
    //        $data->update($requestData);

    //        Session::flash('success', 'Workshop Notification Updated Successfully !');
    //        return redirect()->back();
    //    } catch (ValidationException $e) {
    //        Log::error('Validation errors: ' . json_encode($e->errors()));
    //        return back()->withErrors($e->errors())->withInput();
    //    }
    //    }

    //
    public function notificationUpdate(Request $request, $id){

        // return $request;
        try {

            $request->validate([
                'workshop_id' => 'required',
                'notification_title' => 'required|string|max:255',
                'add_start_date' => 'required|date',
                'add_end_date' => 'required|date|after_or_equal:add_start_date',
            ]);


            $data = WsNotification::find($id);

            if (!$data) {
                return redirect()->back()->withErrors(['Record not found.']);
            }
         //    $data->workshop_id=$request->workshop_id;
            $data->notification_title = $request->notification_title;
            $data->start_date = $request->add_start_date;
            $data->end_date = $request->add_end_date;
            $requestData = $request->all();
            $data->update($requestData);

            Session::flash('success', 'Workshop Notification Updated Successfully !');
            return redirect()->back();
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
        }

       public function notificationDestroy($id){
        try {
            $data = WsNotification::find($id);
            if (!$data) {
                return redirect()->back()->withErrors(['Record not found.']);
            }
            $data->delete();
            Session::flash('success', 'Workshop Notification Deleted Successfully!');
            return redirect()->back();
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
        }


}
