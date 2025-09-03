<?php

namespace App\Http\Controllers\Website;

use App\Models\Language;
use App\Models\Website\Pages;
use App\Models\Website\PageTemplate;
use App\Models\Website\Post;
use Illuminate\Http\Request;
use Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class PageController extends Controller
{
    public function all_pages()
    {
        $pages = Post::where('post_type','page')->get();
        // $page = Post::find(1);
        // return $page->getTranslation('post_title','en');


        return view('admin.pages.index', compact('pages'));
    }
    public function add_page_index()
    {
        $lang = Language::all();
        $template = PageTemplate::all();
        return view('admin.pages.addPage',compact('lang','template'));
    }

    public function page_store(Request $request)
    {
    //    return $request;
        // if($request->hasFile('featured_img'))
        // {
        //     $postImg = $request->file('featured_img');
        //     $postImgName = time() . '.' . $postImg->getClientOriginalExtension();
        //     $postImgPath = $request->file('featured_img')->move('lang/', $postImgName);
        // }
       $userId = Auth::id();
       $currentDateTime = Carbon::now();

       $string = mb_substr($request->or_title, 1, 2, "UTF-8");


       $post = new Post;

    //    $array = ['€', 'http://example.com/some/cool/page', '337'];
    //    $bad   = json_encode($array,  JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK);
    //json_encode($value, JSON_UNESCAPED_UNICODE)
    //$jsonData = json_encode($request->or_title, JSON_UNESCAPED_UNICODE);

    // $translations = ['en' => $request->en_title, 'or' => $request->or_title,];
    // $post->setYourFieldAttribute($translations);

    //   // $post->post_type = $jsonData;
    //   //return $translations = ['or' => $jsonData];
    //    //return $translations;
    //  //  $post->post_title = $translations;
    //    //$post->setTranslation('post_title', 'or', $jsonData);
    //    $post->post_author = $userId;
    //    $post->post_date = $currentDateTime;
    //    $post->post_status = $request->page_status;
    //    $post->post_attachment = $request->post_attachment != '' ? $request->post_attachment : '';
    //    $post->post_type = 'page';

     //  $post->save();

     $translations_title = ['en' => $request->en_title, 'or' => $request->or_title,];
     $translations_content = ['en' => $request->en_content, 'or' => $request->or_content,];
     $translations_excerpt = ['en' => $request->en_excerpt, 'or' => $request->or_excerpt,];

       $post->post_author = $userId;
       $post->post_date = $currentDateTime;
       $post->post_status = $request->page_status;
       $post->post_attachment = $request->post_attachment != '' ? $request->post_attachment : '';
       $post->post_type = 'page';
       $post->page_template_id = $request->page_template_id;
       $post->setPostTitleAttribute($translations_title);
       $post->setPostContentAttribute($translations_content);
       $post->setPostExcerptAttribute($translations_excerpt);
    //    $post->setTranslation('post_title', 'or', mb_substr($request->or_title, 1, 2, "UTF-8"));

    //    $post->setTranslation('post_content', 'en', $request->en_content);
    //    $post->setTranslation('post_content', 'or', $request->or_content);

    //    $post->setTranslation('post_excerpt', 'en', $request->en_excerpt);
    //    $post->setTranslation('post_excerpt', 'or', $request->or_excerpt);

       $post->save();

        // $post_data = [
        //     'post_author' => $userId,
        //     'post_date' => $currentDateTime,
        //     'post_status' => $request->page_status,
        //     'post_attachment' => $request->post_attachment,

        //     'post_type' => 'page',
        //     'en' => [
        //         'post_title' => $request->en_title,
        //         'post_content' => $request->en_content,
        //         'post_excerpt' => $request->en_excerpt,
        //     ],
        //     'or' => [
        //         'post_title'   => $request->or_title,
        //         'post_content'   => $request->or_content,
        //         'post_excerpt'   => $request->or_excerpt,
        //     ],
        //  ];

        //Post::create($post_data);

        return redirect()->route('page.index');
    }

    public function page_edit($id)
    {
        //return $id;
        $lang = Language::all();
        $page = Post::where('id',$id)->first();
        $pageTemp = PageTemplate::get();
        return view('admin.pages.edit',compact('page','id','lang','pageTemp'));
    }

    public function page_update(Request $request,$id)
    {
        // return $request;
        $post = Post::find($id);
        // $page->title = $request->title ;
        // $page->save();
       $userId = Auth::id();
       $currentDateTime = Carbon::now();


       $translations_title = ['en' => $request->en_title, 'or' => $request->or_title,];
       $translations_content = ['en' => $request->en_content, 'or' => $request->or_content,];
       $translations_excerpt = ['en' => $request->en_excerpt, 'or' => $request->or_excerpt,];

       $post->post_author = $userId;
       $post->post_date = $currentDateTime;
       $post->post_status = $request->page_status;
       $post->post_attachment = $request->post_attachment != '' ? $request->post_attachment : '';
       $post->post_type = 'page';
       $post->page_template_id = $request->page_template_id;
       $post->setPostTitleAttribute($translations_title);
       $post->setPostContentAttribute($translations_content);
       $post->setPostExcerptAttribute($translations_excerpt);

         $post->save();
        return redirect()->back();
    }

    public function page_delete($id)
    {

        Post::findOrFail($id)->delete();
        return redirect()->route('page.index');
    }
}
