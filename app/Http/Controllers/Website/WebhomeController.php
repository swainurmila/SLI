<?php

namespace App\Http\Controllers\Website;


use App\Models\Website\Gallery;
use App\Models\Language;
use App\Models\Website\LatestNews;
use App\Models\Website\Menu;
use App\Models\Website\MenuItem;
use App\Models\Website\Post;
use App\Models\Website\Projects;
use App\Models\Website\Slider;
use App\Models\Website\TeamMember;
use App\Models\Website\QuickLinks;
use App\Models\Website\AboutUs;
use App\Models\Website\ContactUs;
use App\Models\Website\Tender;
use App\Models\Website\Partners;

use App\Models\Website\HomeService;
use App\Models\Website\SCHEMESANDSERVICES;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class WebhomeController extends Controller
{
    public function web_index(Request $request)
    {

        if ($request->lang) {

            $lang = $request->lang;
        } else {

            $lang = 'en';
        }


        app()->setLocale($lang);
        $switchLanguageUrl = $this->switchLanguageUrl($lang);

        // return $lang;
        $menu = Menu::where('location', 'mian_menu')->value('content');
        if ($menu == '') {
            $menu = [];
        } else {
            $menu = json_decode($menu);
            $menu = $menu[0];
        }

        //return $menu;


        $menu = MenuItem::allData($menu);
        $language = Language::all();


       // $current_lang_url = url()->current();
        //$current_lang_url =  Str::afterLast($current_lang_url, '/');
        if(url()->current() == url('/') || url()->current() == url('/en') ||  url()->current() == url('/or'))
        {
            $current_lang_url = '';
        }else{
            $current_lang_url = url()->current();
            $current_lang_url =  Str::afterLast($current_lang_url, '/');
        }


        //$slider = Post::where('post_type','slider')->where('post_slug','main-slider')->value('id');

        // $slider = Slider::where('post_id',$slider)->get();
        // foreach ($slider as $key => $value) {

        //     $slider = Post::find($value->id);
        //     //$value->title = $slider->getTranslations('post_title');
        //    // dd($slider);
        // }
        // return $slider->where('post_title');

        // return $slider = $slider->getTranslation('post_title', 'en');
        // $slider = $slider->
        $slider = Slider::where('status',1)->get();
        $gallery = Gallery::all();
        $team = TeamMember::take(3)->get();
        $tender = Tender::all();
        //$latestNews =LatestNews::where('status',1)->get(['title','show_new_icon','custom_link','attachment_file']);
        $latestNews =LatestNews::all();
        $abt_dept = Post::find(30);
        //$impoLinks = ImportantLinks::all();
        $projects = Projects::all();
        $quickLinks=QuickLinks::all();
        $aboutus = AboutUs::latest()->first();
        $contactus = ContactUs::latest()->first();
        $partners = Partners::get();
        
    //    return $projects =  DB::table('projects as pro')->select('pro.*','post.post_title','post.id as postId')
    //    ->join('posts  as post', 'post.id','pro.post_id')->get();
       //->where('pro.post_id','post.id')->get();
	//$last_stu_id = $student->id;
	
       //return $projects->post_title;


       $homeservice = HomeService::where('slug', 'about-us')->first();
       $labourwelfare = HomeService::where('slug', 'labour-welfare-initiatives')->first();
       $schemeservice = HomeService::where('slug', 'our-schemes-services')->first();
       $schemes = SCHEMESANDSERVICES::get();

        return view('frontend.home', compact('schemes','schemeservice','labourwelfare','homeservice','switchLanguageUrl','menu', 'lang','language','current_lang_url','slider','gallery','abt_dept','team','tender','latestNews','projects','quickLinks','aboutus','contactus','partners'));
    }

    public function page_view(Request $request,$lang, $slug)
    {
        // return 41;
        // return $slug;
       if(url()->current() == url('/') || url()->current() == url('/en') ||  url()->current() == url('/or'))
       {
           $current_lang_url = url()->current();
       }else{
           $current_lang_url = url()->current();
           $current_lang_url =  Str::afterLast($current_lang_url, '/');
       }

        app()->setLocale($lang);
        $switchLanguageUrl = $this->switchLanguageUrl($lang, $slug);

        $menu = Menu::where('location', 'mian_menu')->value('content');
        if ($menu == '') {
            $menu = [];
        } else {
            $menu = json_decode($menu);
            $menu = $menu[0];
        }
        $menu = MenuItem::allData($menu);
        $slider = Slider::where('status',1)->get();
        $page = Post::where('post_slug', $slug)->first();


        //$newsItem->getTranslation('post_title', 'nl');
        // return $page;
        // return $page = Post::find(1)->pageTemplate;
        // return $page->pageTemplate->temp_slug;
        $gallery = Post::where('post_type','gallery')->get();
       // $gallery = Post::find(17);
        foreach ($gallery as $key => $value) {
            $post = Post::find($value->id);
            // $gallery['post'] =  $post;
            // $gallery['gallery'] =  $post->gallery;
            $value['gallery'] =  $post->gallery;
        }
        //$advertise = Advertisements::all();
        //return $gallery;
        // return $gallery = $gallery->gallery;
        $language = Language::all();
        $tender = Tender::all();
        $quickLinks=QuickLinks::all();
        $aboutus = AboutUs::latest()->first();
        $contactus = ContactUs::latest()->first();


        //soumyastartcode
      $publicdet = Post::where('post_type', 'publicationdetails')->get();

      $publications = [];
     
      foreach ($publicdet as $publication) {
      $postId = $publication->id;
      $postTitle = $publication->post_title;
    $postTitle=str_replace(['_', '-',' '],'',$postTitle);


      $modelName = ucfirst($postTitle);

     $modelName = 'App\\Models\\Website\\' . $modelName;

   
      $publicationData = $modelName::where('post_id', $postId)->get();

      if ($publicationData) {
            $publication['data'] = $publicationData;
       }
    
      $publications[] = $publication;
      }
      $allphoto=Gallery::all();

   
        return view('frontend.innerpage', compact('switchLanguageUrl','page','menu','lang','language','current_lang_url','gallery','tender','slider','quickLinks','aboutus','contactus','publications','allphoto'));
    }

    public function post_view(Request $request,$lang,$postId,$postType,$post)
    {
        $page = Projects::where('post_id',$postId)->first();
        $language = Language::all();
        if(url()->current() == url('/') || url()->current() == url('/en') ||  url()->current() == url('/or'))
       {
           $current_lang_url = url()->current();
       }else{
           $current_lang_url = url()->current();
           $current_lang_url =  Str::afterLast($current_lang_url, '/');
       }


       app()->setLocale($lang);
        $switchLanguageUrl = $this->switchLanguageUrl($lang, $postId, $postType, $post);

       $menu = Menu::where('location', 'mian_menu')->value('content');
        if ($menu == '') {
            $menu = [];
        } else {
            $menu = json_decode($menu);
            $menu = $menu[0];
        }
        $menu = MenuItem::allData($menu);
        return view('frontend.single',compact('switchLanguageUrl','page','lang','language','current_lang_url','menu'));
    }



    private function switchLanguageUrl($currentLang, ...$params)
    {
        $newLang = $currentLang === 'en' ? 'or' : 'en'; // switch between 'en' and 'or'
        $currentUrl = request()->getPathInfo(); // gets the current path
        $newUrl = '/' . $newLang . '/' . implode('/', array_slice(explode('/', $currentUrl), 2));
        return url($newUrl);
    }
}
