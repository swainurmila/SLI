<?php

namespace App\Http\Controllers\workshop;

use App\Http\Controllers\Controller;
use App\Models\Workshop\WsWorkshopRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class Ws_ReviewController extends Controller
{
    public function reviewStore(Request $request,$id){

        try {
            $review = new WsWorkshopRating;
            $review->user_id = Auth::user()->id;
            $review->workshop_id = $id;
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
        $feedbacks = WsWorkshopRating::with('workshopDetails')->where('user_id',Auth::user()->id)->paginate(10);
        return view('workshop.user.profile.reviews',compact('feedbacks'));
    }


}
