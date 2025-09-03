<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCourse;
use App\Models\User;
use App\Models\Course\CrSyllabusClass;
use Session;
use Google_Client;
use Google_Service_Calendar;

class Cr_ClassController extends Controller
{
    public function index($id,$syllabus_id){

        $cr_details_data = CrCourse::where('id',$id)->first();

        $classes = CrSyllabusClass::with('trainerDetails','meetingDetails')->where('syllabus_id',$syllabus_id)->get();

        return view('course.admin.course.class.index',compact('cr_details_data','syllabus_id','classes'));
    }


    public function create($id,$syllabus_id){

        $trainers =  User::where('role_id','6')->where('is_course','1')->where('is_delete','2')->where('status','1')->get();

        // dd($trainers);
        $cr_details_data = CrCourse::where('id',$id)->first();
        return view('course.admin.course.class.create',compact('cr_details_data','trainers','syllabus_id'));
    }

    public function store(Request $request,$id,$syllabus_id){

        try {
            $cr_details_data = CrCourse::where('id',$id)->first();
            
            if($request->class_mode == "online"){
                if($request->online_mode == 'google-meet'){
                    $request->session()->put('syllabus-meeting-data',[
                        'class_mode'=>$request->class_mode,
                        'class_name'=>$request->name,
                        'syllabus_id'=>$syllabus_id,
                        'class_date'=>$request->class_date,
                        'course_id'=>$cr_details_data->id,
                        'trainer_user_id'=>$request->trainer_user_id,
                        'topic'=>$request->meeting_topic,
                        'agenda'=>$request->meeting_agenda,
                        'meeting_start_time'=>$request->meeting_start_time,
                        'meeting_end_time'=>$request->meeting_end_time,
                        'online_mode'=>$request->online_mode
                    ]);
    
                    $jsonFilePath = base_path('app/Credentials/meeting-system.json');
    
                    $client = new Google_Client();
                    $client->setAuthConfig($jsonFilePath);
                    $client->setRedirectUri('http://127.0.0.1:8000/course/google-meet-callback');
                    $client->addScope(Google_Service_Calendar::CALENDAR);

                    $authUrl = $client->createAuthUrl();
                    return redirect($authUrl);
                }else{
                    $request->session()->put('syllabus-meeting-data',[
                        'class_mode'=>$request->class_mode,
                        'class_name'=>$request->name,
                        'syllabus_id'=>$syllabus_id,
                        'class_date'=>$request->class_date,
                        'course_id'=>$cr_details_data->id,
                        'trainer_user_id'=>$request->trainer_user_id,
                        'topic'=>$request->meeting_topic,
                        'agenda'=>$request->meeting_agenda,
                        'meeting_start_time'=>$request->meeting_start_time,
                        'meeting_duration'=>$request->meeting_duration,
                        'host_video'=>$request->host_video,
                        'participant_video'=>$request->participant_video,
                        'online_mode'=>$request->online_mode
                    ]);
    
                    $zoomKey = '4VgPzeBeQ3T9RyMXgwekw';
                    $zoomRedirectUri = 'http://127.0.0.1:8000/course/zoom/oauthredirect';
                    $zoomAuthUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id=$zoomKey&redirect_uri=$zoomRedirectUri";
                    return redirect()->away($zoomAuthUrl);
                }
            }else{
                $data = new CrSyllabusClass();
                $data->class_mode = $request->class_mode;
                $data->class_name = $request->name;
                $data->class_date = $request->class_date; 
                $data->course_id = $cr_details_data->id;
                $data->trainer_user_id = $request->trainer_user_id;
                $data->syllabus_id = $syllabus_id;
                $data->save();
    
                Session::flash('success', 'Class added successfully');
                return redirect()->route('course.admin.course-view.class',['id'=>$cr_details_data->id,'syllabus_id'=>$syllabus_id]);
            }
        } catch (\Throwable $th) {
            Session::flash('error', "Somethings went's wrong !");
            return redirect()->back();
        }
    }
}
