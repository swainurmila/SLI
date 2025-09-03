<?php

namespace App\Http\Controllers\Course\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCourse;
use App\Models\User;
use App\Models\Course\CrCategoryMaster;
use App\Models\Language;
use App\Models\Course\CrCourseCart;
use App\Models\Course\CrCourseRating;
use App\Models\Course\CrTransactionTable;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\CourseEnrollmentConfirmation;



class Cr_CourseController extends Controller
{
    public function index(Request $request)
    {
        //return $request;
        $course_categories = CrCategoryMaster::getCategoryLists();
        $languages = Language::getLanguageLists();

        $searchTerm = $request->input('search');
        // dd($searchTerm);
        if ($searchTerm) {
            $courses = CrCourse::with('UserCourseCart')->where('course_name', 'like', '%' . $searchTerm . '%')->orderBy('id', 'desc')->paginate(10);
        } else {
            $courses = CrCourse::getCourseLists();
        }


        $countFreeCourse = CrCourse::where('payment_type', 'free')->count();
        $countPaidCourse = CrCourse::where('payment_type', 'paid')->count();

        $countCertificateCourse = CrCourse::where('certificate_type', 'with')->count();
        $countWithoutCertificateCourse = CrCourse::where('certificate_type', 'without')->count();


        return view('course.user.course-list', compact('countPaidCourse', 'countFreeCourse', 'courses', 'course_categories', 'languages', 'countWithoutCertificateCourse', 'countCertificateCourse'));
    }


    public function searchCourse(Request $request)
    {

        $query = CrCourse::query();

        if ($request->filled('refine_by')) {
            $query->whereIn('payment_type', $request->input('refine_by'));
        }

        if ($request->filled('type')) {
            $query->whereIn('certificate_type', $request->input('type'));
        }

        if ($request->filled('course_category_id')) {
            $query->whereIn('course_category_id', $request->input('course_category_id'));
        }

        if ($request->filled('language_id')) {
            $query->whereIn('language_id', $request->input('language_id'));
        }

        // if ($request->filled('price_min') && $request->input('price_min') > 10) {
        //     $query->where('price', "<=",$request->input('price_min'));
        // }

        // $query->with('TrainingCategory.trainingEnrollment');
        $courses = $query->orderBy('id', 'desc')->get();

        $view = view('course.user.course-list-ajax', compact('courses'))->render();
        return response()->json(['html' => $view]);
    }


    public function courseDetails($id)
    {
        $courseDetails = CrCourse::getCourseDetails($id);

        //   dd($courseDetails);

        if ($courseDetails) {
            $related_trainings = CrCourse::where('course_category_id', $courseDetails->course_category_id)
                ->whereNotIn('id', [$id])
                ->get();

            $avg_ratings = CrCourseRating::with('userDetails')->where('course_id',$id)->avg('rating');
            $roundedAverageRating = round($avg_ratings, 2);

        } else {
            $related_trainings = [];
            $roundedAverageRating = 0;
        }
        $reviews = CrCourseRating::with('userDetails')->where('course_id',$id)->paginate(5);

        $isEnrolled = CrCourseCart::where('user_id',Auth::user()->id)->where('course_id',$id)->where('enroll_status','completed')->first();

        // dd($courseDetails);
        return view('course.user.course-details', compact('courseDetails', 'roundedAverageRating', 'related_trainings','reviews','isEnrolled'));
    }

    public function addToCart($id)
    {
        try {
            $add_to_cart = new CrCourseCart;
            $add_to_cart->user_id = Auth::user()->id;
            $add_to_cart->course_id = (int) $id;
            $add_to_cart->save();
            Session::flash('success', "Course added successfully !");
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', "Something went's wrong !");
            return redirect()->back();
        }

    }


