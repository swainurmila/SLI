<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookImages;
use App\Models\Notification;
use App\Models\CategoryMaster;
use App\Models\Language;
use App\Models\MasterSetting;
use App\Models\User;
use App\Models\BookLocation;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Validator;
use DB;
use Illuminate\Support\Facades\Auth;
use App\Models\BookRequest;
class BookController extends Controller
{
    public function index(Request $request)
    {

    // $book_data = Book::join('category_masters', 'books.category_id', '=', 'category_masters.id')
    //     ->leftJoin('book_images as i', 'books.id', 'i.book_id')
    // ->select('category_masters.name AS category_name', 'books.*', 'i.file_name')->orderBy('books.id', 'desc')
    // ->get();
     $book_data = Book::with('BookImage', 'BookLocation', 'BookCategory')->get();
    $category_list = CategoryMaster::get();
    $language_list = Language::get();

       return view('admin.book.index',compact('book_data','category_list','language_list'));
    }
    public function add(Request $request)
    {

    $category_list = CategoryMaster::get();
    $language_list = Language::get();
       return view('admin.book.book_add',compact('category_list','language_list'));
    }


    public function mastersetting()
    {

        $master = MasterSetting::first();

       return view('admin.book.mastersetting',compact('master'));
    }

    public function usersearch(Request $request)
    {
        if ($request->isMethod('POST')) {
            // dd("ddddddddd");
            $bar_id = $request->search_value;
            $bar_code = $request->search_value;

            // $data_id = (int)substr($bar_id, 6);
            $user_data = User::where('registration_no',$bar_id)->first();
            $book_request='';
            if(isset($user_data->id)){
                $book_request = BookRequest::whereIn('issue_status', [0,1,4,3])->where('user_id',$user_data->id)->orderBy('id', 'desc')->get();
            }
       return view('admin.book.usersearch',compact('user_data','book_request','bar_code'));
        }
       return view('admin.book.usersearch');
    }


    public function mastersettingsave(Request $request)
    {
        //return $request;
        $data = $this->validate($request, [
            'fine_days' => 'required',
            'fine_amount' => 'required',
            'notification_days' => 'required'

        ]);
        $master_count = MasterSetting::count();
        if($master_count > 0){
        $master = MasterSetting::first();
        $master->fine_days = $request->fine_days;
        $master->fine_amount = $request->fine_amount;
        $master->notification_days = $request->notification_days;
        $master->update();
    }else{
        $master = new MasterSetting();
        $master->fine_days = $request->fine_days;
        $master->fine_amount = $request->fine_amount;
        $master->notification_days = $request->notification_days;
        $master->save();

    }
        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect()->back();
    }



    public function store(Request $request)
    {
        //return $request;
        $data = $this->validate($request, [
            'name' => 'required',

            'author' => 'required',
            'publisher' => 'required',
            'edition' => 'required',
            'publish_year' => 'required',
            'price' => 'required',

        ]);
        $k = 0;
        $count_rack = 0;
        while ($request->has("rack_no_$k")) {
            $count_rack++;
            $k++;
        }
        // return $count_rack;
        $data = new Book();
        $data->name = $request->name;
        $data->category_id = $request->category_id;
        $data->language_id = $request->language_id;
        $data->author = $request->author;
        $data->publisher = $request->publisher;
        $data->edition = $request->edition;
        $data->quantity = $count_rack;

        $data->publish_year = $request->publish_year;

        $data->balance_quantity = 0;

        $data->price = $request->price;

        $data->book_description = $request->book_description;

        $data->book_instruction = $request->book_instruction;

        $data->status = $request->book_status;

        $data->save();

        $key = 0;
        while ($request->has("rack_no_$key")) {
            $location_data = new BookLocation();
            $location_data->unique_req_number = $request->input("unique_req_number_$key");
            $location_data->book_id = $data->id;
            $location_data->rack_no = $request->input("rack_no_$key");
            $location_data->column_no = $request->input("column_no_$key");
            $location_data->row_no = $request->input("row_no_$key");
            $location_data->save();
            $key++;
        }
        $sl = 0;
        while ($request->has("library_images_$sl")) {
            $image_data = new BookImages();
            $image_data->book_id = $data->id;
            $image_data->file_name = "/uploads/library/book_image/" . $request->input("library_images_$sl");
            $image_data->save();
            $sl++;
        }


        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect()->route('book.index');

    }

