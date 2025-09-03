<?php

namespace App\Http\Controllers\Website;

use App\Models\Language;
use App\Models\Website\Post;
use App\Models\Website\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class SliderController extends Controller
{
    public function index()
    {
        $post = Post::where('post_type','slider')->get();
        return view('admin.slider.index',compact('post'));
    }

    public function slider_image_listing($id)
    {

         $slider = Post::find($id);
         $slider = $slider->slider;
         return view('admin.slider.slider_listing', compact('slider','id'));
    }

    public function slider_image_edit($id)
    {
        //return $id;
       $lang = Language::all();
       $slider = Slider::where('id',$id)->first();
       return view('admin.slider.edit', compact('slider','lang','id'));
    }


    public function create_slider()
    {
        // $post = Post::where('post_type','slider')->get();
        return view('admin.slider.create');
    }
    public function slider_store(Request $request)
    {
        // $post = Post::where('post_type','slider')->get();
        //$product->setTranslation('name', 'en', $request->input('name'));
        //return 1;
        //return $request;
        //$ddd =$request->slider;
        $translations_title = ['en' => $request->slider, 'or' => ''];
        $userId = Auth::id();
        $currentDateTime = Carbon::now();
        $post = new Post();
        $post->setPostTitleAttribute($translations_title);
        $post->post_type = 'slider';
        $post->post_author = $userId;
        $post->post_date = $currentDateTime;
        $post->save();
        return redirect()->route('slider.index');
    }


    public function slider_content(Request $request, $postId)
    {
        $lang = Language::all();
        return view('admin.slider.content',compact('postId','lang'));
    }

    public function slider_content_store(Request $request)
    {
        //return $request;
        $translations_head = ['en' => $request->en_head, 'or' => $request->or_head];
        $translations_subhead = ['en' => $request->en_subhead, 'or' => $request->or_subhead];
        $translations_btn1 = ['en' => $request->en_txt1, 'or' => $request->or_txt1];
        $translations_btn2 = ['en' => $request->en_txt2, 'or' => $request->or_txt2];
        $slider = new Slider();
        $slider->setSliderHeadingAttribute($translations_head);
        $slider->setSliderSubheadAttribute($translations_subhead);
        $slider->setSliderBtn1Attribute($translations_btn1);
        $slider->setSliderBtn2Attribute($translations_btn2);
        $slider->btn_link = $request->btnlink1;
        $slider->btn_link1 = $request->btnlink2;
        $slider->post_id = $request->post_id;
        $slider->slider_image = $request->post_attachment;

        $slider->save();
        return redirect()->route('slider.index');
    }

    public function slider_image_update(Request $request, $id)
    {
        //return $request;
        $slider = Slider::find($id);
        $translations_head = ['en' => $request->en_head, 'or' => $request->or_head];
        $translations_subhead = ['en' => $request->en_subhead, 'or' => $request->or_subhead];
        $translations_btn1 = ['en' => $request->en_txt1, 'or' => $request->or_txt1];
        $translations_btn2 = ['en' => $request->en_txt2, 'or' => $request->or_txt2];

        $slider->setSliderHeadingAttribute($translations_head);
        $slider->setSliderSubheadAttribute($translations_subhead);
        $slider->setSliderBtn1Attribute($translations_btn1);
        $slider->setSliderBtn2Attribute($translations_btn2);
        $slider->btn_link = $request->btnlink1;
        $slider->btn_link1 = $request->btnlink2;
        //$slider->post_id = $request->post_id;
        $slider->slider_image =  $request->post_attachment;

        $slider->save();
        return redirect()->back();
    }
}
