<?php
use Illuminate\Support\Facades\Route;

// Website Controllers


use App\Http\Controllers\Website\DemoController;
use App\Http\Controllers\Website\GalleryController;
use App\Http\Controllers\Website\BlogTestingController;
use App\Http\Controllers\Website\TestingBlog1Controller;
use App\Http\Controllers\Website\DarpanSishuController;
use App\Http\Controllers\Website\Soumya_sahooController;
use App\Http\Controllers\Website\Sandeep_dasController;
use App\Http\Controllers\Website\SandeepdasController;
use App\Http\Controllers\Website\SandeedasController;
use App\Http\Controllers\Website\SoumyaSamantaController;
use App\Http\Controllers\Website\SishuSampadController;
use App\Http\Controllers\Website\ShramaDarpanController;
use App\Http\Controllers\Website\PrabasiShramikaController;
use App\Http\Controllers\Website\PublicationController;
use App\Http\Controllers\Website\MainHeaderController;
use App\Http\Controllers\Website\SCHEMESANDSERVICESController;
use App\Http\Controllers\Website\ResearchController;
use App\Http\Controllers\Website\PartnersController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\AboutUsController;
use App\Http\Controllers\Website\QuickLinksController;
use App\Http\Controllers\Website\ProjectsController;
use App\Http\Controllers\Website\LatestNewsController;
use App\Http\Controllers\Website\TenderController;
use App\Http\Controllers\Website\TeamMemberController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\LanguageController;
use App\Http\Controllers\Website\MenuController;
use App\Http\Controllers\Website\PageController;
use App\Http\Controllers\Website\PostTypeController;
use App\Http\Controllers\Website\RoleController;
use App\Http\Controllers\Website\SliderController;
use App\Http\Controllers\Website\TemplateController;
use App\Http\Controllers\Website\UserController;
use App\Http\Controllers\Website\WebhomeController;
use App\Http\Controllers\Website\FooterController;
use App\Http\Controllers\Website\HeaderController;
use Illuminate\Support\Facades\Auth;
use App\Traits\PostTrait;
use Illuminate\Support\Facades\DB;

//End Website Controllers






