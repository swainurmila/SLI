<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Research\RpSubmittedPaper;
use App\Models\Research\RpSubmittedPaperFile;
use App\Models\Research\RpPaperNotification;
use Session;
use Auth;
use App\Models\Research\RpSubjectCategory;

class PaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = now();
        $notifications = RpPaperNotification::orderBy('id', 'desc')
            ->where('start_date', '<=', $currentDate)
            ->where('end_date', '>=', $currentDate)
            ->get();
       
        $submittedPapers = RpSubmittedPaper::orderBy('id','desc')->where('user_id', Auth::user()->id)->get();


        return view('research.user.paper.index',compact('notifications','submittedPapers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $subjectCategory = RpSubjectCategory::where('status','1')->where('is_delete', 0)->get();
        return view('research.user.paper.create',compact('subjectCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'paper_title' => 'required|string',
                'subject_category_id'=>'required',
                'papers.*' => 'required|mimes:pdf|max:5120',
                'are_you_a'=>'required',
                'description'=>'required'
            ]);


            $notificationDate = RpPaperNotification::where('start_date','<=',date('Y-m-d'))->where('end_date',">=",date('Y-m-d'))->first();

            $paper = new RpSubmittedPaper;
            $paper->user_id = Auth::user()->id;
            $paper->notification_id = $notificationDate->id;
            $paper->paper_title = $request->paper_title;
            $paper->subject_category = $request->subject_category_id;
            $paper->are_you_a = $request->are_you_a;
            $paper->description = $request->description;

            $paper->save();

            if($paper->save()){

                if($request->hasfile('papers'))
                 {
                    $files = $request->file('papers');
                    foreach($files as $file)
                    {
                        if($file){

                            $fileName = time().'_'.$file->getClientOriginalName();

                            $file->move(public_path('upload/research/papers'), $fileName);

                            $paper_files = new RpSubmittedPaperFile;
                            $paper_files->files= $fileName;
                            $paper_files->submitted_paper = $paper->id;
                            $paper_files->save();
                        }
                    }

                }

                Session::flash('success','Paper Notification Created Successfully !');
                return redirect()->route('research.admin.paper.index');
            }
        } catch (\Throwable $th) {
            Session::flash('error','Something wents wrong!');
            return redirect()->back();
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