    public function showCart()
    {

        $enrolledCourses = CrCourseCart::getCheckoutCourseLists();

        $cart_sum = CrCourseCart::with([
            'course' => function ($query) {
                $query->select('id', 'course_price');
            }
        ])
            ->where('user_id', Auth::user()->id)
            ->get();

        $totalSumOfPrices = $cart_sum->sum(function ($item) {
            return $item->course->course_price;
        });


        return view('course.user.cart.index', compact('enrolledCourses','totalSumOfPrices'));
    }

    public function removeFormCart($id)
    {
        try {
            $removeEnrolledCourses = CrCourseCart::removeEnrolledCourse($id);
            Session::flash('success', "Course remove successfully !");
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error', "Something went's wrong !");
            return redirect()->back();
        }

    }

    public function checkout($course_id)
    {
        $courseDetails = CrCourse::getCourseDetails($course_id);

        return view('course.user.cart.checkout',compact('courseDetails'));
    }

    public function enroll($course_id){
        $checkoutCourse = CrCourseCart::where('course_id',$course_id)->where('user_id',Auth::user()->id)->where('enroll_status','pending')->first();
            $price = CrCourse::where('id', $course_id)->first('course_price');

            if(isset($checkoutCourse)){
                $checkoutCourse->enroll_status = 'completed';
                $checkoutCourse->save();
                // Session::flash('success', "Course enrolled successfully !");
                // return redirect()->back();

            }else{
                $enrolledCourses = new CrCourseCart;
                $enrolledCourses->user_id = Auth::user()->id;
                $enrolledCourses->course_id = $course_id;
                $enrolledCourses->enroll_status = 'completed';
                $enrolledCourses->save();
            }
            //Saving transaction details
            $transaction = new CrTransactionTable;
            $transaction->course_id = $course_id;
            $transaction->user_id = Auth::user()->id;
            $transaction->amount = $price->course_price;
            $transaction->currency_type = 'INR';
            $transaction->status = 1;
            $transaction->save();

            $user = User::where('id',Auth::user()->id)->first();
            $course = CrCourse::find($course_id);
            $emailData = [
                'user_name' => $user->first_name,
                'course_name' => $course->course_name,
            ];
            Mail::to($user->email)->send(new CourseEnrollmentConfirmation($emailData));

            Session::flash('success', "Course enrolled successfully !");
            return redirect()->back();
        // try {
        //     $checkoutCourse = CrCourseCart::where('course_id',$course_id)->where('user_id',Auth::user()->id)->where('enroll_status','pending')->first();
        //     $price = CrCourse::where('id', $course_id)->first('course_price');

        //     if(isset($checkoutCourse)){
        //         $checkoutCourse->enroll_status = 'completed';
        //         $checkoutCourse->save();
        //         // Session::flash('success', "Course enrolled successfully !");
        //         // return redirect()->back();

        //     }else{
        //         $enrolledCourses = new CrCourseCart;
        //         $enrolledCourses->user_id = Auth::user()->id;
        //         $enrolledCourses->course_id = $course_id;
        //         $enrolledCourses->enroll_status = 'completed';
        //         $enrolledCourses->save();
        //     }
        //     //Saving transaction details
        //     $transaction = new CrTransactionTable;
        //     $transaction->course_id = $course_id;
        //     $transaction->user_id = Auth::user()->id;
        //     $transaction->amount = $price->course_price;
        //     $transaction->currency_type = 'INR';
        //     $transaction->status = 1;
        //     $transaction->save();

        //     $user = User::where('id',Auth::user()->id)->first();
        //     $course = CrCourse::find($course_id);
        //     $emailData = [
        //         'user_name' => $user->first_name,
        //         'course_name' => $course->course_name,
        //     ];
        //     Mail::to($user->email)->send(new CourseEnrollmentConfirmation($emailData));

        //     Session::flash('success', "Course enrolled successfully !");
        //     return redirect()->back();
        // } catch (\Throwable $th) {
        //     Session::flash('error', "Something went's wrong !");
        //     return redirect()->back();
        // }
    }

}
