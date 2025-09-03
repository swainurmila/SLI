<?php

namespace App\Traits;

use GuzzleHttp\Client;
use Log;
use Firebase\JWT\JWT;
use App\Models\Training\TrMeetingOauthDetail;
use Illuminate\Support\Facades\Http;

/**
 * trait ZoomMeetingTrait
 */
trait ZoomMeetingTrait
{
    public $client;
    public $jwt;
    public $headers;

    public function generateZoomToken($data)
    {       
        $zoomKey = '4VgPzeBeQ3T9RyMXgwekw';
        $zoomSecret = '533b3zbVuSwtVqPJ46KJm615nbQD5cb8';
        $zoomRedirectUri = 'http://127.0.0.1:8000/portal/training/zoom/oauthredirect';

        if(isset($data['refreshCode'])){
            $authorizationCode = $data['refreshCode'];
    
            $response = Http::asForm()->post('https://zoom.us/oauth/token', [
                'grant_type' => 'authorization_code',
                'code' => $authorizationCode,
                'redirect_uri' => $zoomRedirectUri,
                'client_id' => $zoomKey,
                'client_secret' => $zoomSecret,
            ]);
    
            $zoomData = $response->json();
    
            if($zoomData){
                return $zoomData;
            }else{
                return '';
            }
        }else{
            
            $authorizationCode = $data['code'];
    
            $response = Http::asForm()->post('https://zoom.us/oauth/token', [
                'grant_type' => 'authorization_code',
                'code' => $authorizationCode,
                'redirect_uri' => $zoomRedirectUri,
                'client_id' => $zoomKey,
                'client_secret' => $zoomSecret,
            ]);
    
            $zoomData = $response->json();
    
            if($zoomData){
                $meeting_auth = new TrMeetingOauthDetail;
                $meeting_auth->access_token = $zoomData['access_token'];
                $meeting_auth->refresh_token = $zoomData['refresh_token'];
                $meeting_auth->scope = $zoomData['scope'];
                $meeting_auth->meeting_for = 'zoom';
                $meeting_auth->module_for = 'training';
                $meeting_auth->save();
    
                return $meeting_auth;
            }else{
                return '';
            }
        }

    }

    public function generateRefreshToken($authDetails)
    {
        $zoomKey = '4VgPzeBeQ3T9RyMXgwekw';
        $zoomSecret = '533b3zbVuSwtVqPJ46KJm615nbQD5cb8';
        $zoomRedirectUri = 'http://127.0.0.1:8000/portal/training/zoom/oauthredirect';
        $response = Http::asForm()->post('https://zoom.us/oauth/token', [
            'grant_type' => 'refresh_token',
            "refresh_token" => $authDetails->refresh_token,
            'client_id' => $zoomKey,
            'client_secret' => $zoomSecret,
        ]);
        $zoomData = $response->json();

        // dd($zoomData);
        if($zoomData['error']){
            $data=[
                'refreshCode'=>request('code')
            ];
            $refreshToken = $this->generateZoomToken($data);
            return $refreshToken;
        }else{
            if($zoomData){
                return $zoomData;
            }else{
                return '';
            }
        }
    }

    // public function redirectToZoom()
    // {
    //     $zoomKey = env('ZOOM_API_KEY', '');
    //     $zoomRedirectUri = env('ZOOM_REDIRECT_URL', '');
    //     $zoomAuthUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id=$zoomKey&redirect_uri=$zoomRedirectUri";

    //     return redirect()->away($zoomAuthUrl);
    // }

    private function retrieveZoomUrl()
    {
        return 'https://api.zoom.us/v2/';
    }

    public function toZoomTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);

            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('ZoomJWT->toZoomTimeFormat : '.$e->getMessage());

            return '';
        }
    }

    public function createZoomMeeting($data,$access_token)
    {   
        $path = 'users/me/meetings';
        $url = $this->retrieveZoomUrl();

        $body = [
            'topic'      => $data['topic'],
            'type'       => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($data['class_date']. ' ' .$data['meeting_start_time']),
            'duration'   => $data['meeting_duration'],
            'agenda'     => (! empty($data['agenda'])) ? $data['agenda'] : null,
            'timezone'     => 'Asia/Kolkata',
            'settings'   => [
                'host_video'        => ($data['host_video'] == "1") ? true : false,
                'participant_video' => ($data['participant_video'] == "1") ? true : false,
                'waiting_room'      => true,
            ],
        ];

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type'  => 'application/json',
            ])->post($url . $path, $body);

            return [
                'success' => $response->status() === 201,
                'data'    => $response->json(),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    public function updateZoomMeeting($access_token,$data,$id)
    {

        $path = 'meetings/'.$id;
        $url = $this->retrieveZoomUrl();

        $body = [
            'topic'      => $data['topic'],
            'type'       => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($data['class_date']. ' ' .$data['meeting_start_time']),
            'duration'   => $data['meeting_duration'],
            'agenda'     => (! empty($data['agenda'])) ? $data['agenda'] : null,
            'timezone'     => 'Asia/Kolkata',
            'settings'   => [
                'host_video'        => ($data['host_video'] == "1") ? true : false,
                'participant_video' => ($data['participant_video'] == "1") ? true : false,
                'waiting_room'      => true,
            ],
        ];
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $access_token,
                'Content-Type'  => 'application/json',
            ])->patch($url . $path, $body);
            return [
                'success' => $response->status() === 204,
                'data'    => json_decode($response->getBody(), true),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    public function get($id)
    {
        $path = 'meetings/'.$id;
        $url = $this->retrieveZoomUrl();
        $this->jwt = $this->generateZoomToken();
        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([]),
        ];

        $response =  $this->client->get($url.$path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
            'data'    => json_decode($response->getBody(), true),
        ];
    }

    /**
     * @param string $id
     * 
     * @return bool[]
     */
    public function delete($id)
    {
        $path = 'meetings/'.$id;
        $url = $this->retrieveZoomUrl();
        $body = [
            'headers' => $this->headers,
            'body'    => json_encode([]),
        ];

        $response =  $this->client->delete($url.$path, $body);

        return [
            'success' => $response->getStatusCode() === 204,
        ];
    }
}