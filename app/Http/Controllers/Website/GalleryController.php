<?php

namespace App\Http\Controllers\Website;

use App\Models\Website\Gallery;
use App\Models\Language;
use App\Models\Website\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function index()
    {
        // return 1;

        $post = Post::where('post_type','gallery')->get();
        return view('admin.gallery.index',compact('post'));
    }

    public function create_gallery()
    {
        $lang = Language::all();
        return view('admin.gallery.create',compact('lang'));
    }

    public function gallery_store(Request $request)
    {
        //return $request;
        $translations_title = ['en' => $request->en_gallery, 'or' => $request->or_gallery];
        $userId = Auth::id();
        $currentDateTime = Carbon::now();
        $post = new Post();
        $post->setPostTitleAttribute($translations_title);
        $post->post_type = 'gallery';
        $post->post_author = $userId;
        $post->post_date = $currentDateTime;
        $post->save();
        return redirect()->route('gallery.index');
    }

    public function gallery_image_listing($id)
    {
        //return $id;
         $gallery = Post::find($id);
         $gallery = $gallery->gallery;
         return view('admin.gallery.slider_listing', compact('gallery','id'));
    }

    public function gallery_content($postId)
    {
        //return $postId;
        $lang = Language::all();
        return view('admin.gallery.content',compact('postId','lang'));
    }

    public function gallery_content_store(Request $request)
    {
        //return $request;
        $translations_title = ['en' => $request->en_title, 'or' => $request->or_title];
        $translations_desc = ['en' => $request->en_desc, 'or' => $request->or_desc];

        $gallery = new Gallery();
        $gallery->setGalleryTitleAttribute($translations_title);
        $gallery->setGalleryDescAttribute($translations_desc);
        $gallery->post_id = $request->post_id;
        $gallery->gallery_image = $request->post_attachment;

        $gallery->save();
        return redirect()->route('gallery.image.listing',[$request->post_id]);
    }

    public function gallery_image_edit($id)
    {
        //return $id;
       $lang = Language::all();
       $gallery = Gallery::where('id',$id)->first();
       return view('admin.gallery.edit', compact('gallery','lang','id'));
    }

    public function gallery_image_update(Request $request, $id)
    {
        //return $request;
        $gallery = Gallery::find($id);
        $translations_title = ['en' => $request->en_title, 'or' => $request->or_title];
        $translations_desc = ['en' => $request->en_desc, 'or' => $request->or_desc];

        $gallery->setGalleryTitleAttribute($translations_title);
        $gallery->setGalleryDescAttribute($translations_desc);


        //$gallery->post_id = $request->post_id;
        $gallery->gallery_image =  $request->post_attachment;

        $gallery->save();
        return redirect()->back();
    }
}
