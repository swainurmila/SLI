<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Models\Website\Menu;
use App\Models\Website\MenuItem;
use App\Models\Website\Category;
use App\Models\Website\CustomArray;
use App\Models\Language;
use App\Models\Website\Pages;
use App\Models\Website\Post;
use Illuminate\Support\Facades\DB;
use Session;
use Str;
use Spatie\Translatable\HasTranslations;
class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $excludedValues = ['page', 'slider', 'gallery','Team Member','Latest News','projects','Tender','mainHeader','publicationdetails','Publication'];
        $postType = Post::whereNotIn('post_type',$excludedValues)->get();
        return view('admin.post_types.index',compact('postType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
