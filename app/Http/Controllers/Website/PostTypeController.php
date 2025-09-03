<?php

namespace App\Http\Controllers\Website;

use App\Traits\PostTrait;
use App\Models\Website\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PostTypeController extends Controller
{
    use PostTrait;
    public function index()
    {
        //$postType = Post::where('')
        // return 1;
        $excludedValues = ['page', 'slider', 'gallery','quickLinks','about us','contact us','mainHeader','publicationdetails'];
        $postType = Post::whereNotIn('post_type',$excludedValues)->get();
        return view('admin.post_types.index',compact('postType'));

    }



    public function create()
    {
        // return 1;
        return view('admin.post_types.create');
    }

    // public function store(Request $request)
    // {
    //     $translations_title = ['en' => $request->name, 'or' => ''];
    //     $userId = Auth::id();
    //     $currentDateTime = Carbon::now();
    //     $post = new Post();
    //     $post->setPostTitleAttribute($translations_title);
    //     $post->post_type = $request->name;
    //     $post->post_author = $userId;
    //     $post->post_date = $currentDateTime;
    //     $post->save();

    //     $lastInsertId = $post->id;

    //     $this->createModel($request->name,$lastInsertId);
    //     return redirect()->route('post.index');
    // }

     public function store(Request $request)
    {
        $titleName = $request->input('name');
        $existingPost = Post::where('post_type', $titleName)->first();
        if ($existingPost) {
       

            return redirect()->back()->with('error', 'Posttype name already exists');
        }
        $publication=$request->flag;
        if ($publication) {
            $translations_title = ['en' => $request->name, 'or' => ''];
        $userId = Auth::id();
        $currentDateTime = Carbon::now();
        $post = new Post();
        $post->setPostTitleAttribute($translations_title);
        $post->post_type = 'publicationdetails';
        $post->post_author = 1;
        $post->post_date = $currentDateTime;
        $post->save();

        $lastInsertId = $post->id;

        $this->createModel($request->name,$lastInsertId);
        return redirect()->route('post.index');
        } else {
           $translations_title = ['en' => $request->name, 'or' => ''];
        $userId = Auth::id();
        $currentDateTime = Carbon::now();
        $post = new Post();
        $post->setPostTitleAttribute($translations_title);
        $post->post_type = $request->name;
        $post->post_author = 1;
        $post->post_date = $currentDateTime;
        $post->save();

        $lastInsertId = $post->id;

        $this->createModel($request->name,$lastInsertId);
        return redirect()->route('post.index');
        }
        
        
    }

    public function delete(Request $request,$id)
    {
        //return $postType;
        // $this->deleteModel($id);
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }
//soumyacodestart
    public function post_details($id)
    {
        $publication='publicationdetails';
        $postType = Post::where('post_type',$publication)->get();
        return view('admin.post_types.publication.publication',compact('postType'));
    }

    public function postdetails_create()
    {
        $flag='postdetails';
        return view('admin.post_types.publication.createpublicationdetails',compact('flag'));
    }
//soumyacodeend

}
