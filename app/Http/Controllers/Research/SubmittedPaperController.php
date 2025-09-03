<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Research\RpSubmittedPaper;
use ZipArchive;
use Illuminate\Support\Facades\Storage;
use App\Models\Research\RpSubmittedPaperFile;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\File;
use Session;


class SubmittedPaperController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $submittedPapers = RpSubmittedPaper::with('user')->orderBy('id','desc')->get();

        return view('research.admin.papers.index',compact('submittedPapers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
       // return $request;
        $submittedPapers = RpSubmittedPaper::find($id);

        $submittedPapers->is_publish = $request->publish;
        $submittedPapers->issue_certificate = $request->issue_certificate;
        if($request->publish == '1'){
            $submittedPapers->publish_date = date('Y-m-d');
        }
        $submittedPapers->save();

        if($submittedPapers->save()){
            Session::flash('success','Paper updated successfully !');
            return redirect()->route('research.admin.submitted-papers.index');
        }else{
            Session::flash('error',"Something went's wrong !");
            return redirect()->route('research.admin.submitted-papers.index'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function downloadPapers($id){

       // Retrieve PDF files related to the given ID
       $files = RpSubmittedPaperFile::where('submitted_paper', $id)->get();

       // Create a new ZipArchive instance
       $zip = new ZipArchive;

       // Create a temporary file to store the zip data
       $tempZipFile = tempnam(sys_get_temp_dir(), 'pdfs');
       if ($zip->open($tempZipFile, ZipArchive::CREATE) === TRUE) {
           foreach ($files as $file) {
               $filePath = public_path('upload/research/papers/' . $file->files);
               if (file_exists($filePath)) {
                   // Add each PDF file to the zip archive
                   $zip->addFile($filePath, $file->files);
               }
           }
           $zip->close();
       }

       // Set the response headers for zip download
       $response = response()->download($tempZipFile, 'Papers.zip', ['Content-Type' => 'application/zip']);

       // Delete the temporary zip file after serving the download
       register_shutdown_function(function () use ($tempZipFile) {
           File::delete($tempZipFile);
       });

       return $response;
    }
}
