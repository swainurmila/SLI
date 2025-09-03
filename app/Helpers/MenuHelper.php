<?php

use App\Models\Website\Gallery;
use App\Models\Website\LatestNews;
use App\Models\Website\MenuItem;
use App\Models\Website\Post;
use App\Models\Website\Projects;
use App\Models\Website\Slider;
use App\Models\Website\TeamMember;
use App\Models\Website\Tender;

  function MenuItem($id,$columnName,$locale = null)
    {

      //  dd($columnName,$locale);

      if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = MenuItem::find($id);
       $title = $title->getTranslation($columnName,$locale);
      //  $title = $title->title;
       return  $title;
    }
  function Slider($id,$columnName,$locale = null)
    {

       // return 1123;

       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = Slider::find($id);
       $title = $title->getTranslation($columnName,$locale);
       //$title = $title->title;
       return  $title;
    }
  function Tender($id,$columnName,$locale = null)
    {

       // return 1123;

       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = Tender::find($id);
       $title = $title->getTranslation($columnName,$locale);
       //$title = $title->title;
       return  $title;
    }
    function LatestNews($id,$columnName,$locale = null)
    {

       // return 1123;
       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = LatestNews::find($id);
       $title = $title->getTranslation($columnName,$locale);
       //$title = $title->title;
       return  $title;
    }
    function TeamMember($id,$columnName,$locale = null)
    {

       // return 1123;

       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = TeamMember::find($id);
       $title = $title->getTranslation($columnName,$locale);
       //$title = $title->title;
       return  $title;
    }
  function Post($id,$columnName,$locale = null)
    {

       // return 1123;

       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = Post::find($id);
       $title = $title->getTranslation($columnName,$locale);
       //$title = $title->title;
       return  $title;
    }

    function Gallery($id,$columnName,$locale = null)
    {

       // return 1123;

       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = Gallery::find($id);
       $title = $title->getTranslation($columnName,$locale);
       //$title = $title->title;
       return  $title;
    }
    function Projects($id,$columnName,$locale = null)
    {

       // return 1123;

       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = Projects::find($id);
       $title = $title->getTranslation($columnName,$locale);
       //$title = $title->title;
       return  $title;
    }

    function PostTitle($id,$columnName,$locale = null)
    {

       // return 1123;

       if (is_null($locale)) {
         $locale = app()->getLocale(); // Default to the app's locale
     }

       $title = Projects::find($id);
       $postTitle = Post::find($title->post_id);
       $postTitle = $postTitle->getTranslation($columnName,$locale);

       return  $postTitle;
    }
