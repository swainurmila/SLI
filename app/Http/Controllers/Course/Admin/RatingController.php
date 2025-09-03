<?php

namespace App\Http\Controllers\Course\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course\CrCourseRating;

class RatingController extends Controller
{
    public function index(){
        $reviews = CrCourseRating::get();
        return view('course.admin.review.index',compact('reviews'));
    }
}
