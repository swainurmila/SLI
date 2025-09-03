<?php

namespace App\Http\Controllers\Training;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Training\TrCategory;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Training\TrCourse;
use App\Models\Training\TrModule;
use App\Models\Training\TrSubject;
use App\Models\Training\TrTrainingPlace;
use App\Models\Training\TrTraining;
use App\Models\Training\TrBatch;
use App\Models\Training\TrainingImages;
use App\Models\Training\TrTrainingOrder;
use App\Models\Training\TrAddToCart;
use App\Models\Training\TrTrainingDetail;
use App\Models\Training\TrStudentReview;
use App\Models\Training\TrTransactionTable;
use Carbon\Carbon;
use App\Models\Language;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\TrainingEnrollmentNotification;


class TrainingController extends Controller
{
      public function index(Request $request)
      {
          $tr_categores = TrCategory::with('trainings')->get();
          $tr_courses = TrCourse::get();
          $tr_modules = TrModule::get();
          $tr_subjects = TrSubject::get();
          $tr_training_places = TrTrainingPlace::get();
          $languages = Language::get();
  
          $searchTerm = $request->input('search');
          if ($searchTerm) {
              $training_lists = TrTraining::with('TrainingCategory')->where('name', 'like', '%' . $searchTerm . '%')->orderBy('id', 'desc')->paginate(10);
              $filteredData = [];
          } else {
              $query = TrTraining::with('TrainingCategory')->orderBy('id', 'desc');
              $filteredData = $request->all();
              if ($request->isMethod('POST')) {
                  if (isset($request->refine_by)) {
                      $query = $query->whereIn('payment_type', $request->refine_by);
                  }
                  if (isset($request->type)) {
                      $query = $query->whereIn('training_type', $request->type);
                  }
                  if (isset($request->training_category_id)) {
                      $query = $query->whereIn('training_category_id', $request->training_category_id);
                  }
                  if (isset($request->language_id)) {
                      $query = $query->whereIn('language_id', $request->language_id);
                  }
                  if (isset($request->payment_type)) {
                      $query = $query->whereIn('payment_type', $request->payment_type);
                  }
              }
              $training_lists = $query->orderBy('id', 'desc')->paginate(10);
          }
  
          return view('training.traininguser.training-list', compact('tr_categores', 'tr_courses', 'tr_modules', 'tr_subjects', 'tr_training_places', 'languages', 'training_lists', 'filteredData'));
      }
  
    public function UserTrainingList(){

        return view('training.traininguser.training-list');
    }
    public function searchTraining(Request $request){

      $query = TrTraining::query();

      if ($request->filled('refine_by')) {
          $query->whereIn('payment_type', $request->input('refine_by'));
      }

      if ($request->filled('type')) {
          $query->whereIn('training_type', $request->input('type'));
      }

      if ($request->filled('training_category_id')) {
          $query->whereIn('training_category_id', $request->input('training_category_id'));
      }

      if ($request->filled('language_id')) {
          $query->whereIn('language_id', $request->input('language_id'));
      }
      if (isset($request->payment_type)) {
        $query = $query->whereIn('payment_type', $request->payment_type);
    }
      // if ($request->filled('price_min') && $request->input('price_min') > 10) {
      //     $query->where('price', "<=",$request->input('price_min'));
      // }

      // $query->with('TrainingCategory.trainingEnrollment');
      $query->with('TrainingCategory');


      $training_lists = $query->orderBy('id', 'desc')->get();

      $view = view('training.traininguser.training-list-ajax', compact('training_lists'))->render();

      // Return the HTML response
      return response()->json(['html' => $view]);
    }

    public function courseDetails(Request $request,$id){

      // $training_deatils = TrTraining::with('TrainingCart','TrainingImage','TrainingEnrolls','language','TrainingCategory.trainingEnrollment')->find($id);
      $training_deatils = TrTraining::with('TrainingCart','TrainingImage','TrainingEnrolls','language','TrainingCategory')->find($id);

      if($training_deatils){
        $training_order = TrTrainingOrder::with('trainingDetails')->where('training_id',$training_deatils->id)->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();


        $related_trainings = TrTraining::with('TrainingImage','TrainingClasses','TrainingCategory.trainingEnrollment')->where('training_category_id', $training_deatils->training_category_id)
        ->whereNotIn('id', [$id])
        ->get();

        $reviews = TrStudentReview::with('userDetails')->where('training_id',$training_deatils->id)->paginate(5);
        $avg_ratings = TrStudentReview::with('userDetails')->where('training_id',$training_deatils->id)->avg('rate');
        $roundedAverageRating = round($avg_ratings, 2);

      }else{
        $training_order = [];
        $related_trainings = [];
        $roundedAverageRating = 0;
      }

      // dd($training_order);

      return view('training.traininguser.training-details',compact('training_deatils','training_order','related_trainings','reviews','roundedAverageRating'));
  }