    public function edit(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'author' => 'required',
            'publisher' => 'required',
            'edition' => 'required',
            'publish_year' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);



        $book = Book::where('id', $request->id)->first();
        $book->name = $request->name;
        $book->category_id = $request->category_id;
        $book->language_id = $request->language_id;
        $book->author = $request->author;
        $book->publisher = $request->publisher;
        $book->edition = $request->edition;
        $book->publish_year = $request->publish_year;
        $book->price = $request->price;
        $book->quantity = $request->quantity;
        $book->book_description = $request->book_description;
        $book->book_instruction = $request->book_instruction;

        // if ($file = $request->file('book_image')) {
        //     $image_data = BookImages::where('book_id', $request->id)->first();
        //     if ($image_data) {
        //         $uploaded_file = $request->file('book_image');
        //         $extension = $uploaded_file->getClientOriginalExtension();
        //         $filename = time() . uniqid(rand()) . 'workshop_image' . '.' . $extension;
        //         $path = public_path('/uploads/library/book_image/');
        //         $upload_success = $uploaded_file->move($path, $filename);
        //         $upload_image = '/uploads/library/book_image/' . $filename;

        //         $image_data->file_name = $upload_image;
        //         $image_data->save();
        //     }
        // }
        if ($files = $request->file('book_image')) {
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $filename = time() . uniqid(rand()) . 'book_image' . '.' . $extension;
                $path = public_path('/uploads/library/book_image/');
                $upload_success = $file->move($path, $filename);
                $upload_image = '/uploads/library/book_image/' . $filename;

                $image_data = new BookImages();
                $image_data->book_id = $book->id;
                $image_data->file_name = $upload_image;
                $image_data->save();
            }
        }
        $book->save();
        Session::flash('success', trans('flash.AddedSuccessfully'));
        return redirect()->back();
    }
    public function bookIssueRequest(Request $request, $id='')
    {
        if($id != ''){
        $book_request = BookRequest::whereIn('issue_status', [0])->where('book_id',$id)->orderBy('id', 'desc')->get();
        }else{
        $book_request = BookRequest::whereIn('issue_status', [0,1,3])->orderBy('id', 'desc')->get();
        }
       return view('admin.book.bookIssueRequest',compact('book_request','id'));
    }

    public function bookReturnRequest()
    {

        $book_request = BookRequest::with('UserRequestedBook','IssueBook','BookLocation')->whereIn('issue_status', [3,4])->orderBy('id', 'desc')->get();
        $setting_data =MasterSetting::first();
        // dd($book_request);
       return view('admin.book.bookReturnRequest',compact('book_request','setting_data'));
    }
    public function rejectList()
    {

        $book_request = BookRequest::whereIn('issue_status', [2])->orderBy('id', 'desc')->get();
        return view('admin.book.book_reject_list',compact('book_request'));
    }

    public function issueBook(Request $request)
    {

       $book_id = $request['book_id'];
        $book_request = BookRequest::where('id',$book_id)->first();
        $book_request->issue_approve_id = Auth::user()->id;
        $book_request->issue_status = 1;
        $book_request->issue_date = $request['issue_date'];
        $book_request->book_location_id = $request['unique_req_number'];
        $book_request->update();

        $notification_request = New Notification();
        $notification_request->from_user_id = Auth::user()->id;
        $notification_request->to_user_id = $book_request->user_id;
        $notification_request->message = 'Your Book Request has been approved. Please go and collect the book.';

        $notification_request->save();






         $data = [];
      return response()->json($data);
    }

    public function rejectBook(Request $request)
    {

       $book_id = $request['book_id'];
        $book_request = BookRequest::where('id',$book_id)->first();
        $book_request->issue_status = 2;
        $book_request->reject_remark = $request['reject_remark'];
        $book_request->reject_date = date('Y-m-d H:i:s');

        $book_request->update();

        $notification_request = New Notification();
        $notification_request->from_user_id = Auth::user()->id;
        $notification_request->to_user_id = $book_request->user_id;
        $notification_request->message = 'Sorry ! The requested book is not available now. Please wait for few days and try again.';
        $notification_request->save();
         $data = [];
      return response()->json($data);
    }


    public function IssueBookReturnRequest(Request $request)
    {
       $book_id = $request['book_id'];
        $book_request = BookRequest::where('id',$book_id)->first();
        $book_request->issue_status = 4 ;
        $book_request->return_date = date('Y-m-d');
        $book_request->return_approve_id = Auth::user()->id;
        $book_request->update();


        $notification_request = New Notification();
        $notification_request->from_user_id = Auth::user()->id;
        $notification_request->to_user_id = $book_request->user_id;
        $notification_request->message = 'Your Book return request has been approved. Please go and return the book.';

        $notification_request->save();



        $data = [];
        return response()->json($data);
    }
    public function adminBookReturnRequest(Request $request)
    {
        $data = [];

        return response()->json($data);
    }




    public function bookRegCheck(Request $request)
    {
        // dd($request->unique_req_number);

        $location_count = BookLocation::where('unique_req_number',$request->unique_req_number)->count();
        return response()->json(['location_count' => $location_count]);

    }
    public function bookDetails(Request $request, $id)
    {
       $book = Book::with('category')->with('location')->with('images')
        ->where('books.id',$id)->orderBy('books.id', 'desc')->first();
       return view('admin.book.view-book-details',compact('book'));
    }

    public function BookaddLocation(Request $request)
    {
        $request->validate([
            'unique_req_number' => 'required|unique:book_locations',
            'rack_no' => 'required',
            'column_no' => 'required',
            'row_no' => 'required',
        ]);
        // $book_count = Book::where('id', $request->book_id)->update([
        //     'balance_quantity' => 'balance_quantity' + 1,
        // ]);
        $book_count = Book::where('id', $request->book_id)->first();

         $book_count->quantity  +=  1;
        $book_count->update();
        //  return $request;
        $locations = new BookLocation();
        $locations->book_id = $request->book_id;
        $locations->unique_req_number = $request->unique_req_number;
        $locations->rack_no = $request->rack_no;
        $locations->column_no = $request->column_no;
        $locations->row_no = $request->row_no;
        $locations->save();
        return redirect()->back()
        ->with('success', 'Book Added Successfully');

    }

    public function editlocation(Request $request)
    {
//    return $request;
$locations = BookLocation::where('id',$request->id)->update([
            // 'book_id' => $request->book_id,
            'unique_req_number' => $request->unique_req_number,
            'rack_no' => $request->rack_no,
            'column_no' => $request->column_no,
            'row_no' => $request->row_no,

        ]);

        return redirect()->back();

    }



    public  function checkreg(Request $request){
        // dd ($request->all());
        //   dd( $request->regno);

        $uni_reg_number = $request->regno;
        $location_count = BookLocation::where('unique_req_number',$uni_reg_number)->count();
        return response()->json(['location_count' => $location_count]);
    }


    public function uploadLibraryImage(Request $request)
    {
         $images = $request->file('images');

        if (!is_array($images)) {
            $images = [$images];
        }


        $libraryImage=[];

        foreach ($images as $image) {
            if ($image) {
                // Validate each image or perform operations as necessary
                $extension = $image->getClientOriginalExtension();
                $imageName = time() . uniqid(rand()) . '.' . $extension;
                $image->storeAs('library/book_image', $imageName);

                $libraryImage[]=$imageName;
            }
        }

        return response()->json(['success' => 'Images uploaded successfully.','data'=>$libraryImage]);
    }
}


