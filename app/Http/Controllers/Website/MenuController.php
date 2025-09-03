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


class MenuController extends Controller
{

    use HasTranslations;
    public function menu_index(Request $request)
    {
      //return $request->id;
      if(isset($request->id)){
         $id = $request->id;
        if($id == '')
        {

          $selectedMenu = '';
        }else{


            $selectedMenu = Menu::find($id);

             if($selectedMenu->content == '' || $selectedMenu->content == '[[]]')
             {
            //  return 11;
                $menuItems = MenuItem::where('menu_id',$selectedMenu->id)->get();

             }else{
              // return 22;
             //return $menuItems =  MenuItem::all();



               //$menuItems = new MenuItem();
                //$menuItems = MenuItem::allData($menuItems);
                //return $menuItems = MenuItem::testFun();

                $menuItems = new MenuItem();
                $menuItems = json_decode($selectedMenu->content);
                $menuItems =  $menuItems[0];
                //$menuItems = (object) $menuItems;
                $menuItems = MenuItem::allData($menuItems);
               //return $name = $menuItems->SetTrans('name','en',true);

               // $menuItems = [];



             }

        }
      }else{
        //return 2;
        $selectedMenu = '';
        $menuItems = [];
      }
      $pages = Post::where('post_type','page')->get();
      $menus = Menu::get();
      $lang  = Language::get();
      return view('admin.menus.index',compact('pages','menus','selectedMenu','menuItems','lang'));
    }

    public function menu_create()
    {


      return view('backend.menu_create');

    }
    // public function page_store(Request $request)
    // {
    //   //return $request;
    //   $page = new Pages();
    //   $page->title = $request->title;
    //   $page->slug = Str::slug($request->title);
    //   $page->save();
    //   return redirect()->route('menu.index');
    // }

    public function menu_store(Request $request)
    {
      $data = $request->all();

        $menu = Menu::create($data);
        $menu = Menu::latest()->take(1)->first();
        return redirect()->route('menu.index',["$menu->id"]);

    }

    public function addPageToMenu(Request $request)
    {
     
    // dd($request->all());
      $menu_id = $request->menu_id;
      $ids = $request->ids;
      $menu = Menu::find($menu_id);
      
      if($menu->content == '' || $menu->content == '[[]]' )
      {
        
        //return  $menu->content;
        foreach ($ids as $key => $id) {

          $page =  Post::find($id);
         
          $page_or = $page->getTranslation('post_title','or');
          $page_en = $page->getTranslation('post_title','en');
          $translations_title = ['en' => $page_en, 'or' => $page_or,];
          $menuItem = new MenuItem();
          $menuItem->setTitleAttribute($translations_title);
          // $menuItem->title = $translations_title;
          $menuItem->slug = Post::where('id',$id)->value('post_slug');
          $menuItem->type = 'page';
          $menuItem->menu_id = $menu_id;
          // $data['title'] = Pages::where('id',$id)->value('title');
          // $data['slug'] = Pages::where('id',$id)->value('slug');
          // $data['type'] = 'page';
          // $data['menu_id'] = $menu_id;
          // MenuItem::create($data);
          $menuItem->save();
          //return 'save';
        }
      }else{
        // return 22;
       // return  $menu->content;
       // $menudata = json_decode($menu->content);
        //return  $menudata[0];
        //return $request;
        foreach ($ids as $key => $id) {

          $menudata = json_decode($menu->content);
          //return $menudata[0];

          //$tran_menu_title = ['en' => Post::where('id',$id)->value('post_title');, 'or' => $request->or_title,];
          //$translations_title =

          $page =  Post::find($id);
          
          $page_or = $page->getTranslation('post_title','or');
          $page_en = $page->getTranslation('post_title','en');
          $translations_title = ['en' => $page_en, 'or' => $page_or,];
          
          $menuItem = new MenuItem();
          $menuItem->setTitleAttribute($translations_title);
          // $menuItem->title = $translations_title;

          $menuItem->slug = Post::where('id',$id)->value('post_slug');
          $menuItem->type = 'page';
          $menuItem->menu_id = $menu_id;

          // $data['title'] = Pages::where('id',$id)->value('title');
          // $data['slug'] = Pages::where('id',$id)->value('slug');
          // $data['type'] = 'page';
          // $data['menu_id'] = $menu_id;
          // MenuItem::create($data);

          $menuItem->save();

          //$lastdata = MenuItem::latest()->first(['id']);
          $lastdata = DB::table('menu_items')->orderBy('id','desc')->first();
          $newdata = [];
          $newdata['id'] = $lastdata->id;
          $newdata['children'] = [[]];
          //return $menudata[0];
          //return $newdata;
          array_push($menudata[0],$newdata);
          $menudata = json_encode($menudata);
          $idd[] = $menudata;

          $menu_id = $request->menu_id;
          $menu = Menu::find($menu_id);

          $menu->update(['content'=> $menudata]);



        }

      }

     // return $idd;
    }

