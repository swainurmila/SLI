<?php

namespace App\Http\Controllers\Training\Admin;
use Illuminate\Http\Request;

use App\Models\Training\TrTrainingClass;

use App\Models\Training\TrainingImages;
use App\Models\Training\TrBatch;
use App\Models\Training\TrTrainingDetail;
use App\Models\Training\TrClassEbook;
use App\Models\Training\TrClassMedia;
use App\Models\Training\TrPublicMedia;
use App\Models\Training\TrClassAssignment;
use PDF;
//use Dompdf\Dompdf;
use App\Models\Training\TrTrainingOrder;

use App\Models\Training\TrCertificateSetting;
use App\Models\Training\TrTraining;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Training\TrAssignmentAnswer;
use App\Http\Controllers\Controller;

use Session;
use Auth;
use DB;
use Google_Client;
use Google_Service_Calendar;
use Carbon\Carbon;

// use App\Models\User;

use App\Mail\Training\TrainerClass;
use Illuminate\Support\Facades\Mail;
class ClassController extends Controller
{
    public function index($id){

        $classes = TrTrainingClass::with('meetingDetails','trainerDetails')->where('training_details_id',$id)->get();
        $i = 0;
        $tr_details_data = TrTrainingDetail::with('training','batch')->where('id',$id)->first();

        if(Auth::user()->role_id == 5){
        return view('training.traininguser.profile.classes.index',compact('id','classes','i'));
        }
        return view('training.training-master.training.classes.index',compact('id','classes','i','tr_details_data'));
    }

    public function show(Request $request , $id){

        $training_class = TrTrainingClass::with('training','batch','trainingDetail')->where('id',$id)->first();
        // dd($training_class);

        $training_class_mediaes = TrClassMedia::where('class_id',$id)->get();


        $training_class_ebook = TrClassEbook::where('class_id',$id)->get();
        // dd($training_class);
        if(Auth::user()->role_id == 5){
            $training_class_Assignment = TrClassAssignment::with('assignmentAnswer')->where('class_id',$id)->where('last_submission_date' ,">=", Carbon::today()->format('Y-m-d') )->get();

            return view('training.traininguser.profile.classes.view',compact('id','training_class','training_class_mediaes','training_class_ebook','training_class_Assignment'));
        }

        $training_class_Assignment = TrClassAssignment::where('class_id',$id)->get();
        return view('training.training-master.training.classes.view',compact('id','training_class','training_class_mediaes','training_class_ebook','training_class_Assignment'));
    }

