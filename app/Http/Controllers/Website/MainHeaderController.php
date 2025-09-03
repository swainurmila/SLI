<?php
namespace App\Http\Controllers\Website;
use App\Models\Website\MainHeader;
use App\Models\Language;
use App\Models\Website\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
class MainHeaderController extends Controller
{
    public function index(Request $request, $postTypeName,$id)
    {
        $postType = MainHeader::all();
        $routeName = $postTypeName;
        //return view('admin.post_types.mainheader.index',compact('postType','routeName'));
        return view('admin.post_types.postType',compact('postType','routeName','id'));
    }
    public function create($postTypeName,$id)
    {
        //return 1;
        $lang = Language::all();
        $routeName = $postTypeName;
        return view('admin.post_types.mainheader.addPage',compact('lang','routeName','id'));
    }
    public function store(Request $request)
    {
        $userId = Auth::id();
        $currentDateTime = Carbon::now();
        $translations_title = ['en' => $request->en_title, 'or' => $request->or_title];
        $translations_content = ['en' => $request->en_content, 'or' => $request->or_content];
        $translations_excerpt = ['en' => $request->en_excerpt, 'or' => $request->or_excerpt];
        $PostType = new MainHeader();
        $PostType->setPostTypeTitleAttribute($translations_title);
        $PostType->setPostTypeContentAttribute($translations_content);
        $PostType->setPostTypeExcerptAttribute($translations_excerpt);
        $PostType->post_id = $request->post_id;
        $PostType->date = $currentDateTime;
        $PostType->author = $userId;
        $PostType->attachment_img = $request->post_attachment;
        $PostType->attachment_file = $request->post_attachment2;
        $PostType->custom_link = $request->custom_link;
        $PostType->show_new_icon = $request->show_icon == '' ? 0 : '1';
        $PostType->save();
        return redirect()->route('mainheader.index',[$request->post_type,$request->post_id]);
    }
    public function edit(Request $request,$postTypeName,$id)
    {
        $lang = Language::all();
        $postType = MainHeader::find($id);

        return view("admin.post_types.mainheader.edit",compact('lang','postType','id','postTypeName'));
    }
    public function update(Request $request,$postTypeName,$id)
    {
        // print_r($request->all());die();
        $PostType = MainHeader::find($id);
        $translations_title = ['en' => $request->en_title, 'or' => $request->or_title];
        $translations_content = ['en' => $request->en_content, 'or' => $request->or_content];
        $translations_excerpt = ['en' => $request->en_excerpt, 'or' => $request->or_excerpt];
        $PostType->setPostTypeTitleAttribute($translations_title);
        $PostType->setPostTypeContentAttribute($translations_content);
        $PostType->setPostTypeExcerptAttribute($translations_excerpt);
        $PostType->attachment_img = $request->post_attachment;
        $PostType->attachment_file = $request->post_attachment2;
        $PostType->custom_link = $request->custom_link;
        $PostType->show_new_icon = $request->show_icon == '' ? 0 : '1';
        $PostType->save();
        return redirect()->back();
    }
    public function delete(Request $request, $postTypeName,$id)
    {
        $postType = MainHeader::find($id);
        $postId = Post::where('post_slug',$postTypeName)->value('id');
        $postType->delete();
        return redirect()->route("$postTypeName.index",[$postTypeName,$postId]);
    }
}
