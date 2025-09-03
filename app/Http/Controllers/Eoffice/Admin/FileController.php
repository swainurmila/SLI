<?php

namespace App\Http\Controllers\Eoffice\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use App\Models\e_office\OfficeFile;
use App\Models\e_office\OfficeFileUserFlowDraft;
use App\Models\e_office\OfficeDeliveryMode;
use App\Models\e_office\OfficeLetterType;
use App\Models\e_office\OfficeSection;
use App\Models\e_office\OfficeFileDispatchMode;
use App\Models\e_office\officeUser;
use App\Models\e_office\OfficeGroup;
use App\Models\e_office\OfficeDepartment;
use App\Models\e_office\OfficeFileUserFlow;
use App\Models\e_office\OfficePriority;


use App\Models\e_office\OfficeMainCatagory;
use App\Models\e_office\OfficeSubCatagory;
use App\Models\e_office\OfficeRecyclebin;
use DB;

class FileController extends Controller
{
    public function index(){
        $office_files = OfficeFile::where('created_user_id',Auth::guard('officer')->user()->id)->where('file_status',0)->get();

        return view('Eoffice.admin.file.index',compact('office_files'));
    }

    public function viewFile(Request $request ,$id){
        $office_files = OfficeFile::where('id',$id)->with('toUser','deliveryMode', 'letterType', 'section', 'department', 'toUser', 'mainCategory', 'subCategory','createdUser')
        ->first();
        $file_flow_datas = OfficeFileUserFlow::where('file_id', $id)
        ->where(function ($query) {
            $userId = Auth::guard('officer')->user()->id;
            $query->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId)
                ->orWhereJsonContains('cc_user_id', $userId); // Ensure user ID is correctly casted for JSON comparison
        })
        ->with('toUser', 'officeFile', 'priority', 'officeUser')
        ->orderBy('id', 'desc')
        ->get();

        $priorities = OfficePriority::where('status',1)->get();