    public function store(Request $request)
    {

        // $data = $this->validate($request, [
        //     'trainer_user_id' => 'required',
        //     'class_mode' => 'required',
        //     'name' => 'required',
        //     'class_date' => 'required',
        //     'meeting_topic'=>'required_if:class_mode,online',
        //     'meeting_agenda'=>'required_if:class_mode,online',
        //     // 'meeting_start_time'=>'required_if:class_mode,online',
        //     // 'meeting_end_time'=>'required_if:class_mode,online|required_if:online_mode,google-meet',
        //     // 'meeting_duration'=>'required_if:class_mode,online|required_if:online_mode,zoom',
        //     // 'host_video'=>'required_if:class_mode,online|required_if:online_mode,zoom',
        //     // 'participant_video'=>'required_if:class_mode,online|required_if:online_mode,zoom',
        //     'online_mode'=>'required_if:class_mode,online'
        // ]);



        $batch_data =  TrTrainingDetail::where('id',$request->batch_details_id)->first();
        // dd($request->all());


        $traing_data = TrBatch::where('id',$batch_data->batch_id)->first();
        if($traing_data){
            $total_class = TrTrainingClass::where('training_details_id',$request->batch_details_id)->count();
            if($total_class == $traing_data->total_class){
                Session::flash('error', "Oops! You've exceeded the limit for the total number of classes.");
                return redirect()->back();
            }else{

                if($request->class_mode == "online"){

                    if($request->online_mode == 'google-meet'){
                        $request->session()->put('meeting-data',[
                            'class_mode'=>$request->class_mode,
                            'class_name'=>$request->class_name,
                            'class_date'=>$request->class_date,
                            'training_id'=>$traing_data->training_id,
                            'trainer_user_id'=>$request->trainer_user_id,
                            'batch_id'=>$batch_data->batch_id,
                            'training_details_id'=>$request->batch_details_id,
                            'topic'=>$request->meeting_topic,
                            'agenda'=>$request->meeting_agenda,
                            'meeting_start_time'=>$request->meeting_start_time,
                            'meeting_end_time'=>$request->meeting_end_time,
                            'online_mode'=>$request->online_mode
                        ]);

                        $jsonFilePath = base_path('app/Credentials/meeting-system.json');

                        $client = new Google_Client();
                        $client->setAuthConfig($jsonFilePath);
                        $client->setRedirectUri('http://127.0.0.1:8000/portal/training/google-meet-callback');
                        $client->addScope(Google_Service_Calendar::CALENDAR);
                        $authUrl = $client->createAuthUrl();
                        return redirect($authUrl);
                    }else{
                        $request->session()->put('meeting-data',[
                            'class_mode'=>$request->class_mode,
                            'class_name'=>$request->class_name,
                            'class_date'=>$request->class_date,
                            'training_id'=>$traing_data->training_id,
                            'trainer_user_id'=>$request->trainer_user_id,
                            'batch_id'=>$batch_data->batch_id,
                            'training_details_id'=>$request->batch_details_id,
                            'topic'=>$request->meeting_topic,
                            'agenda'=>$request->meeting_agenda,
                            'meeting_start_time'=>$request->meeting_start_time,
                            'meeting_duration'=>$request->meeting_duration,
                            'host_video'=>$request->host_video,
                            'participant_video'=>$request->participant_video,
                            'online_mode'=>$request->online_mode
                        ]);

                        $zoomKey = '4VgPzeBeQ3T9RyMXgwekw';
                        $zoomRedirectUri = 'http://127.0.0.1:8000/portal/training/zoom/oauthredirect';
                        $zoomAuthUrl = "https://zoom.us/oauth/authorize?response_type=code&client_id=$zoomKey&redirect_uri=$zoomRedirectUri";
                        return redirect()->away($zoomAuthUrl);
                    }

                    $data = new TrTrainingClass();
                    $data->class_mode = $request->class_mode;
                    $data->class_name = $request->class_name;
                    $data->class_date = $request->class_date;
                    $data->training_id = $traing_data->training_id;
                    $data->trainer_user_id = $request->trainer_user_id;



                    $batch_data =  TrTrainingDetail::where('id',$request->batch_details_id)->first();




                    $traner_data = User::where('id',$request->trainer_user_id)->first();
                    $email = 'akshey97761@gmail.com';
                    $traing_data = TrTraining::where('id',$traing_data->training_id)->first();
                    // $traner_data->email;
                    $mailData = [
                        'username' => $traner_data->first_name.' '.$traner_data->last_name,
                        'traing_name' => $traing_data->name,
                        'class_date'=>$request->class_date,

                        'class_link'=>$request->class_link,
                        'url' => "URL::to('/login')",
                        'password'=>$request->input('password'),

                    ];
                    // return $mailData;
                    Mail::to($email)->send(new TrainerClass($mailData));

                    $data->batch_id = $batch_data->batch_id;
                    $data->training_details_id = $request->batch_details_id;
                    $data->save();

                    Session::flash('success', trans('Class added successfully'));
                    return redirect()->route('training.admin.class.list',$request->batch_details_id);

                }else{
                    $data = new TrTrainingClass();
                    $data->class_mode = $request->class_mode;
                    $data->class_name = $request->class_name;
                    $data->class_date = $request->class_date;
                    $data->training_id = $traing_data->training_id;
                    $data->trainer_user_id = $request->trainer_user_id;
                    $data->batch_id = $batch_data->batch_id;
                    $data->training_details_id = $request->batch_details_id;
                    $data->save();

                    Session::flash('success', trans('Class added successfully'));

                    return redirect()->route('training.admin.class.list',$request->batch_details_id);
                }


            }
        }

    }

