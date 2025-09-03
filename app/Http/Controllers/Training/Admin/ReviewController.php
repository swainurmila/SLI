<?php

namespace App\Http\Controllers\Training\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Training\TrStudentReview;
use Auth;
class ReviewController extends Controller
{
    public function index(){
        if(Auth::user()->role_id == '3'){
            $reviews = TrStudentReview::with('userDetails','trainingDetails')->get();
        }else{
            $reviews = TrStudentReview::with('userDetails', 'trainingDetails')
            ->whereHas('trainingDetails', function ($query) {
                $query->where('created_by', Auth::user()->id);
            })
            ->get();
        }


        return view('training.admin.reviews.index',compact('reviews'));
    }

    public function destroy($id){
        $review = TrStudentReview::find($id)->delete();

        if($review){
            return redirect()->back();
        }
    }
}
