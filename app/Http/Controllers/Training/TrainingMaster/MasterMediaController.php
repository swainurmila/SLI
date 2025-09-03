<?php

namespace App\Http\Controllers\Training\TrainingMaster;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Training\TrPublicMedia;
use Session;
class MasterMediaController extends Controller
{
    
    protected $model = TrPublicMedia::class;

    public function index(){

        if(Auth::user()->role_id != 5){
            $datas = $this->model::paginate(10);
        }else{
            $datas=[];
        }
        return view('training.training-master.media.index',compact('datas'));
    }

    public function store(Request $request){
        
        $data = $this->validate($request, [
            'media_title' => 'required', 
            'media_type' => 'required',
            'media_file' => 'required', 
             
        ]); 
        
        $images = $request->file('media_file');
        foreach($images as $key => $image) {                    
            
            if($image){
                $file1 = $image;
                $mime_type_array1 = array(
                    "MP3" => "audio/MP3",
                    "MP4" => "video/MP4"
                );
                $ext1 = pathinfo($_FILES['media_file']['name'][0], PATHINFO_EXTENSION);
                $finfo1 = finfo_open(FILEINFO_MIME_TYPE);
                
                    $total_image1 = uniqid().'.'.$ext1;
                    
                    $base_path1 = $file1->move('public/upload/public_media_file',$total_image1);
                    chmod($base_path1, 0777);
                    
                //    $image_data =   new BookImages();
                //   $image_data->book_id = $data->id;
                //   $image_data->file_name = $total_image1;
                //   $image_data->save();
                
        $data = new TrPublicMedia(); 
        $data->media_title = $request->media_title;
        $data->media_type = $request->media_type; 
        $data->media_file = $total_image1;
        $data->payment_mode = $request->payment_mode; 
         
        $data->save();
        // dd("pass");
                     
            }


        } 
 


        if($data){
            Session::flash('success','Training Media Created Successfully !');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required'
        ]);
    
        $data = $this->model::find($id);
    
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
    
        $requestData = $request->all();
        $data->update($requestData);
    
        Session::flash('success', 'Training Category Updated Successfully !');
        return redirect()->back();
    }

    public function destroy($id){
        $data = $this->model::find($id);
        if (!$data) {
            return redirect()->back()->withErrors(['Record not found.']);
        }
        $data->delete();
        Session::flash('success', 'Training Media Deleted Successfully!');
        return redirect()->back();
    }
}