  public function cart(){
    // $cart_lists = TrAddToCart::with('trainingImage','training.TrainingCategory.trainingEnrollment')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();

    $cart_lists = TrAddToCart::with('trainingImage','training')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();


    $cart_sum = TrAddToCart::withSum('training', 'price')
    ->where('user_id', Auth::user()->id)
    ->get();

    $totalSumOfPrices = $cart_sum->sum('training_sum_price');


    // dd($cart_lists);
    return view('training.traininguser.cart',compact('cart_lists','totalSumOfPrices'));
  }

  public function enroll($id){

    $training_details = TrTraining::with('Place','language')->where('id',$id)->first();

    if($training_details){
      $training_batches = TrBatch::with('trainingOrder','trainingDetailsAccBatch')->where('training_id',$training_details->id)->get();

      $training_order = TrTrainingOrder::with('trainingDetails')->where('training_id',$training_details->id)->where('user_id',Auth::user()->id)->orderBy('id','desc')->first();
    }

    // dd($training_order);

    return view('training.traininguser.checkout',compact('training_details','training_batches','training_order','training_batches'));
  }

  public function order(Request $request,$id){

    $request->validate([
      "batch_time"=>'required'
    ]);

    //return $request;

    $training = TrTraining::find($id);
    $training_details = TrTrainingDetail::with('batch')->where('batch_id',$request->batch_time)->whereDate('start_date', '>', Carbon::today())->first();

    // $training_details = TrTrainingDetail::with('batch')->where('batch_id',$request->batch_time)->first();


    // dd($training_details);

    if($training && $training_details){
      if ($training_details->batch->max_student > TrTrainingOrder::where('batch_id', $request->batch_time)->where('training_details_id',$training_details->id)->count()) {
          $training_order = new TrTrainingOrder;
          $training_order->user_id = Auth::user()->id;
          $training_order->training_id = $training->id;
          $training_order->training_course_id = $training->training_course_id;
          $training_order->training_place_id = $training->training_place_id;
          $training_order->subject_id = $training->subject_id;
          $training_order->training_details_id = $training_details->id;
          $training_order->training_category_id = $training->training_category_id;
          $training_order->training_duration_type = $training->training_duration_type;
          $training_order->training_duration = $training->training_duration;
          $training_order->selling_price = $training->price;
          $training_order->original_price = $training->price;
          $training_order->module_details_id = $training->module_details_id;
          $training_order->payment_type = $training->payment_type;
          $training_order->training_type = $training->training_type;
          $training_order->batch_id = $request->batch_time;
          $training_order->training_name = $training->name;
          $training_order->language_id = $training->language_id;
          $training_order->description = $training->description;
          $training_order->save();
          $checkCart = TrAddToCart::where('training_id',$id)->first();
          if($checkCart){
            $deleteItem = $checkCart->delete();
          }
      } else {
          $batchCounter = 0;
          while (true) {
            $nextBatch = TrTrainingDetail::with('batch')->where('batch_id', $request->batch_time)
                ->where('start_date', '>=', $training_details->start_date)
                ->whereDate('start_date', '>=', Carbon::today())
                ->orderBy('start_date')
                ->skip($batchCounter)
                ->first();
            if ($nextBatch && $nextBatch->batch->max_student > TrTrainingOrder::where('batch_id', $nextBatch->batch_id)->where('training_details_id',$nextBatch->id)->count()) {
                // Next batch found and maximum students not reached, insert data for the next batch
                $training_order = new TrTrainingOrder;
                $training_order->user_id = Auth::user()->id;
                $training_order->training_id = $training->id;
                $training_order->training_course_id = $training->training_course_id;
                $training_order->training_place_id = $training->training_place_id;
                $training_order->subject_id = $training->subject_id;
                $training_order->training_details_id = $nextBatch->id;
                $training_order->training_category_id = $training->training_category_id;
                $training_order->training_duration_type = $training->training_duration_type;
                $training_order->training_duration = $training->training_duration;
                $training_order->selling_price = $training->price;
                $training_order->original_price = $training->price;
                $training_order->module_details_id = $training->module_details_id;
                $training_order->payment_type = $training->payment_type;
                $training_order->training_type = $training->training_type;
                $training_order->batch_id = $request->batch_time;
                $training_order->training_name = $training->name;
                $training_order->language_id = $training->language_id;
                $training_order->description = $training->description;
                $training_order->save();
                $checkCart = TrAddToCart::where('training_id',$id)->first();

                if($checkCart){
                  $deleteItem = $checkCart->delete();
                }
                break;
            }else{
              $training_order = new TrTrainingOrder;
              $training_order->user_id = Auth::user()->id;
              $training_order->training_id = $training->id;
              $training_order->training_course_id = $training->training_course_id;
              $training_order->training_place_id = $training->training_place_id;
              $training_order->subject_id = $training->subject_id;
              // $training_order->training_details_id = null;
              $training_order->training_category_id = $training->training_category_id;
              $training_order->training_duration_type = $training->training_duration_type;
              $training_order->training_duration = $training->training_duration;
              $training_order->selling_price = $training->price;
              $training_order->original_price = $training->price;
              $training_order->module_details_id = $training->module_details_id;
              $training_order->payment_type = $training->payment_type;
              $training_order->training_type = $training->training_type;
              $training_order->batch_id = $request->batch_time;
              $training_order->training_name = $training->name;
              $training_order->language_id = $training->language_id;
              $training_order->description = $training->description;
              $training_order->save();
              $checkCart = TrAddToCart::where('training_id',$id)->first();

              if($checkCart){
                $deleteItem = $checkCart->delete();
              }
              break;
            }
            $batchCounter++;
          }
      }
    }else{
      //return 2;
      $training_order = new TrTrainingOrder;
      $training_order->user_id = Auth::user()->id;
      $training_order->training_id = $training->id;
      $training_order->training_course_id = $training->training_course_id;
      $training_order->training_place_id = $training->training_place_id;
      $training_order->subject_id = $training->subject_id;
      $training_order->training_category_id = $training->training_category_id;
      $training_order->training_duration_type = $training->training_duration_type;
      $training_order->training_duration = $training->training_duration;
      $training_order->selling_price = $training->price;
      $training_order->original_price = $training->price;
      $training_order->payment_type = $training->payment_type;
      $training_order->training_type = $training->training_type;
      $training_order->batch_id = $request->batch_time;
      $training_order->training_name = $training->name;
      $training_order->language_id = $training->language_id;
      $training_order->description = $training->description;
      $training_order->save();
      $checkCart = TrAddToCart::where('training_id',$id)->first();
      if($checkCart){
        $deleteItem = $checkCart->delete();
      }
    }

    //Saving transaction details
    $transaction = new TrTransactionTable;
    $transaction->training_id = $training->id;
    $transaction->user_id = Auth::user()->id;
    $transaction->amount = $training->price;
    $transaction->currency_type = 'INR';
    $transaction->status = 1;
    $transaction->save();

    $user = User::where('id',Auth::user()->id)->first();
    $training = TrTraining::find($id);
    $emailData = [
        'user_name' => $user->first_name,
        'name' =>$training->name,
    ];
    Mail::to($user->email)->send(new TrainingEnrollmentNotification($emailData ));


    return redirect()->back();
  }

  public function addCart(Request $request,$id){

    $add_cart =  new TrAddToCart();
    $add_cart->user_id =  Auth::user()->id;
    $add_cart->training_id = $id;
    $add_cart->save();

    return redirect()->back();
  }

  public function cartRemove($id){
    $remove_cart_item = TrAddToCart::find($id)->delete();

    if($remove_cart_item){
      Session::flash('success','Item Successfully Removed !');
      return redirect()->back();
    }else{
      Session::flash('error','Something wents wrong !');
      return redirect()->back();
    }
  }



  public function storeReview(Request $request,$id){


    $request->validate([
      'rate'=>'required',
      'feedback'=>'required'
    ]);

    $review = new TrStudentReview;
    $review->training_id = $id;
    $review->user_id = Auth::user()->id;
    $review->rate = $request->rate;
    $review->feedback = $request->feedback;
    $review->save();

    if($review->save()){
      Session::flash('success','Added Successfully !');
      return redirect()->back();
    }
  }

}