    public function add_custom_link(Request $request)
    {
      //return $request;
      $menu_id = $request->menu_id;
      $ids = $request->ids;
      $menu = Menu::find($menu_id);
      if($menu->content == '' || $menu->content == '[[]]' )
      {
       // return 1;

          $menuItem = new MenuItem();
          $translations_title = ['en' => $request->link_txt, 'or' => $request->link_txt,];
          $menuItem->setTitleAttribute($translations_title);
          //$menuItem->title = $request->link_txt;
          $menuItem->slug = $request->link_url;
          $menuItem->type = 'custom';
          $menuItem->menu_id = $menu_id;
          // $data['title'] = Pages::where('id',$id)->value('title');
          // $data['slug'] = Pages::where('id',$id)->value('slug');
          // $data['type'] = 'page';
          // $data['menu_id'] = $menu_id;
          // MenuItem::create($data);
          $menuItem->save();

      }else{

          $menudata = json_decode($menu->content);

          $menuItem = new MenuItem();
          $menuItem->title = $request->link_txt;
          $menuItem->slug = $request->link_url;
          $menuItem->type = 'custom';
          $menuItem->menu_id = $menu_id;
          // $data['title'] = Pages::where('id',$id)->value('title');
          // $data['slug'] = Pages::where('id',$id)->value('slug');
          // $data['type'] = 'page';
          // $data['menu_id'] = $menu_id;
          // MenuItem::create($data);
          $menuItem->save();

          $lastdata = MenuItem::latest()->first(['id']);
          $newdata = [];
          $newdata['id'] = $lastdata->id;
          $newdata['children'] = [[]];
          array_push($menudata[0],$newdata);

          $menudata = json_encode($menudata);

          $menu->update(['content'=> $menudata]);




      }
      return redirect()->back();
    }

    public function save_menu(Request $request)
    {
        //return $request;
       // $data = $request->except('_token');

        $menu_id = $request->menu_id;
        $new_content = $request->new_content;

        //Menu::create($data);

         $menu = Menu::find($menu_id);
         //return $menu->content;
         $content = $menu->content;
         $location = $menu->location;
         if(!empty($request->new_content)){
          $content = $request->new_content;
         }else{
          $content = $content;
         }

         if(!empty($request->location)){
          $location = $request->location;
         }else{
          $location = $location;
         }

        // return $content . $location;

         $menu->content = $content;
         $menu->location = $location;
         $menu->save();
        return redirect()->back();
    }

    public function update_menu(Request $request,$lang,$id){
      // return $request;
     // $data = $request->except('_token');




     $item = Menuitem::findOrFail($id);


    $item->setTranslation('name', $lang, str_replace('"', '', json_encode($request->link_txt, JSON_UNESCAPED_UNICODE)));
    $item->slug=$request->en_link_url;
      $item->save();
      //$item->update($data);
      return redirect()->back();
    }




    public function deleteMenuItem($id,$key,$in,$gkey){
      //return $key;
      //return $nav;
      //return $in;
      //return $gkey;
      $menuitem = Menuitem::findOrFail($id);
       $menu = Menu::where('id',$menuitem->menu_id)->first();
      if($menu->content != ''){
        //return 1;
         $data = json_decode($menu->content,true);
         //return $data;
         $maindata = $data[0];
         //return $maindata[5];
         if($gkey == 'null' && $in == 'null'){
           // return $key;
          //return $data[0];
          //return $data[0][5];
          unset($data[0][$key]);
        //return $data;
         $updatedData = [];
         foreach ($data as $key => $value) {
           foreach ($value as $key => $val) {
            $updatedData[] = $val;
           }
           $updatedDataNew[] = $updatedData;

        }
       // return $updatedData;
        //return $updatedDataNew;
          $newdata = json_encode($updatedDataNew);

          //  return $newdata = [$newdata];


          if ($newdata == '[[]]'){
            $menu->update(['content'=>'']);
          }else{
            $menu->update(['content'=>$newdata]);
          }
        }else if($gkey == 'null'){
          unset($data[0][$key]['children'][0][$in]);
          $newdata = json_encode($data);
          if ($newdata == '[[]]'){
            $menu->update(['content'=>'']);
          }else{
            $menu->update(['content'=>$newdata]);
          }


        } else if($in == 'null'){

          unset($data[0][$key]);
          $newdata = json_encode($data);
          if ($newdata == '[[]]'){
            $menu->update(['content'=>'']);
          }else{
            $menu->update(['content'=>$newdata]);
          }


        }else{

          unset($data[0][$key]['children'][0][$in]['children'][0][$gkey]);
          $newdata = json_encode($data);
          if ($newdata == '[[]]'){
            $menu->update(['content'=>'']);
          }else{
            $menu->update(['content'=>$newdata]);
          }

        }
      }
      //$menuitem->delete();
      //return $data;
      //return redirect()->back();
      return redirect()->route('menu.index');
    }

    public function deleteMenu(Request $request, $id){
        //return $id;
      MenuItem::where('menu_id',$request->id)->delete();
      Menu::findOrFail($request->id)->delete();
      return redirect()->route('menu.index');
    }


    public function frontmenu()
    {
       $menu = Menu::where('location','mian_menu')->value('content');

       $menu = json_decode( $menu);
       $menu = $menu[0];
       foreach ($menu as $key => $parent) {
          $parent->title = MenuItem::where('id',$parent->id)->value('title');
          $parent->slug = MenuItem::where('id',$parent->id)->value('slug');
          if(!empty($parent->children[0]))
          {
            foreach ($parent->children[0] as $key2 => $child) {
              $child->title = MenuItem::where('id',$child->id)->value('title');
              $child->slug = MenuItem::where('id',$child->id)->value('slug');
            }

          }
          if(!empty($child->children[0]))
          {
            foreach ($child->children[0] as $key3 => $grandchild) {
              $grandchild->title = MenuItem::where('id',$grandchild->id)->value('title');
              $grandchild->slug = MenuItem::where('id',$grandchild->id)->value('slug');
            }
          }
       }
      // return $menu;
      return view('menu.frontend.index',compact('menu'));
    }


}
