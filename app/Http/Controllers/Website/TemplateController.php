<?php

namespace App\Http\Controllers\Website;

use App\Models\Website\PageTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TemplateController extends Controller
{
    public function page_template()
    {
        // return 1;
        $pageTemplate = PageTemplate::all();
        return view('admin.pageTemplate.index', compact('pageTemplate'));
    }

    public function temp_create()
    {
        return view('admin.pageTemplate.create');
    }

    public function temp_store(Request $request)
    {
        $data = [
            'temp_name' => $request->name
        ];



        PageTemplate::create($data);
        $folderPath = resource_path('views/admin/templates');
        if (File::isDirectory($folderPath)) {
            //return 1;
            $lastInsertedData = PageTemplate::latest()->first();
            $fileName =  $lastInsertedData->temp_slug.'.blade.php';
            $filePath = $folderPath.'/'.$fileName;

            $fileContents = '<h1>File contents</h1>';
            File::put($filePath, $fileContents);
        } else {

            //return 'false';

           // File::makeDirectory($folderPath);
            File::makeDirectory($folderPath, 0777, true, true);
            $lastInsertedData = PageTemplate::latest()->first();

            $fileName =  $lastInsertedData->temp_slug.'.blade.php';
            $filePath = $folderPath.'/'.$fileName;
            $fileContents = 'File contents';
            File::put($filePath, $fileContents);
        }
        return redirect()->route('page.template');
    }

    public function temp_destroy(Request $request, $id)
    {
        //return $id;
        $template = PageTemplate::find($id);
        $template->delete();
        return redirect()->back();
    }
}
