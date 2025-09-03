<?php

namespace App\Http\Controllers\Eoffice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\e_office\FileFormat;

class FileFormatController extends Controller
{
    public function fileMaster()
    {

        $file = FileFormat::where('is_delete', 0)->get();
        return view("Eoffice.fileformatmaster", compact('file'));
    }

    public function FileAdd(Request $request)
    {

        // return $request;
        $file = new FileFormat();
        $file->file_type = $request->file_type;
        $file->max_limit = $request->max_limit;
        $file->created_by = Auth::guard('officer')->user()->id;
        $file->status = $request->status;
        $file->save();
        return redirect()->route('fileformat-master')
            ->with('success', 'File Added Successfully');
    }

    public function  FileUpdate(Request $request, $id){
         $request->validate([
            'file_type' => 'required|string',
            'max_limit' => 'required|numeric',
            'status' => 'required|string',

        ]);
        //   return $request;
        $file = FileFormat::where('id', $id)->update([
            'file_type' => $request->file_type,
            'max_limit'=>$request->max_limit ,
            'status' =>$request->status,
        ]);
        return redirect()->route('fileformat-master')
        ->with('success', 'File Updated Successfully');
    }

    public function FileDelete ($id){
        //return $id;
        $file= FileFormat::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('fileformat-master')
        ->with('success', 'File Deleted Successfully');
    }



    }

