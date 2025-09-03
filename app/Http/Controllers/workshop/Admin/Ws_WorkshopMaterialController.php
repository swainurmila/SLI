<?php

namespace App\Http\Controllers\workshop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\Workshop;
use App\Models\Workshop\WsSchedule;
use App\Models\Workshop\WsPresentation;
use App\Models\Workshop\WsAddToCart;
use App\Models\Workshop\WsWorkshopRating;
use Session;
use Auth;


class Ws_WorkshopMaterialController extends Controller
{
    public function workshopView($id){
        try{
            // return $id;
            $details = Workshop::find($id);
            $schedule = WsSchedule::where('workshop_id', $id)->get();
            $presentation = WsPresentation::where('workshop_id', $id)->get();
            $feedback = WsWorkshopRating::with('workshopDetails')->where('workshop_id',$id)->where('is_delete', 1)->get();
            $enrolled_student = WsAddToCart::with('transaction', 'workshop', 'user')->where('workshop_id', $id)->get();
            $avg_ratings = WsWorkshopRating::where('workshop_id',$id)->avg('rating');
            $roundedAverageRating = min(5, round($avg_ratings, 2));
            return view("workshop.admin.workshop.view_details", compact("details", 'schedule' ,'presentation','feedback', 'enrolled_student','roundedAverageRating',));
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function addSchedule($id){
        try{
            $workshop = Workshop::where('id', $id)->first();
            return view("workshop.admin.workshop.add_schedule", compact('workshop'));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function createSchedeule(Request $request){
        try{
           // return $request;
            if($request->workshop_mode == "offline"){
               // return 1;
                $data = new WsSchedule();
                $data->workshop_id = $request->workshop_id;
                $data->workshop_mode = $request->workshop_mode;
                $data->schedule_title = $request->name;
                $data->schedule_date = $request->workshop_date;
                $data->start_time = $request->offline_start;
                $data->end_time = $request->offline_end;
                $data->sch_description = $request->sch_description;
                $data->save();
            }


            Session::flash('success', trans('Schedule added successfully'));
            return redirect()->route('workshop.index');
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function editSchedule(Request $request){
        try{
            $workshop = Workshop::with('schedule')->where('id', $request->id)->first();
            return view("workshop.admin.workshop.edit_schedule", compact("workshop"));
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    //Attendance


    public function updateSchedeule(Request $request){
        try{
            // return $request;
            $data = WsSchedule::where('id', $request->schedule_id)->update([
                'schedule_title' => $request->schedule_title,
                'schedule_date' => $request->schedule_date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'sch_description' => $request->sch_description,
            ]);
            Session::flash('success', trans('Schedule updated successfully'));
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function createPresentations(Request $request){
        try{
            //  return $request;
            if ($file = $request->file('document')) {
                $data = $request->file('document');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'presentation_image' . '.' . $extension;
                $path = public_path('/upload/workshop/presentation_image/');
                $upload_success = $data->move($path, $filename);
                $upload_document = '/upload/workshop/presentation_image/' . $filename;
            }
            $data = new WsPresentation();
            $data->workshop_id = $request->workshop_id;
            $data->presentation_title = $request->presentation_title;
            $data->pre_description = $request->pre_description;
            $data->document = $upload_document;
            $data->save();

            Session::flash('success', trans('Presentation added successfully'));
            return redirect()->back();
        }catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }
    public function editPresentations(Request $request){
        // Custom validation messages

        // Validate the request
        $request->validate([
            'presentation_title' => 'required',
            'pre_description' => 'required',
            'document' => 'required',
            'workshop_id' => 'required',
        ]);

        try {
            // return $request;
            // Handle document update
            if ($file = $request->file('document')) {
                $data = $request->file('document');
                $extension = $data->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'presentation_image' . '.' . $extension;
                $path = public_path('/upload/workshop/presentation_image/');
                $upload_success = $data->move($path, $filename);
                $upload_document = '/upload/workshop/presentation_image/' . $filename;
            }else{
                $upload_document = $request->old_document;
            }

            // Save the changes
            $data = WsPresentation::find($request->presentation_id);
            $data->workshop_id = $request->workshop_id;
            $data->presentation_title = $request->presentation_title;
            $data->pre_description = $request->pre_description;
            $data->document = $upload_document;
            $data->update();

            Session::flash('success', trans('Presentation updated successfully'));
            return redirect()->back();
        } catch (ValidationException $e) {
            Log::error('Validation errors: ' . json_encode($e->errors()));
            return back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id){
        try {

           $feedback =WsWorkshopRating::where('id', $id)->update([
            'is_delete' => 0,
           ]);
            Session::flash('success','Rating successfully removed !');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error',"Something went's wrong !");
            return redirect()->back();
        }
    }






}
