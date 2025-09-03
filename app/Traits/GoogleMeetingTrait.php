<?php

namespace App\Traits;
use GuzzleHttp\Client;
use Log;
use App\Models\Training\TrMeetingOauthDetail;
use Illuminate\Support\Facades\Http;
use Google_Service_Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use Google_Service_Calendar_ConferenceData;
use App\Models\Training\TrMeetingDetail;
use App\Models\Training\TrTrainingClass;
use Session;

/**
 * trait v
 */
trait GoogleMeetingTrait
{

    public function toGoogleTimeFormat(string $dateTime)
    {
        try {
            $date = new \DateTime($dateTime);
            return $date->format('Y-m-d\TH:i:s');
        } catch (\Exception $e) {
            Log::error('GoogleTimeFormat : '.$e->getMessage());
            return '';
        }
    }

    public function createMeeting($client,$data,$code)
    {       
        $client->authenticate($code);
        $accessToken = $client->getAccessToken();
        $client->setAccessToken($accessToken);
        $calendarService = new Google_Service_Calendar($client);
        $event = new Event([
            'summary' => $data['topic'],
            'description'=>$data['agenda'],
            'start' => new EventDateTime([
                'dateTime' => $this->toGoogleTimeFormat($data['class_date']. ' ' .$data['meeting_start_time']),
                'timeZone' => 'Asia/Kolkata',
            ]),
            'end' => new EventDateTime([
                'dateTime' => $this->toGoogleTimeFormat($data['class_date']. ' ' .$data['meeting_end_time']),
                'timeZone' => 'Asia/Kolkata',
            ]),
            'conferenceData' => new Google_Service_Calendar_ConferenceData([
                'createRequest' => [
                    'conferenceSolutionKey' => [
                        'type' => 'hangoutsMeet'
                    ],
                    'requestId' => uniqid(),
                ]
            ])
        ]);
        
        $calendarId = 'primary'; 
        $createdEvent = $calendarService->events->insert($calendarId, $event, ['conferenceDataVersion' => 1]);
        $eventId = $createdEvent->getId();
        $meetLink = $createdEvent->getHangoutLink();


        try {

            
            return [
                'success' => true,
                'meeting_link'=>$meetLink,
                'meeting_id'=>$eventId
            ];
        } catch (\Exception $e) {
            
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }

    }

    public function updateMeeting($client,$access_token,$meetingData)
    {

        $client->authenticate($access_token);

        $accessToken = $client->getAccessToken();

        $client->setAccessToken($accessToken);

        $calendarService = new Google_Service_Calendar($client);

        $event = $calendarService->events->get('primary', $meetingData['meeting_id']);

        $event->setSummary($meetingData['topic']);
        $event->setDescription($meetingData['agenda']);

        $startDateTime = new EventDateTime();
        $startDateTime->setDateTime($this->toGoogleTimeFormat($meetingData['class_date']. ' ' .$meetingData['meeting_start_time']));
        $startDateTime->setTimeZone('Asia/Kolkata');
        $event->setStart($startDateTime);
    
        $endDateTime = new EventDateTime();
        $endDateTime->setDateTime($this->toGoogleTimeFormat($meetingData['class_date']. ' ' .$meetingData['meeting_end_time']));
        $endDateTime->setTimeZone('Asia/Kolkata');
        $event->setEnd($endDateTime);

        // Update the event
        $updatedEvent = $calendarService->events->update('primary', $meetingData['meeting_id'], $event);
        try {
            

            return [
                'success' => true,
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

}