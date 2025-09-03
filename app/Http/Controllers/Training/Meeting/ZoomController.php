<?php

namespace App\Http\Controllers\Training\Meeting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ZoomMeetingTrait;
use Illuminate\Support\Facades\Http;
use App\Models\Training\TrMeetingOauthDetail;
use App\Models\Training\TrTrainingClass;

use App\Models\Training\TrMeetingDetail;


class ZoomController extends Controller
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;



    public function create(Request $request){

        $meeting = $this->createZoomMeeting($request->all());


        return response()->json($meeting);

    }



    public function redirectToZoom(){
        $zoomKey = env('ZOOM_API_CLIENT', '');
        $zoomRedirectUri = env('ZOOM_REDIRECT_URL', '');
        $zoomAuthUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id=$zoomKey&redirect_uri=$zoomRedirectUri";
        return redirect()->away($zoomAuthUrl);
    }


    public function handleZoomCallback(Request $request)
    {   

        $meetingData = $request->session()->get('meeting-data');

        // dd($request->all());
        try {
            $zoomAuthMeeting = TrMeetingOauthDetail::where('meeting_for','zoom')->where('module_for','training')->orderBy('id','desc')->first();

            if($zoomAuthMeeting){
                // dd($zoomAuthMeeting);
                $meeting = $this->generateRefreshToken($zoomAuthMeeting);
                
                if($meeting && $meetingData){

                    $createMeeting = $this->createZoomMeeting($meetingData,$meeting['access_token']);



                    $training_id = $meetingData['training_details_id'];

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
                    $meetingDetails->meeting_for = 'training';
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


                    // dd($meetingDetails);

                    
                    // $this->request->session()->forget('meeting-data');

                    session()->forget('meeting-data');
                    

                    return redirect()->route('training.admin.class.list',$training_id);
                    
                }
            }else{

                // $meeting = $this->generateZoomToken($request->all());
                $zoomKey = '4VgPzeBeQ3T9RyMXgwekw';
                $zoomSecret = '533b3zbVuSwtVqPJ46KJm615nbQD5cb8';
                $zoomRedirectUri = 'http://127.0.0.1:8000/portal/training/zoom/oauthredirect';
                $authorizationCode = request('code');
                $response = Http::asForm()->post('https://zoom.us/oauth/token', [
                    'grant_type' => 'authorization_code',
                    'code' => $authorizationCode,
                    'redirect_uri' => $zoomRedirectUri,
                    'client_id' => $zoomKey,
                    'client_secret' => $zoomSecret,
                ]);

                $zoomData = $response->json();

                if($zoomData && $meetingData){
                    $meeting_auth = new TrMeetingOauthDetail;
                    $meeting_auth->access_token = $zoomData['access_token'];
                    $meeting_auth->refresh_token = $zoomData['refresh_token'];
                    $meeting_auth->scope = $zoomData['scope'];
                    $meeting_auth->meeting_for = 'zoom';
                    $meeting_auth->module_for = 'training';
                    $meeting_auth->save();

                    
                    if($meeting_auth->save()){
                        $createMeeting = $this->createZoomMeeting($meetingData,$zoomData['access_token']);

                        $training_id = $meetingData['training_details_id'];
                        
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
                            $meetingDetails->meeting_for = 'training';
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

                            session()->forget('meeting-data');
                            return redirect()->route('training.admin.class.list',$training_id);
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            return redirect()->route('training.admin.class.create',$meetingData['training_details_id'])->with('error', 'An error occurred. Please try again later.');
        }
    }



    public function update(Request $request,$id){

        $meetingDetails = TrMeetingDetail::find($id);
        $zoomAuthDetails = TrMeetingOauthDetail::where('meeting_for','zoom')->where('module_for','training')->first();

        if($meetingDetails && $zoomAuthDetails){
            $refreshAuthToken = $this->generateRefreshToken($zoomAuthDetails);

            if($refreshAuthToken){
                $zoomAuthDetails->access_token = $refreshAuthToken['access_token'];
                $zoomAuthDetails->refresh_token = $refreshAuthToken['refresh_token'];
                $zoomAuthDetails->scope = $refreshAuthToken['scope'];
                $zoomAuthDetails->meeting_for = 'zoom';
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
