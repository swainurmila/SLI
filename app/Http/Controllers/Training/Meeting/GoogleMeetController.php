<?php

namespace App\Http\Controllers\Training\Meeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GoogleMeetingTrait;
use Google_Client;
use Google_Service_Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Google_Service_Calendar_ConferenceData;
use App\Models\Training\TrMeetingDetail;
use App\Models\Training\TrTrainingClass;



class GoogleMeetController extends Controller
{

    use GoogleMeetingTrait;

    public function handleCallback(Request $request){
        $meetingData = $request->session()->get('meeting-data');

        $jsonFilePath = base_path('app/Credentials/meeting-system.json');

        $client = new Google_Client();
        $client->setAuthConfig($jsonFilePath);
        $client->setRedirectUri('http://127.0.0.1:8000/training/google-meet-callback');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $trainingId = $meetingData['training_details_id'];

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

                    Session::forget('meeting-data');
                    return redirect()->route('training.admin.class.list',$trainingId)->with('success', 'Meeting successfully updated !');
                }
            }else{
                $createMeeting = $this->createMeeting($client,$meetingData,request('code'));


                if($createMeeting['success']){


                    $classDetails = new TrTrainingClass;
                    $classDetails->class_mode = $meetingData['class_mode'];
                    $classDetails->class_name = $meetingData['class_name'];
                    $classDetails->class_date = $meetingData['class_date'];
                    $classDetails->training_id = $meetingData['training_id'];
                    $classDetails->trainer_user_id = $meetingData['trainer_user_id'];
                    $classDetails->batch_id = $meetingData['batch_id'];
                    $classDetails->training_details_id = $meetingData['training_details_id'];
                    $classDetails->save();
                    $meetingDetails = new TrMeetingDetail;
                    $meetingDetails->class_id = $classDetails->id;
                    $meetingDetails->training_details_id = $classDetails->training_details_id;
                    $meetingDetails->meeting_id = $createMeeting['meeting_id'];
                    $meetingDetails->meeting_for = 'training';
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

                    Session::forget('meeting-data');
                    return redirect()->route('training.admin.class.list',$trainingId)->with('success', 'Meeting successfully created !');
                }

            }  
        } catch (\Throwable $th) {
            return redirect()->route('training.admin.class.list',$trainingId)->with('error', 'An error occurred. Please try again later.');
        }
    }


    public function update(Request $request,$id)
    {

        $request->session()->put('meeting-data',[
            'id'=>$id,
            'meeting_id'=>$request->meeting_id,
            'training_id'=>$request->training_id,
            'class_date'=>$request->class_date,
            'topic'=>$request->topic,
            'agenda'=>$request->agenda,
            'training_details_id'=>$request->training_details_id,
            'meeting_start_time'=>$request->meeting_start_time,
            'meeting_end_time'=>$request->meeting_end_time,
        ]);


        $jsonFilePath = base_path('app/Credentials/meeting-system.json');

        $client = new Google_Client();
        $client->setAuthConfig($jsonFilePath);
        $client->setRedirectUri('http://127.0.0.1:8000/training/google-meet-callback');
        $client->addScope(Google_Service_Calendar::CALENDAR);

        $authUrl = $client->createAuthUrl();
        
        return redirect($authUrl);
    }
}
