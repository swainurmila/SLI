<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CategoryMaster;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Auth;
use App\Models\BookRequest;
use App\Models\LibTransaction;
use App\Models\User;
use App\Models\BookImages;
use App\Models\BookLocation;
use Illuminate\Http\Request;
use DB;
Use \Carbon\Carbon;
use Picqer\Barcode\BarcodeGeneratorHTML;


class LibraryUserController extends Controller
{



    public function generateBarcode()
    {
        // $qrCode = QrCode::generate('Hello, this is a QR code!');

        // // Generate a dynamic filename with a timestamp
        // $filename = 'qrcode_' . time().'.jpg';
        // // $destinationPath = 'public/upload/barcode/';
        // $path = 'public/upload/barcode/' . $filename;
        // // dd($qrCode);
        // // Save the QR code image to the storage disk
        // Storage::put($path, $qrCode);
        // dd($path, Storage::put($path, $qrCode));

        // // dd(Storage::put($path, $qrCode));
        // // return 'QR code generated and saved successfully at: ' . $filename;
        $url = 'https://example.com'; // The data you want to encode in the QR code

    // Generate QR code with default settings
        QrCode::generate($url);

        // You can also customize the QR code with additional options
        // QrCode::size(300)
        //     ->backgroundColor(255, 255, 255)
        //     ->color(0, 0, 0)
        //     ->margin(10)
        //     ->generate($url, public_path('public/upload/barcode/qrcode.png'));
    //     $image = QrCode::format('png')
    //     ->size(300)
    //     ->backgroundColor(255, 255, 255)
    //     ->color(0, 0, 0)
    //     ->margin(10)
    //     ->generate($url);

    // $path = public_path('public/upload/barcode/qrcode.png');

    // file_put_contents($path, $image);

        return view('admin.libraryuser.barcode');
        return view('admin.libraryuser.barcode',compact('filename'));

    }


    public function index(Request $request, $id='')
    {
        // dd($id);
        $cat_list="";
        if($id != ''){
            $category = CategoryMaster::find($id);
            $book_list = $category->books()->with('images')->where('status', 1)->orderBy('id', 'desc')->paginate(10);

            $cat_list = CategoryMaster::where('id',$id)->first();
        }else{

        // // $book_list = Book::where('status',1)->orderBy('id', 'desc')->paginate(10);
        // $book_list = Book::with('category')->where('status', 1)->orderBy('id', 'desc')->paginate(10);
         $book_list = Book::with(['category', 'images', 'bookRequest' => function ($query) {
            $query->where('user_id', Auth::id())->whereIn('issue_status', [0, 1, 3])->orderBy('id', 'desc')->first();
        }])
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->paginate(10);
        }

       return view('admin.libraryuser.index',compact('book_list','id','cat_list'));
    }


