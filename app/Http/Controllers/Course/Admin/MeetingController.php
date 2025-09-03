<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GoogleMeetingTrait;
use App\Traits\ZoomMeetingTrait;
use Google_Client;
use Google_Service_Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Google_Service_Calendar_ConferenceData;
use App\Models\Course\CrSyllabusClass;
use App\Models\Training\TrMeetingDetail;
use App\Models\Training\TrMeetingOauthDetail;
use Illuminate\Support\Facades\Http;

class MeetingController extends Controller
{
    use GoogleMeetingTrait;
    use ZoomMeetingTrait;


    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function googleHandleCallback(Request $request){
        $meetingData = $request->session()->get('syllabus-meeting-data');

        if (!$meetingData) {
            throw new \Exception('Meeting data not found .');
        }

        $jsonFilePath = base_path('app/Credentials/meeting-system.json');

        $client = new Google_Client();
        $client->setAuthConfig($jsonFilePath);
        $client->setRedirectUri('http://127.0.0.1:8000/course/google-meet-callback');
        $client->addScope(Google_Service_Calendar::CALENDAR);
    

        $courseId = $meetingData['course_id'];
        $syllabusId = $meetingData['syllabus_id'];

        try {
             if(isset($meetingData['id'])){
                $updateMeeting = $this->updateMeeting($client,request('code'),$meetingData);


                if($updateMeeting['success']){

                    $updateDetails = TrMeetingDetail::find($meetingData['id']);
                    $updateDetails->topic = $meetingData['topic'];
                    $updateDetails->agenda = $meetingData['agenda'];
                    $updateDetails->start_time =$meetingData['meeting_start_time'];
                    $updateDetails->end_time = $meetingData['meeting_end_time'];
                    $updateDetails->save();

                    $request->session()->forget('syllabus-meeting-data');
                    return redirect()->route('course.admin.course-view.class',['id'=>$courseId,'syllabus_id'=>$syllabusId])->with('success', 'Meeting successfully updated !');
                }
            }else{
                $createMeeting = $this->createMeeting($client,$meetingData,request('code'));


                if($createMeeting['success']){


                    $classDetails = new CrSyllabusClass;
                    $classDetails->class_mode = $meetingData['class_mode'];
                    $classDetails->class_name = $meetingData['class_name'];
                    $classDetails->class_date = $meetingData['class_date'];
                    $classDetails->course_id = $meetingData['course_id'];
                    $classDetails->syllabus_id = $meetingData['syllabus_id'];
                    $classDetails->trainer_user_id = $meetingData['trainer_user_id'];
                    $classDetails->save();

                    $meetingDetails = new TrMeetingDetail;
                    $meetingDetails->class_id = $classDetails->id;
                    $meetingDetails->meeting_for = 'course';
                    $meetingDetails->meeting_id = $createMeeting['meeting_id'];
                    $meetingDetails->topic = $meetingData['topic'];
                    $meetingDetails->agenda = $meetingData['agenda'];
                    $meetingDetails->start_time = $meetingData['meeting_start_time'];
                    $meetingDetails->end_time = $meetingData['meeting_end_time'];
                    $meetingDetails->start_url = null;
                    $meetingDetails->join_url = $createMeeting['meeting_link'];
                    $meetingDetails->meeting_password = null;
                    $meetingDetails->duration = null;
                    $meetingDetails->host_video = null;
                    $meetingDetails->participant_video = null;
                    $meetingDetails->save();

                    $request->session()->forget('syllabus-meeting-data');
                    return redirect()->route('course.admin.course-view.class',['id'=>$courseId,'syllabus_id'=>$syllabusId])->with('success', 'Meeting successfully created !');
                }

            }  
        } catch (\Throwable $th) {
            return redirect()->route('course.admin.course-view.class.create',['id'=>$courseId,'syllabus_id'=>$syllabusId])->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function googleMeetingUpdate(Request $request,$id){

        $request->session()->put('syllabus-meeting-data',[
            'id'=>$id,
            'course_id'=>$request->course_id,
            'syllabus_id'=>$request->syllabus_id,
            'meeting_id'=>$request->meeting_id,
            'class_date'=>$request->class_date,
            'topic'=>$request->topic,
            'agenda'=>$request->agenda,
            'meeting_start_time'=>$request->meeting_start_time,
            'meeting_end_time'=>$request->meeting_end_time,
        ]);


        $jsonFilePath = base_path('app/Credentials/meeting-system.json');

        $client = new Google_Client();
        $client->setAuthConfig($jsonFilePath);
        $client->setRedirectUri('http://127.0.0.1:8000/course/google-meet-callback');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $authUrl = $client->createAuthUrl();
        
        return redirect($authUrl);
    }


    public function zoomHandleCallback(Request $request){

        $meetingData = $request->session()->get('syllabus-meeting-data');

        if (!$meetingData) {
            throw new \Exception('Meeting data not found .');
        }

        try {

            $courseId = $meetingData['course_id'];
            $syllabusId = $meetingData['syllabus_id'];

            $zoomAuthMeeting = TrMeetingOauthDetail::where('meeting_for','zoom')->where('module_for','course')->first();

            if($zoomAuthMeeting){
                $meeting = $this->generateRefreshToken($zoomAuthMeeting);
                
                if($meeting && $meetingData){
                    $createMeeting = $this->createZoomMeeting($meetingData,$meeting['access_token']);

                    $classDetails = new CrSyllabusClass;
                    $classDetails->class_mode = $meetingData['class_mode'];
                    $classDetails->class_name = $meetingData['class_name'];
                    $classDetails->class_date = $meetingData['class_date'];
                    $classDetails->course_id = $meetingData['course_id'];
                    $classDetails->syllabus_id = $meetingData['syllabus_id'];
                    $classDetails->trainer_user_id = $meetingData['trainer_user_id'];
                    $classDetails->save();

                    $meetingDetails = new TrMeetingDetail;
                    $meetingDetails->class_id = $classDetails->id;
                    $meetingDetails->meeting_for = 'course';
                    $meetingDetails->meeting_id = $createMeeting['data']['id'];
                    $meetingDetails->topic = $createMeeting['data']['topic'];
                    $meetingDetails->agenda = $createMeeting['data']['agenda'];
                    $meetingDetails->start_time = $meetingData['meeting_start_time'];
                    $meetingDetails->start_url = $createMeeting['data']['start_url'];
                    $meetingDetails->join_url = $createMeeting['data']['join_url'];
                    $meetingDetails->meeting_password = $createMeeting['data']['password'];
                    $meetingDetails->duration = $createMeeting['data']['duration'];
                    $meetingDetails->host_video = $createMeeting['data']['settings']['host_video'];
                    $meetingDetails->participant_video = $createMeeting['data']['settings']['participant_video'];
                    $meetingDetails->save();
                    
                    $request->session()->forget('syllabus-meeting-data');
                    return redirect()->route('course.admin.course-view.class',['id'=>$courseId,'syllabus_id'=>$syllabusId])->with('success', 'Meeting successfully created !');
                }
            }else{
        

                // $meeting = $this->generateZoomToken($request->all());
                $zoomKey = '4VgPzeBeQ3T9RyMXgwekw';
                $zoomSecret = '533b3zbVuSwtVqPJ46KJm615nbQD5cb8';
                $zoomRedirectUri = 'http://127.0.0.1:8000/course/zoom/oauthredirect';
                $authorizationCode = request('code');
                $response = Http::asForm()->post('https://zoom.us/oauth/token', [
                    'grant_type' => 'authorization_code',
                    'code' => $authorizationCode,
                    'redirect_uri' => $zoomRedirectUri,
                    'client_id' => $zoomKey,
                    'client_secret' => $zoomSecret,
                ]);

                $zoomData = $response->json();

                if(count($zoomData) > 0 && count($meetingData) > 0){

                    $meeting_auth = new TrMeetingOauthDetail;
                    $meeting_auth->access_token = $zoomData['access_token'];
                    $meeting_auth->refresh_token = $zoomData['refresh_token'];
                    $meeting_auth->scope = $zoomData['scope'];
                    $meeting_auth->meeting_for = 'zoom';
                    $meeting_auth->module_for = 'course';
                    $meeting_auth->save();

                    
                    if($meeting_auth->save()){

                        $createMeeting = $this->createZoomMeeting($meetingData,$zoomData['access_token']);

                        
                        if($createMeeting['success']){

                            $classDetails = new CrSyllabusClass;
                            $classDetails->class_mode = $meetingData['class_mode'];
                            $classDetails->class_name = $meetingData['class_name'];
                            $classDetails->class_date = $meetingData['class_date'];
                            $classDetails->course_id = $meetingData['course_id'];
                            $classDetails->syllabus_id = $meetingData['syllabus_id'];
                            $classDetails->trainer_user_id = $meetingData['trainer_user_id'];
                            $classDetails->save();

                            $meetingDetails = new TrMeetingDetail;
                            $meetingDetails->class_id = $classDetails->id;
                            $meetingDetails->meeting_for = 'course';
                            $meetingDetails->meeting_id = $createMeeting['data']['id'];
                            $meetingDetails->topic = $createMeeting['data']['topic'];
                            $meetingDetails->agenda = $createMeeting['data']['agenda'];
                            $meetingDetails->start_time = $meetingData['meeting_start_time'];
                            $meetingDetails->start_url = $createMeeting['data']['start_url'];
                            $meetingDetails->join_url = $createMeeting['data']['join_url'];
                            $meetingDetails->meeting_password = $createMeeting['data']['password'];
                            $meetingDetails->duration = $createMeeting['data']['duration'];
                            $meetingDetails->host_video = $createMeeting['data']['settings']['host_video'];
                            $meetingDetails->participant_video = $createMeeting['data']['settings']['participant_video'];
                            $meetingDetails->save();

                            $request->session()->forget('syllabus-meeting-data');
                            return redirect()->route('course.admin.course-view.class',['id'=>$courseId,'syllabus_id'=>$syllabusId])->with('success', 'Meeting successfully created !');
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            return redirect()->route('course.admin.course-view.class.create',['id'=>$courseId,'syllabus_id'=>$syllabusId])->with('error', 'An error occurred. Please try again later.');
        }
    }

    public function zoomMeetingUpdate(Request $request,$id){
        $meetingDetails = TrMeetingDetail::find($id);
        $zoomAuthDetails = TrMeetingOauthDetail::where('meeting_for','zoom')->where('module_for','course')->first();

        if($meetingDetails && $zoomAuthDetails){
            $refreshAuthToken = $this->generateRefreshToken($zoomAuthDetails);

            if($refreshAuthToken){
                $zoomAuthDetails->access_token = $refreshAuthToken['access_token'];
                $zoomAuthDetails->refresh_token = $refreshAuthToken['refresh_token'];
                $zoomAuthDetails->scope = $refreshAuthToken['scope'];
                $zoomAuthDetails->meeting_for = 'zoom';
                $zoomAuthDetails->module_for = 'course';
                $zoomAuthDetails->save();

                if($zoomAuthDetails->save()){
                    $updateMeeting = $this->updateZoomMeeting($zoomAuthDetails->access_token,$request->all(),$request->meeting_id);

                    if($updateMeeting['success']){
                        $meetingDetails->topic = $request->topic;
                        $meetingDetails->agenda = $request->agenda;
                        $meetingDetails->start_time = $request->meeting_start_time;
                        $meetingDetails->duration = $request->meeting_duration;
                        $meetingDetails->host_video = $request->host_video;
                        $meetingDetails->participant_video = $request->participant_video;
                        $meetingDetails->save();
                        return redirect()->back()->with('success', 'Meeting updated successfully.');
                    }else{
                        return redirect()->back()->with('error', 'Failed to update meeting.');
                    }
                }else{
                    return redirect()->back()->with('error', 'Failed to update Zoom OAuth details.');
                }
            }else{
                return redirect()->back()->with('error', 'Failed to generate refresh token.');
            }
        }else{
            return redirect()->back()->with('error', 'Meeting details or Zoom OAuth details not found.');
        }
    }
}
