<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Language;
use App\Models\CategoryMaster;
use App\Models\DepartmentsMaster;
use App\Models\Advertisement;
use App\Models\User;

use App\Models\BookRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // $user = Auth::user();

        // $user->assignRole('Library Admin');

        if(Auth::user()->role == 'User' && Auth::user()->is_library == '1'){
            $book_list = BookRequest::whereIn('issue_status', [0, 1,3,4])->orderBy('id', 'desc')->where('user_id',Auth::user()->id)->get();
            return view('user_dashboard',compact('book_list'));
        }

        return view('home');
    }
    public function userDashboard()
    {
        return view('user_dashboard');
    }
    //Language Master
    public function languageMaster(){
        $lang = Language::where('is_delete', 0)->get();
         return view("admin.languages.index", compact('lang'));
    }
    public function languageAdd(Request $request){
        //return $request;
        $add_lang = new Language();
        $add_lang->name = $request->lang_name;
        $add_lang->status = 1;
        $add_lang->save();
        return redirect()->route('language-master')
        ->with('success', 'Language Added Successfully');
    }
    public function languageUpdate(Request $request, $id){
        //return $request;
        $update_lang = Language::where('id', $id)->update([
            'name' => $request->lang_name,
        ]);
        return redirect()->route('language-master')
        ->with('success', 'Language Updated Successfully');
    }
    public function languageDelete($id){
        //return $id;
        $update_lang = Language::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('language-master')
        ->with('success', 'Language Updated Successfully');
    }
    //end of language Master
    //Category Master
    public function categoryMaster(){
        $lang = CategoryMaster::where('is_delete', 0)->get();
         return view("admin.category.index", compact('lang'));
    }
    public function categoryAdd(Request $request){
        //return $request;
        //return Auth::user()->id;
        $request->validate([
            'name' => 'required|string|max:255|unique:category_masters,name',
            'description' => 'nullable|string|max:500',
        ]);
        $add_lang = new CategoryMaster();
        $add_lang->name = $request->name;
        $add_lang->description = $request->description;
        $add_lang->user_id = Auth::user()->id;
        $add_lang->status = 1;
        $add_lang->save();
        return redirect()->route('category-master')
        ->with('success', ' Category Added Successfully');
    }
    public function categoryUpdate(Request $request, $id){
        // return $request;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
        ]);
        //  return $request;

        $update_lang = CategoryMaster::where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('category-master')
        ->with('success', 'catagory Updated Successfully');
    }
    public function categoryDelete($id){
        //return $id;
        $update_lang = CategoryMaster::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('category-master')
        ->with('success', 'Deleted Successfully');
    }

    // public function departmentMaster(){
    //     $dept = DepartmentsMaster::where('is_delete', 0)->get();
    //      return view("admin.department.index", compact('dept'));
    // }

    public function advertisementMaster(){
         $advt = Advertisement::where('is_delete', 0)->get();
         return view("admin.advertisement.index" , compact('advt'));
    }

    public function AdvertisementAdd(Request $request){
        $advt = new Advertisement();
        $advt->title = $request->title;
        $advt->from_date = $request->from_date;
        $advt->to_date = $request->to_date;
        $advt->details = $request->details;
        $advt->save();
        return redirect()->route('advertisement-master')
        ->with('success', 'Advertisement Added Successfully');

    }

    public function advertisementUpdate(Request $request, $id){
        //return $request;
        $update_advt = Advertisement::where('id', $id)->update([
            'from_date' => $request->from_date,
            'to_date' => $request-> to_date,
        ]);
        return redirect()->route('advertisement-master')
        ->with('success', 'Rescheduled Successfully');
    }

    public function advertisementDelete($id){
        //return $id;
        $update_advt = Advertisement::where('id', $id)->update([
            'is_delete' => 1,
        ]);
        return redirect()->route('advertisement-master')
        ->with('success', 'Advertisement Deleted Successfully');
    }

}