Route::get('/cda/public/login', function () {
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('home');

    Route::post('logg', [DemoController::class, 'logg'])->name('logg');

    // Route::get('/login', [CustomLoginController::class, 'showLoginForm'])->name('login');
    // Route::post('/login', [CustomLoginController::class, 'login']);

    Route::get('all-users',[UserController::class,'index'])->name('user.index');
    Route::get('edit-user/{id}',[UserController::class,'edit_user'])->name('user.edit');
    Route::post('update-user/{id}',[UserController::class,'update_user'])->name('user.update');
    Route::get('create-user',[UserController::class,'create_user'])->name('user.create');
    Route::get('store-user',[UserController::class,'store_user'])->name('user.store');
    Route::get('delete-user/{id}',[UserController::class,'delete_user'])->name('user.delete');


    Route::get('list-role',[RoleController::class,'index'])->name('role.index');
    Route::get('edit-role/{id}',[RoleController::class,'edit_role'])->name('role.edit');
    Route::get('update-role/{id}',[RoleController::class,'update_role'])->name('role.update');
    Route::get('create-role',[RoleController::class,'create_role'])->name('role.create');
    Route::get('store-role',[RoleController::class,'store_role'])->name('role.store');
    Route::get('delete-role/{id}',[RoleController::class,'delete_role'])->name('role.delete');
    Route::get('quick-links',[FooterController::class,'quick_links'])->name('quick_links');
    Route::get('footer',[FooterController::class,'index'])->name('footer');
    Route::get('header',[HeaderController::class,'index'])->name('header');
    // menu routes =============


    Route::get('menu/{id?}',[MenuController::class,'menu_index'])->name('menu.index');
    Route::get('add-pages-to-menu',[MenuController::class,'addPageToMenu'])->name('addPageToMenu');
    Route::post('save-menu',[MenuController::class,'save_menu'])->name('save_menu');
    Route::post('create-menu',[MenuController::class,'menu_store'])->name('menu_store');
    Route::get('menu_create', [MenuController::class, 'menu_create'])->name('menu_create');
    Route::post('add-custom-link', [MenuController::class, 'add_custom_link'])->name('add_custom_link');
    Route::post('update-menu/{lang}/{id}', [MenuController::class, 'update_menu'])->name('update_menu');
    Route::get('delete-menuitem/{id}/{key}/{in}/{gkey}',[MenuController::class,'deleteMenuItem'])->name('deleteMenuItem');
    Route::get('delete-menu/{id}',[MenuController::class,'deleteMenu'])->name('deleteMenu');


    // ===== Pages Routes =========

    Route::get('add-page',[PageController::class,'add_page_index'])->name('page.add');
    Route::get('all-pages',[PageController::class,'all_pages'])->name('page.index');
    Route::post('page-store',[PageController::class,'page_store'])->name('page.store');
    Route::get('page-edit/{id}',[PageController::class,'page_edit'])->name('page.edit');
    Route::post('page-update/{id}',[PageController::class,'page_update'])->name('page.update');
    Route::get('page-delete/{id}',[PageController::class,'page_delete'])->name('page.delete');

    Route::get('page-templates',[TemplateController::class,'page_template'])->name('page.template');
    Route::get('page-templates-create',[TemplateController::class,'temp_create'])->name('temp_create');
    Route::get('page-templates-store',[TemplateController::class,'temp_store'])->name('temp_store');
    Route::get('page-templates-destroy/{id}',[TemplateController::class,'temp_destroy'])->name('temp_destroy');


    // language Routes

    //
    Route::get('language',[LanguageController::class,'index'])->name('lang.index');
    Route::get('language-edit/{id}',[LanguageController::class,'edit'])->name('lang.edit');
    Route::view('language-create', 'admin.language.create')->name('lang.create');
    Route::post('language-store',[LanguageController::class,'store'])->name('lang.store');
    Route::put('language-update/{id}',[LanguageController::class,'update'])->name('lang.update');
    Route::get('language-delete/{id}',[LanguageController::class,'delete'])->name('lang.delete');


    //slider Routes

    Route::get('all-slider',[SliderController::class,'index'])->name('slider.index');
    Route::get('create-slider',[SliderController::class,'create_slider'])->name('slider.create');
    Route::post('slider-store',[SliderController::class,'slider_store'])->name('slider.store');
    Route::get('slider-content/{id}',[SliderController::class,'slider_content'])->name('slider.content');
    Route::post('slider-content-store',[SliderController::class,'slider_content_store'])->name('slider.content.store');
    Route::get('slider-image-listing/{id}',[SliderController::class,'slider_image_listing'])->name('slider.image.listing');
    Route::get('slider-image-delete/{id}',[SliderController::class,'slider_image_delete'])->name('slider.image.delete');
    Route::get('slider-image-create',[SliderController::class,'slider_image_create'])->name('slider.image.create');
    Route::get('slider-image-edit/{id}',[SliderController::class,'slider_image_edit'])->name('slider.image.edit');
    Route::post('slider-image-update/{id}',[SliderController::class,'slider_image_update'])->name('slider.image.update');


    // Gallery Routes

    Route::get('all-gallery',[GalleryController::class, 'index'])->name('gallery.index');
    Route::get('create-gallery',[GalleryController::class, 'create_gallery'])->name('gallery.create');
    Route::post('gallery-store',[GalleryController::class, 'gallery_store'])->name('gallery.store');
    Route::get('gallery-image-listing/{id}',[GalleryController::class,'gallery_image_listing'])->name('gallery.image.listing');
    Route::get('gallery-content/{id}',[GalleryController::class,'gallery_content'])->name('gallery.content');
    Route::post('gallery-content-store',[GalleryController::class,'gallery_content_store'])->name('gallery.content.store');
    Route::get('gallery-image-edit/{id}',[GalleryController::class,'gallery_image_edit'])->name('gallery.image.edit');
    Route::post('gallery-image-update/{id}',[GalleryController::class,'gallery_image_update'])->name('gallery.image.update');
    Route::get('gallery-image-delete/{id}',[GalleryController::class,'gallery_image_delete'])->name('gallery.image.delete');


    // Post Routes

    Route::get('all-post-types',[PostTypeController::class, 'index'])->name('post.index');
    Route::get('create-post-types',[PostTypeController::class, 'create'])->name('post.create');
    Route::get('store-post-types',[PostTypeController::class, 'store'])->name('post.store');
    Route::get('delete-post-types/{id}',[PostTypeController::class, 'delete'])->name('post.delete');
    //Route::get('edit-post-types/{posttype}/{id}',[PostTypeController::class, 'postType_index'])->name('postType.store');




    //$databaseName = DB::connection()->getDatabaseName();
    //dd($databaseName);
    // $tablesCount = DB::select("SELECT COUNT(*) as count FROM information_schema.tables WHERE table_schema = DATABASE()");
    // //dd($tablesCount);
    // $count = $tablesCount[0]->count;

    // if ($count > 0) {
        //dd(17898);
        PostTrait::customRoutes();
    // }






    //soumyastartcode

    Route::get('/post-publication-listing/publication/details/data/{id}', [PostTypeController::class, 'post_details'])->name('post.details');
    Route::get('/postdeatils/createpostdetails/createpostdeta/createpost/create', [PostTypeController::class, 'postdetails_create'])->name('postdetails.create');
    Route::post('/postdeatils/store/createpostdeta/createpost/create', [PostTypeController::class, 'postdetails_store'])->name('postdetails.store');

    //soumyaendcode

});