<?php

namespace App\Http\Controllers\workshop\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\Workshop;
use App\Models\Workshop\WsAddToCart;
use App\Models\Workshop\WsSchedule;
use App\Models\Workshop\WsPresentation;
use App\Models\Workshop\WsTransactionTable;
use App\Models\Workshop\WsWorkshopRating;
use Session;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\WorkshopEnrollmentConfirmation;
use Carbon\Carbon;


class Ws_EnrollController extends Controller
{
    public function index(Request $request){
        $current_date = Carbon::now()->format('Y-m-d');
        $searchTerm = $request->input('search');
        if ($searchTerm) {
            $workshop = Workshop::with('UserCourseCart')->where('title', 'like', '%' . $searchTerm . '%')->orderBy('id', 'desc')->paginate(10);
        } else {
            $workshop = Workshop::with('UserCourseCart')->where('title', 'like', '%' . $searchTerm . '%')->orderBy('id', 'desc')->paginate(10);
            // $workshop = Workshop::getCourseLists();
        }
        $countBoiler = Workshop::where('workshop_type', 'Boiler Management')->count();
        $countStress = Workshop::where('workshop_type', 'Stress Management')->count();
        $countOg = Workshop::where('workshop_type', 'Organizational Behaviour')->count();
        return view('workshop.user.workshop-list', compact("workshop", "current_date", "countBoiler", "countStress", "countOg"));
    }
    public function searchWorkshop(Request $request){
        $query = Workshop::query();

        if ($request->filled('type')) {
            $query->whereIn('workshop_type', $request->input('type'));
        }

        $workshop = $query->orderBy('id', 'desc')->get();
        $current_date = Carbon::now()->format('Y-m-d');
        $view = view('workshop.user.workshop-list-ajax', compact('workshop', 'current_date'))->render();
        return response()->json(['html' => $view]);
    }
    public function workshopDetails(Request $request, $id){
        //  return $id;
       $details = Workshop::with('UserCourseCart')->find($id);
       $schedule = WsSchedule::where('workshop_id',$id)->get();
       $presentation = WsPresentation::where('workshop_id',$id)->get();
       $reviews = WsWorkshopRating::with('userDetails')->where('workshop_id',$id)->where('is_delete', 1)->paginate(5);
       $isEnrolled = WsAddToCart::where('user_id',Auth::user()->id)->where('workshop_id',$id)->where('enroll_status','completed')->first();
       $current_date = Carbon::now()->format('Y-m-d');
        return view('workshop.user.workshop-details', compact('details','schedule', 'reviews','presentation', 'isEnrolled', 'current_date'));
    }
    public function addToCart($id)
    {
        try {
            // return $id;
            $add_to_cart = new WsAddToCart;
            $add_to_cart->user_id = Auth::user()->id;
            $add_to_cart->workshop_id = $id;
            $add_to_cart->save();
            Session::flash('success', "Workshop added successfully !");
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', "Something went's wrong !");
            return redirect()->back();
        }

    }
    public function showCart()
    {
        $enrolledCourses = WsAddToCart::getCheckoutWorkshopLists();

        $cart_sum = WsAddToCart::with([
            'workshop' => function ($query) {
                $query->select('id', 'price');
            }
        ])
            ->where('user_id', Auth::user()->id)
            ->get();

        $totalSumOfPrices = $cart_sum->sum(function ($item) {
            return $item->workshop->price;
        });


        return view('workshop.user.cart.index', compact('enrolledCourses','totalSumOfPrices'));
    }

    public function removeFormCart($id)
    {
        try {
            $removeEnrolledCourses = WsAddToCart::removeEnrolledWorkshop($id);
            Session::flash('success', "Workshop remove successfully !");
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', "Something went's wrong !");
            return redirect()->back();
        }

    }

    public function checkout($id)
    {
        // return $id;
        $courseDetails = Workshop::with('UserCourseCart')->where('id', $id)->first();

        return view('workshop.user.cart.checkout',compact('courseDetails'));
    }

    public function enroll($id){
        try {
            $checkoutCourse = WsAddToCart::where('workshop_id',$id)->where('user_id',Auth::user()->id)->where('enroll_status','pending')->first();
            $price = Workshop::where('id', $id)->first('price');

            if(isset($checkoutCourse)){
                $checkoutCourse->enroll_status = 'completed';
                $checkoutCourse->save();
            }else{
                $enrolledCourses = new WsAddToCart;
                $enrolledCourses->user_id = Auth::user()->id;
                $enrolledCourses->workshop_id = $id;
                $enrolledCourses->enroll_status = 'completed';
                $enrolledCourses->save();
            }
            //Saving transaction details
            $transaction = new WsTransactionTable;
            $transaction->workshop_id = $id;
            $transaction->user_id = Auth::user()->id;
            $transaction->amount = $price->price;
            $transaction->currency_type = 'INR';
            $transaction->status = 1;
            $transaction->save();
            $user = User::where('id',Auth::user()->id)->first();
            $course = Workshop::find($id);
            $emailData = [
                'user_name' => $user->first_name,
                'title' => $course->title,
            ];
            Mail::to($user->email)->send(new WorkshopEnrollmentConfirmation($emailData));

            Session::flash('success', "Workshop enrolled successfully !");
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', "Something went's wrong !");
            return redirect()->back();
        }
    }
}
