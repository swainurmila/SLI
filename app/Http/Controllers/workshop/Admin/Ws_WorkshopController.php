<?php

namespace App\Http\Controllers\workshop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\Workshop;
use Session;
use Auth;
use App\Models\Workshop\WsAddToCart;



class Ws_WorkshopController extends Controller
{
    public function index(){
        try{
            $data = Workshop::get();
            return view("workshop.admin.workshop.index", compact("data"));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function create(){
        try{
            return view("workshop.admin.workshop.create");
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function store(Request $request){
        try{
            //return $request;
            $data = $this->validate($request, [
                'title' => 'required|unique:workshop',
                'workshop_type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'workshop_mode' => 'required',
                'price' => 'required',
                'location' => 'required',
                'image' => 'required|mimes:jpeg,png,gif,pdf|max:1048576',
                'description'=> 'required',
            ]);
            //return $request;
            if ($file = $request->file('image')) {
                $data = $request->file('image');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'workshop_image' . '.' . $extension;
                $path = public_path('/upload/workshop/workshop_image/');
                $upload_success = $data->move($path, $filename);
                $upload_image = '/upload/workshop/workshop_image/' . $filename;
            }
            $detail = new Workshop();
            $detail->title = $request->title;
            $detail->workshop_type = $request->workshop_type;
            $detail->start_date = $request->start_date;
            $detail->end_date = $request->end_date;
            $detail->start_time = $request->start_time;
            $detail->end_time = $request->end_time;
            $detail->workshop_mode = $request->workshop_mode;
            $detail->price = $request->price;
            $detail->location = $request->location;
            $detail->image = $upload_image;
            $detail->description = $request->description;
            $detail->status = 1;
            $detail->save();
            Session::flash('success', trans('Workshop added successfully'));
            return redirect()->route('workshop.index');

        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function edit($id){
        try{
            $workshop = Workshop::find($id);
            return view('workshop.admin.workshop.edit', compact('workshop'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function update($id, Request $request){
        try{
            $data = $this->validate($request, [
                'title' => 'required',
                'workshop_type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'workshop_mode' => 'required',
                'price' => 'required',
                'location' => 'required',
                'description'=> 'required',
            ]);
            //return $request;
            if ($file = $request->file('image')) {
                $data = $request->file('image');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'workshop_image' . '.' . $extension;
                $path = public_path('/upload/workshop/workshop_image/');
                $upload_success = $data->move($path, $filename);
                $upload_image = '/upload/workshop/workshop_image/' . $filename;
            }else{
                $upload_image = $request->old_image;
            }
            $detail = Workshop::find($id);
            $detail->title = $request->title;
            $detail->workshop_type = $request->workshop_type;
            $detail->start_date = $request->start_date;
            $detail->end_date = $request->end_date;
            $detail->start_time = $request->start_time;
            $detail->end_time = $request->end_time;
            $detail->workshop_mode = $request->workshop_mode;
            $detail->price = $request->price;
            $detail->location = $request->location;
            $detail->image = $upload_image;
            $detail->description = $request->description;
            $detail->status = 1;
            $detail->update();
            Session::flash('success', trans('Workshop added successfully'));
            return redirect()->route('workshop.index');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function enrolled()
{

    $enrolled_student = WsAddToCart::with('transaction', 'workshop', 'user')->get();
    return view("workshop.enrolledstudentdetails",compact('enrolled_student'));

}
public function transaction()
{

    $enrolled_student = WsAddToCart::with('transaction', 'workshop', 'user')->get();
    return view("workshop.transactiondetails",compact('enrolled_student'));

}


    public function adminLogout(){
        try{
            Session::flush('success','Successfully Logged out !');
            Auth::logout();
            return redirect()->route('workshop.login.show');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
