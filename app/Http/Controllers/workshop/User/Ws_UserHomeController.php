<?php

namespace App\Http\Controllers\workshop\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\WsAddToCart;
use App\Models\Workshop\Workshop;
use Carbon\Carbon;
use Session;
use Auth;


class Ws_UserHomeController extends Controller
{
    public function index(){
        $current_date = Carbon::now()->format('Y-m-d');
         $workshop_lists = WsAddToCart::with('workshop')
        ->where('enroll_status', 'completed')
        ->get(); 

        $active_workshop = $workshop_lists->filter(function ($item) use ($current_date) {
            return $item->workshop->end_date >= $current_date;
        })->count();

        $completed_workshop = $workshop_lists->filter(function ($item) use ($current_date) {
            return $item->workshop->end_date < $current_date;
        })->count();

        $enrolledCourses = WsAddToCart::getEnrolledCourseLists();
        return view("workshop.user.home",compact('enrolledCourses', 'active_workshop', 'completed_workshop'));
    }

    public function userLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('workshop.login.show');
    }
}