    public function create($id){

        $classes = TrTrainingClass::where('training_details_id',$id)->get();
        $i = 0;
        $tr_details_data = TrTrainingDetail::where('id',$id)->first();

        $user_detail_approve = User::where('role_id', 6)->where('status',1)->where('is_delete','2')->orderBy('registration_no', 'desc')->where('is_training','1')->get();
        return view('training.training-master.training.classes.create',compact('id','classes','i','tr_details_data','user_detail_approve'));
    }


    public function edit($id){

        $classes_data = TrTrainingClass::where('id',$id)->first();
        $i = 0;
        // $tr_details_data = TrTrainingDetail::where('id',$id)->first();

        $user_detail_approve = User::where('role_id', 6)->where('status',1)->orderBy('registration_no', 'desc')->get();
        return view('training.training-master.training.classes.edit',compact('id','i','classes_data','user_detail_approve'));
    }

    public function mediaStore(Request $request)
    {

        // dd($request->rack_no[0]);


        $data = $this->validate($request, [
            'media_title' => 'required',
            'media_type' => 'required',
            'media_file' => 'required|mimes:mp3,mp4|max:2048',

        ]);

        // $class_data = TrTrainingClass::where('id',$request->class_id)->first();
        $class_data = TrTrainingClass::where('id',$request->class_id)->first();
        $batch_detail =  TrTrainingDetail::where('id',$class_data->training_details_id)->first();

        $batch_data = TrBatch::where('id',$batch_detail->batch_id)->first();


        if ($request->file('media_file')) {
            $data = $request->file('media_file');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . uniqid(rand()) . '.' . $extension;
            $path = public_path('public/upload/media_file');
            $upload_success = $data->move($path, $filename);
            $media_file = '/public/upload/media_file/' . $filename;


            $data = new TrClassMedia();
            $data->class_id = $request->class_id;
            $data->training_details_id =  $batch_detail->id;
            $data->media_title = $request->media_title;
            $data->media_type = $request->media_type;
            $data->media_file = $filename;
            $data->save();


            Session::flash('success', 'Video/Audio Added Successfully');
            return redirect()->route('training.admin.class.view',$request->class_id);
        }else{
            Session::flash('error', 'Something wents wrong !');
            return redirect()->route('training.admin.class.view',$request->class_id);
        }





    }

    public function eBookStore(Request $request)
    {

        $data = $this->validate($request, [
            'ebook_name' => 'required',
            'ebook_material' => 'required'

        ]);

        $class_data = TrTrainingClass::where('id',$request->class_id)->first();
        $batch_detail =  TrTrainingDetail::where('id',$class_data->training_details_id)->first();

        $batch_data = TrBatch::where('id',$batch_detail->batch_id)->first();


        if ($request->file('ebook_material')) {
            $data = $request->file('ebook_material');
            $extension = $data->getClientOriginalExtension();
            $filename = time() . uniqid(rand()) . '.' . $extension;
            $path = public_path('public/upload/ebook_material');
            $upload_success = $data->move($path, $filename);
            $media_file = '/public/upload/ebook_material/' . $filename;
        }

        $data = new TrClassEbook();
        $data->class_id = $request->class_id;
        // $data->training_details_id=$batch_detail->training_details_id;

        $data->training_details_id=$batch_detail->id;

        $data->batch_id=$batch_detail->batch_id;
        $data->ebook_name = $request->ebook_name;
        $data->ebook_material = $filename;

        $data->save();


        Session::flash('success', 'E-Book Added Successfully');
        return redirect()->route('training.admin.class.view',$request->class_id);

    }


