<?php

namespace App\Http\Controllers\workshop\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Workshop\Workshop;
use App\Models\Workshop\WsAddToCart;
use App\Models\User;
use Session;
use Auth;


class Ws_HomeController extends Controller
{
    public function index(){

        // $user = Auth::user();
        // $user->assignRole('Workshop Admin');
        $enrolled_student = WsAddToCart::with('transaction', 'workshop', 'user')->count();
        $totalWorkshops = Workshop::count();
        $user_detail_pending = User::where('role_id', 5)->orderBy('id', 'desc')->where('status',0)->where('is_workshop','1')->with('createdBy')->count();
        $user_detail_reject = User::where('role_id', 5)->where('status',2)->orderBy('id', 'desc')->where('is_workshop','1')->with('createdBy')->count();
        return view("workshop.admin.dashboard",compact('totalWorkshops','enrolled_student','user_detail_pending','user_detail_reject'));
    }

    public function adminLogout(){
        Session::flush('success','Successfully Logged out !');
        Auth::logout();
        return redirect()->route('workshop.login.show');
    }
}
