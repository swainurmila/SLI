<?php

namespace App\Http\Controllers\Website;

use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LanguageController extends Controller
{
    public function index()
    {
        
        $lang = Language::get();
        return  view('admin.language.index',compact('lang'));
    }

    public function store(Request $request)
    {
        // return $request;
        if ($request->hasFile('flag')) {
            //return 1;
            $iconPath = $request->file('flag');
            $iconName = time() . '.' . $iconPath->getClientOriginalExtension();
            $path = $request->file('flag')->move('lang/', $iconName);
            $img_path = 'lang/' . $iconName;
        } else {
            $iconName = "";
           // return 2;
        }

        $data = [
            'lang_name' => $request->lang_name,
            'lang_short_name' => $request->lang_short_name,
            'lang_flag' => $img_path,
        ];

        Language::create($data);
        return redirect()->route('lang.index');
    }

    public function edit($id){
        $lang = Language::find($id);
        return  view('admin.language.edit',compact('lang','id'));
    }

    public function update(Request $request,$id){
        // return $request;
        $language = Language::find($id);


        if ($request->hasFile('flag')) {
            //return 1;
            $iconPath = $request->file('flag');
            $iconName = time() . '.' . $iconPath->getClientOriginalExtension();
            $path = $request->file('flag')->move('lang/', $iconName);
            $img_path = 'lang/' . $iconName;

            $language->lang_flag = $img_path;
        } else {
            $iconName = "";
           // return 2;
        }

        
        $language->lang_name = $request->lang_name;
        $language->lang_short_name = $request->lang_short_name;
        
        $language->save();
        return redirect()->route('lang.index');
    }


    public function delete($id){
        $language = Language::find($id);
        $language->delete();
        return redirect()->route('lang.index');

    }

}