    public function indexsearch(Request $request)
    {
        $id = $request->cat_value;
        // $book_list = Book::where('category_id',$request->cat_value)->orderBy('id', 'desc')->paginate(3);
        // dd($request->cat_value);

        if($request->cat_value != null){
        $book_list = Book::where('category_id', $request->cat_value)
    ->where(function ($query) use ($request) {
        $query->orWhere('name', 'LIKE', '%' . $request->search_value . '%')
            ->orWhere('author', 'LIKE', '%' . $request->search_value . '%')
            ->orWhere('publisher', 'LIKE', '%' . $request->search_value . '%')
            ->orWhere('edition', 'LIKE', '%' . $request->search_value . '%')
            ->orWhere('price', 'LIKE', '%' . $request->search_value . '%')
            ->orWhere('quantity', 'LIKE', '%' . $request->search_value . '%');
    })
    ->orderBy('id', 'desc')
    ->paginate(10);
    }else{
        $book_list = Book::where(function ($query) use ($request) {
            $query->orWhere('name', 'LIKE', '%' . $request->search_value . '%')
                ->orWhere('author', 'LIKE', '%' . $request->search_value . '%')
                ->orWhere('publisher', 'LIKE', '%' . $request->search_value . '%')
                ->orWhere('edition', 'LIKE', '%' . $request->search_value . '%')
                ->orWhere('price', 'LIKE', '%' . $request->search_value . '%')
                ->orWhere('quantity', 'LIKE', '%' . $request->search_value . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
    }
       return view('admin.libraryuser.index',compact('book_list','id'));
    }



    public function bookRequest(Request $request)
    {

       $book_id = $request['book_id'];

        $book_request = new BookRequest();
        $book_request->user_id = Auth::user()->id;
        $book_request->book_id = $book_id;
        $book_request->issue_status = 0;
        $book_request->save();
         $data = [];
      return response()->json($data);
    }

    public function userBookList(Request $request)
    {
       $book_list = BookRequest::orderBy('id', 'desc')->where('user_id',Auth::user()->id)->get();
        return view('admin.libraryuser.issuereturn',compact('book_list'));

    }
    public function returnbookRequest(Request $request)
    {
        $book_request_id = $request['book_request_id'];
        $book_request = BookRequest::where('id',$book_request_id)->first();
        $book_request->issue_status = 3 ;
        $book_request->update();
        $data = [];
        return response()->json($data);
    }
    public function payFine(Request $request){
        //return $request;
        $transaction = new LibTransaction();
        $transaction->book_id = $request->book_id;
        $transaction->user_id = Auth::user()->id;
        $transaction->amount = $request->amount;
        $transaction->txn_dt = Carbon::now();
        $transaction->status = 1;
        $transaction->save();

        $book_request_id = $request['book_request_id'];
        $book_request = BookRequest::where('id',$book_request_id)->first();
        $book_request->issue_status = 3 ;
        $book_request->update();
        return redirect()->back()->with('success', 'Payment Done Successfully');
    }
    public function libraryCard(){
        $user_id = Auth::user()->id;
        $data = User::where('id', $user_id)->first();
        return view('admin.libraryuser.lib_card', compact('data'));
    }
    public function libraryCarddownload(){
        $user_id = Auth::user()->id;
        $data = User::where('id', $user_id)->first();
        $generator = new BarcodeGeneratorHTML();
       $barcode = $generator->getBarcode($data->registration_no, $generator::TYPE_CODE_128);

        return view('admin.libraryuser.lib_card_download', compact('data','barcode'));
    }

    public function bookRequestPreview(Request $request , $id){

        $book = BookRequest::orderBy('id', 'desc')->where('user_id',Auth::user()->id)->where('id',$id)->first();


        $book_data = Book::where('id',$book->book_id)->first();

        return view('admin.libraryuser.bookRequestPreview',compact('book_data','book'));
    }

    public function bookUserPreview(Request $request , $id=""){


        // $book = BookRequest::orderBy('id', 'desc')->where('user_id',Auth::user()->id)->where('id',$id)->first();
        // $book_data = Book::where('id',$id)->first();
        $book_data = Book::with(['category', 'images', 'bookRequest' => function ($query) {
            $query->where('user_id', Auth::id())->whereIn('issue_status', [0, 1, 3])->orderBy('id', 'desc')->first();
        }])
        ->where('status', 1)
        ->where('id', $id) // Add this condition
        ->orderBy('id', 'desc')
        ->first();
         $book_images = BookImages::where('book_id',$id)->get();
         $uniqueBookNumbers = BookLocation::where('book_id',$id)->select('unique_req_number')->distinct()
         ->get();
        return view('admin.libraryuser.bookUserPreview',compact('book_data','book_images','uniqueBookNumbers'));
    }


    public function profile(){
        $data = User::find(Auth::user()->id);
        $states = DB::table('states')->get();
        $cities =DB::table('cities')->get();

        return view('admin.libraryuser.library-user-profile',compact('data','states','cities'));
    }
}
