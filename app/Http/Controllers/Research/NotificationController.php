<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Research\RpPaperNotification;
use Session;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $latestNotification = RpPaperNotification::orderBy('id','desc')->first();
       $data = RpPaperNotification::orderBy('id','desc')->get();
       
       return view('research.admin.notification.index',compact('data','latestNotification'));
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

        try {
            $request->validate([
                'notification_title'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
            ]);
            $requestData = $request->all();
            
            $existingNotification = RpPaperNotification::where('start_date','<=',$request->start_date)->where('end_date',">=",$request->start_date)->first();


            if(!$existingNotification){
                
                $data = RpPaperNotification::create($requestData);
                if($data){
                    Session::flash('success','Paper Notification Created Successfully !');
                }
            }else{
                Session::flash('success','Paper notification already created with this dates !');
            }
            return redirect()->back();
        } catch (ValidationException $e) {
            Session::flash('error',$e->errors());
            return back()->withErrors($e->errors())->withInput();
        }
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


        try {
            $request->validate([
                'notification_title'=>'required',
                'start_date'=>'required',
                'end_date'=>'required',
    
            ]);
        
            $data = RpPaperNotification::find($id);
        
            if (!$data) {
                return redirect()->back()->withErrors(['Record not found.']);
            }
            $data->notification_title = $request->notification_title;
            $data->start_date = $request->start_date;
            $data->end_date = $request->end_date;
            $data->save();
        
            Session::flash('success', 'Paper Notification Updated Successfully !');
            return redirect()->back();
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = RpPaperNotification::find($id);
            if (!$data) {
                return redirect()->back()->withErrors(['Record not found.']);
            }
            $data->delete();
            Session::flash('success', 'Paper Notification Deleted Successfully!');
            return redirect()->back();
        } catch (ValidationException $e) {
            Session::flash('error',$e->errors());
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
