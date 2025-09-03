<?php

namespace App\Http\Controllers\Research;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\User;
use Auth;

class ResearchUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $states = DB::table('states')->get();
        $cities = DB::table('cities')->get();
        $user_detail_pending = User::where('role_id', 13)
        ->orderBy('id', 'desc')
        ->where('is_delete', 1)
        ->whereIn('status', [0, 1])
        ->where('is_research', '1')
        ->get();
        $user_detail_approve = User::where('role_id', 13)->where('status',1)->orderBy('id', 'desc')->where('is_delete',2)->where('is_research','1')->get();
        $user_detail_reject = User::where('role_id', 13)->where('status',2)->orderBy('id', 'desc')->where('is_research','1')->get();
        
        return view('research.admin.users.index',compact('user_detail_pending', 'states', 'cities','user_detail_approve','user_detail_reject'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