        $user_data = officeUser::where('login_for','office')->where('role_id','!=' ,'1')->where('id', '!=', Auth::guard('officer')->user()->id)->get();
        $userId = Auth::guard('officer')->user()->id;
        $replyDetail = OfficeFileUserFlow::where('file_id', $id)
        ->where(function ($query) use ($userId) {
            $query->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId)
                ->orWhereJsonContains('cc_user_id', $userId); // Assuming JSON array contains integers or matches the ID type
        })
        ->with(['toUser', 'officeFile', 'priority', 'officeUser'])
        ->orderByDesc('id')
        ->first();
        $userId = Auth::guard('officer')->user()->id;

        $flowUsers = OfficeFileUserFlow::where('file_id', $id)
            ->where(function ($query) use ($userId) {
                $query->where('from_user_id', $userId)
                    ->orWhere('to_user_id', $userId)
                    ->orWhereJsonContains('cc_user_id', $userId);
            })
            ->get();

        $userIds = $flowUsers->pluck('from_user_id')
            ->merge($flowUsers->pluck('to_user_id'))
            ->merge($flowUsers->pluck('cc_user_id'))
            ->unique()
            ->filter(function ($value) use ($userId) {
                return $value != $userId;
            });

        $replyUsers = OfficeUser::whereIn('id', $userIds)->with('officeFileUserFlows')->get();   

    
        return view('Eoffice.admin.file.viewFile',compact('office_files','file_flow_datas','id','user_data','priorities','replyDetail','replyUsers'));
    }
    public function createFile(){
        $delivery_modes = OfficeDeliveryMode::where('status',1)->get();
        $letter_types =  OfficeLetterType::where('status',1)->get();
        
       $section =  OfficeSection::where('status',1)->get();
        $department = OfficeDepartment::where('status',1)->get();

        $users = officeUser::where('status',1)->where('login_for','office')->where('role_id', '!=' ,1)->where('id', '!=', Auth::guard('officer')->user()->id)->get();

        $main_catagrory = OfficeMainCatagory::where('status',1)->get();

        $sub_catagrory = OfficeSubCatagory::where('status',1)->get();

        $priorities = OfficePriority::where('status',1)->get();

        return view('Eoffice.admin.file.create-file',compact('delivery_modes','letter_types','section','department','users','main_catagrory','sub_catagrory','priorities'));
    }
    public function editFile(Request $request ,$id){

        $delivery_modes = OfficeDeliveryMode::where('status',1)->get();
       $letter_types =  OfficeLetterType::where('status',1)->get();

       $section =  OfficeSection::where('status',1)->get();
        $department = OfficeDepartment::where('status',1)->get();

        $users = officeUser::where('status',1)->where('id', '!=', Auth::guard('officer')->user()->id)->get();

        $main_catagrory = OfficeMainCatagory::where('status',1)->get();
       
        $sub_catagrory = OfficeSubCatagory::where('status', 1)->get();
        $file_data = OfficeFile::where('id',$id)->first();


        return view('Eoffice.admin.file.edit-create-file',compact('delivery_modes','letter_types','section','department','users','main_catagrory','sub_catagrory','file_data'));
    }
    public function createFilesave(Request $request){

        $data = $this->validate($request, [
            'delivery_mode_id' => 'required',
            'letter_type' => 'required',
            'file_no' => 'required',
            'section_id' => 'required',
            'memo_no' => 'required',
            'enclouser_type' => 'required',
            'priority_type' => 'required',
            'public_type' => 'required',
            'upload_file' => 'required',
            'department_id'=> 'required',
            'to_user_id'=> 'required',
            'main_category_id'=> 'required',
            'sub_category_id'=> 'required',
            'letter_subject'=> 'required',
            'message'=>'required'
            // 'designation'=>'required',

        ]);

        $images = $request->file('upload_file');
        foreach($images as $key => $image) {

            if($image){
                $file1 = $image;
                $mime_type_array1 = array(
                    "jpeg" => "image/jpeg",
                    "jpg" => "image/jpeg",
                     "pdf" => "application/pdf"
                );
                $ext1 = pathinfo($_FILES['upload_file']['name'][0], PATHINFO_EXTENSION);
                $finfo1 = finfo_open(FILEINFO_MIME_TYPE);

                    $total_image1 = uniqid().'.'.$ext1;

                    $base_path1 = $file1->move('public/upload/office/upload_file',$total_image1);
                    chmod($base_path1, 0777);
            }
        }
        $data = new OfficeFile();
        // $data->category_id = $request->category_id;
        $data->delivery_mode_id = $request->delivery_mode_id;
        $data->letter_type = $request->letter_type;
        $data->file_no = $request->file_no;
        $data->section_id = $request->section_id;
        $data->memo_no = $request->memo_no;
        $data->enclouser_type = $request->enclouser_type;
        $data->priority_type = $request->priority_type;
        $data->public_type = $request->public_type;
        $data->department_id = $request->department_id;
        $data->to_user_id = $request->to_user_id;
        $data->main_category_id = $request->main_category_id;

        $data->sub_category_id = $request->sub_category_id;
        $data->upload_file = $total_image1;
        $data->letter_subject = $request->letter_subject;
        $data->created_user_id = Auth::guard('officer')->user()->id;
        $data->message = $request->message;
        $data->file_date = date('Y-m-d');
        $data->save();

        return redirect()->route('admin.office.adddispatchMode')->with("success", "File created successfully!");
    }
    public function editFileSave(Request $request,$id){

        $data = $this->validate($request, [
            'delivery_mode_id' => 'required',
            'letter_type' => 'required',
            'file_no' => 'required',
            'section_id' => 'required',
            'memo_no' => 'required',
            'enclouser_type' => 'required',
            'priority_type' => 'required',
            'public_type' => 'required',
            'department_id'=> 'required',
            'to_user_id'=> 'required',
            'main_category_id'=> 'required',
            'sub_category_id'=> 'required',
            'letter_subject'=> 'required',
            'message'=>'required'
            // 'designation'=>'required',

        ]);

        $images = $request->file('upload_file');

        if($request->file('upload_file') != null){
        foreach($images as $key => $image) {

            if($image){
                $file1 = $image;
                $mime_type_array1 = array(
                    "jpeg" => "image/jpeg",
                    "jpg" => "image/jpeg",
                     "pdf" => "application/pdf"
                );
                $ext1 = pathinfo($_FILES['upload_file']['name'][0], PATHINFO_EXTENSION);
                $finfo1 = finfo_open(FILEINFO_MIME_TYPE);

                    $total_image1 = uniqid().'.'.$ext1;

                    $base_path1 = $file1->move('public/upload/office/upload_file',$total_image1);
                    chmod($base_path1, 0777);
            }


        } }

        $data =  OfficeFile::where('id',$id)->first();
        // $data->category_id = $request->category_id;
        $data->delivery_mode_id = $request->delivery_mode_id;
        $data->letter_type = $request->letter_type;
        $data->file_no = $request->file_no;
        $data->section_id = $request->section_id;
        $data->memo_no = $request->memo_no;
        $data->enclouser_type = $request->enclouser_type;
        $data->priority_type = $request->priority_type;
        $data->public_type = $request->public_type;
        $data->department_id = $request->department_id;
        $data->to_user_id = $request->to_user_id;
        $data->main_category_id = $request->main_category_id;

        $data->sub_category_id = $request->sub_category_id;

        if($request->file('upload_file') != null){
        $data->upload_file = $total_image1;
        }
        $data->letter_subject = $request->letter_subject;
        $data->created_user_id = Auth::guard('officer')->user()->id;
        $data->file_date = date('Y-m-d');
        $data->message = $request->message;
        $data->update();

        return redirect()->route('admin.office.index');
    }


    public function adddispatchMode(){

        $groups = OfficeGroup::where('status',1)->get();
        $office_files = OfficeFile::where('created_user_id',Auth::guard('officer')->user()->id)->where('file_status',0)->get();

        return view('Eoffice.admin.file.adddispatchMode',compact('office_files','groups'));
    }
    public function getMode(Request $request)
    { 
        $delivery_modes = OfficeDeliveryMode::where('status', 1)->where('is_delete', 0)->get();
        return response()->json(['delivery_modes' => $delivery_modes]);
    }
    public function saveAdddispatchMode(Request $request){
           // return $request;
            // $data = $this->validate($request, [
            //     'delivery_mode_id' => 'required',
            //     'letter_type' => 'required',
            //     'file_no' => 'required',
            // ]); 

            //    $data =  new OfficeFileDispatchMode();
            //    $data->file_id = $request->dispatch_mode_id
            // dd($request->dispatch_mode_id);

            // foreach($request->dispatch_mode_id as $key => $dispatch_mode) {
            //     // dd($request->dispatch_mode_id[$key]);
            //     $data =  new OfficeFileDispatchMode();
            //     $data->file_id = $request->letter_id;
            //     $data->save();
            // }
            $counter = 1;
            while($request->has("dispatch_mode_$counter")) {
                $data = new OfficeFileDispatchMode();
                $data->file_id = $request->letter_id;
                $data->dispatch_mode_id = $request->input("dispatch_mode_$counter");
                $data->save();
                $counter++;
            }
            $data_file =  OfficeFile::where('id',$request->letter_id)->first();
            $data_file->file_status = 1;
            $data_file->update();


            $flow_data_save = new OfficeFileUserFlow();
            $flow_data_save->file_id = $request->letter_id;
            $flow_data_save->subject = $data_file->letter_subject;
            $flow_data_save->from_user_id = $data_file->created_user_id;
            $flow_data_save->to_user_id = $data_file->to_user_id;
            $flow_data_save->save();


            
        return redirect()->route('admin.office.sentReceipt')->with("success", "File created successfully!");
    }
    public function inboxFile(){

        $user_id = Auth::guard('officer')->user()->id;

        $office_files = OfficeFileUserFlow::with(['officeFile', 'officeUser', 'toUser'])
        ->select('*')
        ->whereNotExists(function ($query) use ($user_id) {
            $query->selectRaw(1)
                ->from('office_recyclebins')
                ->whereColumn('office_recyclebins.file_id', '=', 'office_file_user_flows.file_id')
                ->where('office_recyclebins.user_id', '=', $user_id)
                ->where('office_recyclebins.deleted_form', '=', 'Inbox');
        })
        ->whereIn('id', function ($query) use ($user_id) {
            $query->selectRaw('MAX(id)')
                ->from('office_file_user_flows')
                ->where(function ($query) use ($user_id) {
                    $query->whereJsonContains('cc_user_id', $user_id)
                        ->orWhere('to_user_id', $user_id);
                })
                ->where(function ($query) use ($user_id) {
                    $query->whereRaw('JSON_KEYS(is_deleted) NOT LIKE \'%"' . $user_id . '"%\'')
                        ->orWhereRaw('JSON_KEYS(is_deleted) IS NULL');
                })
                ->groupBy('file_id');
        })
        ->orderBy('id', 'desc')
        ->get();

        $user_data = officeUser::where('login_for','office')->where('role_id','!=' ,'1')->where('id', '!=', Auth::guard('officer')->user()->id)->get();
        $priorities = OfficePriority::where('status',1)->get();

        // dd($office_files);
        return view('Eoffice.admin.file.inboxFile',compact('office_files','user_data','priorities'));
    }

    public function sentFile(Request $request){
        //return $request->draft_id;
        $sent_from_recyclebin = OfficeRecyclebin::where('draft_id', $request->draft_id)->delete();
        $data = OfficeFileUserFlowDraft::where('id', $request->draft_id)->delete();
        // $data;
        
        
            $cc_user_ids_string = explode(',', $request->cc_user_id);
            $cc_user_ids_array = array_filter($cc_user_ids_string, function($key) {
                return is_numeric($key);
            }, ARRAY_FILTER_USE_KEY);


            if (!empty($cc_user_ids_array)) {
                $cc_users = officeUser::whereIn('id', $cc_user_ids_array)->get();
                $cc_user_ids = $cc_users->pluck('id')->toArray();
                $cc_user_ids_json = json_encode($cc_user_ids);
            } else {
                $cc_user_ids_json = null;
            }


            //  $cc_user_ids_string = $request->cc_user_id;
            // if (!empty($cc_user_ids_string)) {
            //     $cc_user_ids_array = explode(',', $cc_user_ids_string);
            //     $cc_users = officeUser::whereIn('id', $cc_user_ids_array)->get();
            //     $cc_user_ids = $cc_users->pluck('id')->toArray();
            //     $cc_user_ids_json = json_encode($cc_user_ids);
            // } else {
            //     $cc_user_ids_json = null;
            // }
            // return $cc_user_ids_json;
            $flow_data_save = new OfficeFileUserFlow();
            $flow_data_save->file_id = $request->file_id;
            $flow_data_save->from_user_id = Auth::guard('officer')->user()->id;
            $flow_data_save->to_user_id = $request->to_user_id;
            $flow_data_save->receipt_no = $request->receipt_no;
            $flow_data_save->subject = $request->subject;
            $flow_data_save->cc_user_id = $cc_user_ids_json;
            $flow_data_save->due_date = $request->due_date;
            $flow_data_save->action_type = $request->action_type;
            $flow_data_save->priority_type = $request->priority_type;
            $flow_data_save->remarks = $request->remarks;
            if ($request->forward_message) {
                $flow_data_save->forward_message = $request->forward_message;
            }
            $flow_data_save->save();
            
            // dd($flow_data_save->cc_user_id);

        return redirect()->route('admin.office.inboxFile');
    }

    public function replyFile(Request $request){
        // return $request;
        $sent_from_recyclebin = OfficeRecyclebin::where('draft_id', $request->draft_id)->delete();
        $data = OfficeFileUserFlowDraft::where('id', $request->draft_id)->delete();
        

        $cc_user_ids_string = explode(',', $request->cc_user_id);
        $cc_user_ids_array = array_filter($cc_user_ids_string, function($key) {
            return is_numeric($key);
        }, ARRAY_FILTER_USE_KEY);

        if (!empty($cc_user_ids_array)) {
            $cc_users = officeUser::whereIn('id', $cc_user_ids_array)->get();
            $cc_user_ids = $cc_users->pluck('id')->toArray();
            $cc_user_ids_json = json_encode($cc_user_ids);
        } else {
            $cc_user_ids_json = null;
        }
        // $cc_user_ids_string = $request->cc_user_id;
        // if (!empty($cc_user_ids_string)) {
        //     $cc_user_ids_array = explode(',', $cc_user_ids_string);
        //     $cc_users = officeUser::whereIn('id', $cc_user_ids_array)->get();
        //     $cc_user_ids = $cc_users->pluck('id')->toArray();
        //     $cc_user_ids_json = json_encode($cc_user_ids);
        // } else {
        //     $cc_user_ids_json = null;
        // }
       // return $cc_user_ids_json;

        $flow_data_save = new OfficeFileUserFlow();

        $flow_data_save->file_id = $request->file_id;

        $flow_data_save->from_user_id = Auth::guard('officer')->user()->id;


        $flow_data_save->to_user_id = $request->to_user_id;
        $flow_data_save->receipt_no = $request->receipt_no;
        $flow_data_save->subject = $request->subject;
        $flow_data_save->cc_user_id = $cc_user_ids_json;
        $flow_data_save->due_date = $request->due_date;
        $flow_data_save->action_type = $request->action_type;
        $flow_data_save->priority_type = $request->priority_type;
        $flow_data_save->remarks = $request->remarks;
        if ($request->forward_message) {
            $flow_data_save->forward_message = $request->forward_message;
        }
        $flow_data_save->reply_forwards = 1;
        $flow_data_save->save();

        // dd($flow_data_save->cc_user_id);

    return redirect()->route('admin.office.inboxFile');
}

    public function sentReceipt(){
        $user_id = Auth::guard('officer')->user()->id;



        $office_files =  OfficeFileUserFlow::with(['officeFile', 'officeUser','toUser'])
        ->whereNotExists(function ($query) use ($user_id) {
            $query->selectRaw(1)
                ->from('office_recyclebins')
                ->whereColumn('office_recyclebins.file_id', '=', 'office_file_user_flows.file_id')
                ->where('office_recyclebins.user_id', '=', $user_id)
                ->where('office_recyclebins.deleted_form', '=', 'Sent');
        })
    ->whereIn('id', function ($query) use ($user_id) {
        $query->select(DB::raw('MAX(id)'))
            ->from('office_file_user_flows')
            ->where('from_user_id', $user_id)
            ->where(function($query) use ($user_id) {
                $query->whereRaw('JSON_KEYS(is_deleted) NOT LIKE \'%"' . $user_id . '"%\'')
                      ->orWhereRaw('JSON_KEYS(is_deleted) IS NULL')
                      ->orWhereRaw('JSON_LENGTH(is_deleted) = 0');
            })
            ->groupBy('file_id');
    })
    ->orderBy('id', 'desc')
    ->get();

        // OfficeFileUserFlow::where('from_user_id', Auth::guard('officer')->user()->id)
        // ->with('officeFile')
        // ->orderBy('file_id', 'DESC')
        // ->get();


        $user_data = officeUser::where('id', '!=', Auth::guard('officer')->user()->id)->get();
        $priorities = OfficePriority::where('status',1)->get();

        // dd($priorities);
        return view('Eoffice.admin.file.sentFile',compact('office_files','user_data','priorities'));
    }
    public function recyclebin(){
        $user_id = Auth::guard('officer')->user()->id;

        $office_files = OfficeRecyclebin::with('officeFileFlow.officeFile','officeUser', 'officeDraft')->where('user_id',Auth::guard('officer')->user()->id)->orderBy('id','desc')->get();

        $user_data = officeUser::where('id', '!=', Auth::guard('officer')->user()->id)->get();
        $priorities = OfficePriority::where('status',1)->get();
        return view('Eoffice.admin.file.recyclebin',compact('office_files','user_data', 'priorities'));
    }


    public function restoreFile(Request $request,$id){

        $office_files = OfficeRecyclebin::where('id',$id)->where('user_id',Auth::guard('officer')->user()->id)->delete();

        if($office_files){
            return redirect()->back();
        }
        // OfficeRecyclebin
    }

    public function deleteFileFlow(Request $request, $id){
       // return $request;
       if($request->delete_form == 'Draft'){
            $recycleBin = new OfficeRecyclebin;
            $recycleBin->user_id = Auth::guard('officer')->user()->id;
            $recycleBin->file_id = $id;
            $recycleBin->draft_id = $request->draft_id;
            $recycleBin->deleted_form = $request->delete_form;
            $recycleBin->save();
       }else{
            $recycleBin = new OfficeRecyclebin;
            $recycleBin->user_id = Auth::guard('officer')->user()->id;
            $recycleBin->file_id = $id;
            $recycleBin->deleted_form = $request->delete_form;
            $recycleBin->save();
       }
        
        
        return redirect()->back();
    }
 
    public function saveDraft(Request $request)
    { 
    //    dd($request->flow_id);
        if($request->emailSelect != null){
            $cc_user_ids = officeUser::whereIn('id', $request->emailSelect)->pluck('id')->toArray();
            $cc_user_ids_json = json_encode($cc_user_ids);
        }
        $flow_count = OfficeFileUserFlowDraft::where('flow_id',$request->flow_id)->where('from_user_id',Auth::guard('officer')->user()->id)->count();
        
        if($flow_count == 0){
            //dd(1);
            $flow_data_save = new OfficeFileUserFlowDraft();
            $flow_data_save->file_id = $request->file_id;
            $flow_data_save->from_user_id = Auth::guard('officer')->user()->id;
            $flow_data_save->flow_id = $request->flow_id;
            $flow_data_save->to_user_id = $request->to_user_id;
            $flow_data_save->receipt_no = $request->receipt_no;
            $flow_data_save->subject = $request->subject;
            if($request->emailSelect != null){
                $flow_data_save->cc_user_id = $cc_user_ids_json;
            }
            $flow_data_save->due_date = $request->due_date;
            $flow_data_save->action_type = $request->action_type;
            $flow_data_save->priority_type = $request->priority_type;
            $flow_data_save->remarks = $request->remarks;
            if($request->forward_message){
                $flow_data_save->forward_message = $request->forward_message; 
            }
            $flow_data_save->reply_forwards = 0;
            $flow_data_save->save();
        }else{
            //dd(2);
            $flow_data_save = OfficeFileUserFlowDraft::where('flow_id',$request->flow_id)->where('from_user_id',Auth::guard('officer')->user()->id)->first();

            $flow_data_save->file_id = $request->file_id;
            
            $flow_data_save->from_user_id = Auth::guard('officer')->user()->id;
            $flow_data_save->flow_id = $request->flow_id;
            
            
                
            $flow_data_save->to_user_id = $request->to_user_id;
            $flow_data_save->receipt_no = $request->receipt_no;
            $flow_data_save->subject = $request->subject;
            
            if($request->emailSelect != null){
                // dd("dd");
            $flow_data_save->cc_user_id = $cc_user_ids_json;
            }
            $flow_data_save->due_date = $request->due_date;
            $flow_data_save->action_type = $request->action_type;
            $flow_data_save->priority_type = $request->priority_type;
            $flow_data_save->remarks = $request->remarks;
            if($request->forward_message){
                $flow_data_save->forward_message = $request->forward_message;
            }
            $flow_data_save->reply_forwards = 0;
            $flow_data_save->update();
        }
        return response()->json(['message' => 'saved']);
    }
    public function draftFile(){

        $user_id = Auth::guard('officer')->user()->id;

        $office_files = OfficeFileUserFlowDraft::with(['officeFile', 'officeUser'])
        ->where('from_user_id', Auth::guard('officer')->user()->id)
        ->whereNotExists(function ($query) use ($user_id) {
            $query->selectRaw(1)
                ->from('office_recyclebins')
                ->whereRaw('office_recyclebins.file_id = office_file_user_flow_drafts.file_id')
                ->whereRaw('office_recyclebins.draft_id = office_file_user_flow_drafts.id')
                ->where('office_recyclebins.user_id', $user_id)
                ->where('office_recyclebins.deleted_form', 'Draft');
        })
        ->orderBy('id', 'desc')
        ->get();

        $user_data = officeUser::where('status',1)->where('login_for','office')->where('role_id', '!=' ,1)->where('id', '!=', Auth::guard('officer')->user()->id)->get();

        $priorities = OfficePriority::where('status',1)->get();


        return view('Eoffice.admin.file.draftFile',compact('office_files','user_data','priorities'));
    }

    //Office report
    public function officeReport(){
        $user_id = Auth::guard('officer')->user()->id;

        $office_files =  OfficeFileUserFlow::with(['officeFile', 'officeUser','toUser'])
        ->whereNotExists(function ($query) use ($user_id) {
            $query->selectRaw(1)
                ->from('office_recyclebins')
                ->whereColumn('office_recyclebins.file_id', '=', 'office_file_user_flows.file_id')
                ->where('office_recyclebins.user_id', '=', $user_id)
                ->where('office_recyclebins.deleted_form', '=', 'Sent');
        })
        ->whereIn('id', function ($query) use ($user_id) {
        $query->select(DB::raw('MAX(id)'))
            ->from('office_file_user_flows')
            ->where('from_user_id', $user_id)
            ->where(function($query) use ($user_id) {
                $query->whereRaw('JSON_KEYS(is_deleted) NOT LIKE \'%"' . $user_id . '"%\'')
                      ->orWhereRaw('JSON_KEYS(is_deleted) IS NULL')
                      ->orWhereRaw('JSON_LENGTH(is_deleted) = 0');
            })
            ->groupBy('file_id');
        })
         ->orderBy('id', 'desc')
        ->get();

        $user_data = officeUser::where('id', '!=', Auth::guard('officer')->user()->id)->get();
        $priorities = OfficePriority::where('status',1)->get();
        return view('Eoffice.admin.file.report_index',compact('office_files','user_data','priorities'));
    }
    public function reportViewFile(Request $request ,$id){
        $office_files = OfficeFile::where('id',$id)->with('toUser','deliveryMode', 'letterType', 'section', 'department', 'toUser', 'mainCategory', 'subCategory','createdUser')
        ->first();
        $file_flow_datas = OfficeFileUserFlow::where('file_id', $id)
        ->where(function ($query) {
            $userId = Auth::guard('officer')->user()->id;
            $query->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId)
                ->orWhereJsonContains('cc_user_id', $userId); // Ensure user ID is correctly casted for JSON comparison
        })
        ->with('toUser', 'officeFile', 'priority', 'officeUser')
        ->orderBy('id', 'desc')
        ->get();

        $priorities = OfficePriority::where('status',1)->get();

        $user_data = officeUser::where('login_for','office')->where('role_id','!=' ,'1')->where('id', '!=', Auth::guard('officer')->user()->id)->get();
        $userId = Auth::guard('officer')->user()->id;
        $replyDetail = OfficeFileUserFlow::where('file_id', $id)
        ->where(function ($query) use ($userId) {
            $query->where('from_user_id', $userId)
                ->orWhere('to_user_id', $userId)
                ->orWhereJsonContains('cc_user_id', $userId); // Assuming JSON array contains integers or matches the ID type
        })
        ->with(['toUser', 'officeFile', 'priority', 'officeUser'])
        ->orderByDesc('id')
        ->first();
        $userId = Auth::guard('officer')->user()->id;

        $flowUsers = OfficeFileUserFlow::where('file_id', $id)
            ->where(function ($query) use ($userId) {
                $query->where('from_user_id', $userId)
                    ->orWhere('to_user_id', $userId)
                    ->orWhereJsonContains('cc_user_id', $userId);
            })
            ->get();

        $userIds = $flowUsers->pluck('from_user_id')
            ->merge($flowUsers->pluck('to_user_id'))
            ->merge($flowUsers->pluck('cc_user_id'))
            ->unique()
            ->filter(function ($value) use ($userId) {
                return $value != $userId;
            });

        $replyUsers = OfficeUser::whereIn('id', $userIds)->with('officeFileUserFlows')->get();
        return view('Eoffice.admin.file.report_view',compact('office_files','file_flow_datas','id','user_data','priorities','replyDetail','replyUsers'));
    }
    public function deleteRecyclebin($id, Request $request){
        //return $id;
        $delete_file =  OfficeRecyclebin::where('id', $id)->first();
        $delete_from_draft = OfficeFileUserFlowDraft::where('id', $delete_file->draft_id)->delete();
        $delete_file->delete();
        return redirect()->route('admin.office.recyclebin')->with("success", "File deleted successfully!");
    }

}
