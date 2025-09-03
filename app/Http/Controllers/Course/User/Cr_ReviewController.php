<?php

namespace App\Http\Controllers\Course\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCourseRating;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Cr_ReviewController extends Controller
{
    public function reviewStore(Request $request,$id){

        try {
            $review = new CrCourseRating;
            $review->user_id = Auth::user()->id;
            $review->course_id = $id;
            $review->rating = $request->rate;
            $review->feedback = $request->feedback;
            $review->save();
            Session::flash('success','Rating successfully added !');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error',"Something went's wrong !");
            return redirect()->back();
        }

    }

    public function getAllReviews(){
        $feedbacks = CrCourseRating::with('courseDetails')->where('user_id',Auth::user()->id)->paginate(10);
        return view('course.user.profile.reviews',compact('feedbacks'));
    }

    public function destroy($id){
        try {
            $review = CrCourseRating::find($id)->delete();
            Session::flash('success','Rating successfully removed !');
            return redirect()->back();
        } catch (\Throwable $th) {
            Session::flash('error',"Something went's wrong !");
            return redirect()->back();
        }
    }
}