    public function assignmentStore(Request $request){

        $data = $this->validate($request, [
            'assignment_title'=>'required',
            'question_type' => 'required',
            'question_level'=>'required',
            'start_date'=>'required',
            'last_submission_date'=>'required',
            'pass_score'=>'required',
            'question_file'=>'required',

        ]);

        $class_data = TrTrainingClass::where('id',$request->class_id)->first();
        $batch_detail =  TrTrainingDetail::where('id',$class_data->training_details_id)->first();

        $batch_data = TrBatch::where('id',$batch_detail->batch_id)->first();

        $image = $request->file('question_file');
        $imageName = time().'.'.$image->extension();

        $image->move(public_path('uploads/question_file'), $imageName);


        $data = new TrClassAssignment();
        $data->assignment_title = $request->assignment_title;
        // $data->training_details_id=$batch_detail->training_details_id;

        $data->question_type = $request->question_type;
        $data->question_level=$request->question_level;
        $data->start_date=$request->start_date;
        $data->last_submission_date = $request->last_submission_date;
        $data->question_file = $imageName;
        $data->class_id = $request->class_id;
        $data->training_details_id=$batch_detail->id;
        $data->batch_id=$batch_detail->batch_id;
        $data->pass_score = $request->pass_score;

        $data->save();

        Session::flash('success', 'Assignment Added Successfully');
        return redirect()->back();
    }


    public function Certificate(Request $request, $id)
    {
        // Render the Blade view to HTML
        // dd($id);
        $user = User::with([
            'trainingOrders' => function ($query) use ($id) {
                $query->where('id', $id); // Add the condition here
            },
            'trainingOrders.batch.training.TrainingImage',
            'trainingOrders.batch.training.TrainingReviews',
            'trainingOrders.batch.trainingDetailsByBatch' => function ($query) {
                $query->whereHas('trainingClasses.trainingAttendance', function ($subquery) {
                    $subquery->where('attendance_type', '1');
                })->with(['trainingClasses' => function ($query) {
                    $query->with(['trainingAttendance' => function ($subquery) {
                        $subquery->where('attendance_type', '1');
                    }]);
                }]);
            },
        ])
        ->orderBy('id', 'desc')
        ->where('id', Auth::user()->id)
        ->first();

        $oder_data = TrTrainingOrder::where('id',$id)->first();

        $traing_data = TrTraining::where('id',$oder_data->training_id)->first();

        // $order =

        // dd($user);
        // echo print_r
        // print_r($user);
        // exit();
        $setting_data = TrCertificateSetting::first();
        // return view('training.traininguser.profile.classes.certificate',compact('user','oder_data','traing_data'));
        if($setting_data->template_id == 3){
        return view('training.traininguser.profile.classes.certificatetwo',compact('user','oder_data','traing_data'));}
        else{

        return view('training.traininguser.profile.classes.Certificate',compact('user','oder_data','traing_data'));
        }
        $html = view('training.traininguser.profile.classes.Certificate')->render();

        // Create a new Dompdf instance
        $pdf = PDF::loadView('training.traininguser.profile.classes.Certificate');

        // Set base path for assets
        // $pdf->setBasePath(public_path());

        // Load HTML content into Dompdf
        //$pdf->loadHtml($html);

        // (Optional) Set paper size and orientation
        $pdf->setPaper('A4', 'portrait');
        // $pdf->setPaper('landscape');
        $pdf->render();
        // Render PDF
        //$pdf->render();

        // Return the PDF as a stream for download
        return $pdf->download('certificate.pdf');
    }



    public function assignmentIndex($id,$assignment_id){

        $assignment_answers = TrAssignmentAnswer::with('trainingBatch.training','trainingClass','trainingUser')->where('class_id',$id)->where('assignment_id', $assignment_id)->get();
        return view('training.admin.student-assignment.index',compact('assignment_answers','id','assignment_id'));
    }

    public function studentAssignmentStore(Request $request,$id,$assignment_id)
    {
        $results = $request->input('results');
        $users = $request->input('users');

        foreach ($users as $key => $user) {
            if (isset($results[$key])) {
                $userId = $users[$key];


                $answer = TrAssignmentAnswer::where('user_id', $userId)
                                             ->where('assignment_id', $assignment_id)
                                             ->first();

                if ($answer) {
                    $answer->result = $results[$key];
                    $answer->save();
                }
            }
        }

        return redirect()->back();
    }


    public function studentAssignmentDownload($filename){

        $path = public_path('uploads/assignment-answer/' . $filename);


        if (file_exists($path)) {
            $headers = [
                'Content-Type' => 'image/jpeg',
            ];

            return response()->download($path, $filename, $headers);
        } else {

            return redirect()->back();
        }
    }
}
