<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\GoogleMeetController;
use App\Http\Controllers\LibraryUserController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Training\Admin\DashboardController;

// use App\Models\Training\TrCategoryEnrollment;
use App\Models\Training\TrTraining;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Website\WebhomeController;

use App\Http\Controllers\BaseController;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {

//     // $trainingEnrollmentsDates = TrCategoryEnrollment::where('enrollment_end_date','>',Carbon\Carbon::today())->get();
//     $trainings = TrTraining::where('enroll_end_date','>',Carbon\Carbon::today())->where('enroll_start_date','<',Carbon\Carbon::today())->orderBy('id','desc')->get();

//     // $courses = CrNotification::with('Course')->where('end_date','>',Carbon\Carbon::today())->get();


//     return view('welcome',compact('trainings'));
// });

include('website_routes.php');



Route::get('/get_city', [RegisterController::class, 'getCity'])->name('get_city');




Route::prefix('portal')->group(function () {
    // Auth::routes();


include('library_routes.php');
include('training_routes.php');
include('course_routes.php');
include('e_office_routes.php');
include('research_routes.php');
include('finance_routes.php');
include('common.php');
include('workshop_routes.php');
Route::get('role-error', [DashboardController::class, 'roleError'])->name('role.error');

// include('training.php');

Route::get('/ifms_test', [BookController::class, 'ifmstest'])->name('ifmstest');
Route::get('/refresh-csrf', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});
Route::prefix('admin')->group(function () {
    Route::get('reload-captcha', [BaseController::class, 'reloadCaptcha'])->name('reload-captcha');

    Route::group(['middleware' => ['auth']], function () {

        Route::get('/home', [HomeController::class, 'index'])->name('admin.home');
        Route::get('/user-dashboard', [HomeController::class, 'userDashboard'])->name('user-dashboard');

        Route::resource('role', RoleController::class)->names([
            'index' => 'role.index',
            'show' => 'role.show',
            'create' => 'role.create',
        ]);

        Route::resource('users', UserController::class)->names([
            'index'=>'users.index',
        ]);
        Route::get('library-profile',[UserController::class,'viewProfile'])->name('view-profile');
        Route::patch('library-profile',[UserController::class,'updateUserProfile'])->name('view-profile.update');
        // Route::post('/user/change-password', [UserController::class, 'changePassword'])->name('user.change_password');


        //Language Master
        Route::get('/language-master', [HomeController::class, 'languageMaster'])->name('language-master');
        Route::post('/add-language', [HomeController::class, 'languageAdd'])->name('add-language');
        Route::post('/update-language/{id}', [HomeController::class, 'languageUpdate'])->name('update-language');
        Route::post('/delete-language/{id}', [HomeController::class, 'languageDelete'])->name('delete-language');
        //Category Master
        Route::get('/category-master', [HomeController::class, 'categoryMaster'])->name('category-master');
        Route::post('/add-category', [HomeController::class, 'categoryAdd'])->name('add-category');
        Route::post('/update-category/{id}', [HomeController::class, 'categoryUpdate'])->name('update-category');
        Route::post('/delete-category/{id}', [HomeController::class, 'categoryDelete'])->name('delete-category');
        // Route::post('/check-category-name', [HomeController::class, 'checkCategoryName'])->name('check-category-name');

        //Department Master
        Route::get('/department-master', [HomeController::class, 'departmentMaster'])->name('department-master');
        //Advertisement Master
        Route::get('/advertisement-master', [HomeController::class, 'advertisementMaster'])->name('advertisement-master');
        Route::post('/add-advertisement', [HomeController::class, 'AdvertisementAdd'])->name('add-advertisement');
        Route::post('/update-advertisement/{id}', [HomeController::class, 'advertisementUpdate'])->name('update-advertisement');
        Route::post('/delete-advertisement/{id}', [HomeController::class, 'advertisementDelete'])->name('delete-advertisement');


        Route::get('/generateBarcode', [LibraryUserController::class, 'generateBarcode'])->name('book.generateBarcode');


        Route::prefix('books')->group(function () {

            Route::get('/', [BookController::class, 'index'])->name('book.index');

            Route::get('/book-add', [BookController::class, 'add'])->name('book.add');
            Route::post('/book-add', [BookController::class, 'store'])->name('book.store');
            // Route::get('/book-add', [BookController::class, 'add'])->name('book.add');


            Route::post('/upload-images', [BookController::class, 'uploadLibraryImage'])->name('uploadLibraryImage');


            Route::post('/book_reg_check', [BookController::class, 'bookRegCheck'])->name('book.bookRegCheck');

            Route::post('/book-edit/{id}', [BookController::class, 'edit'])->name('book.edit');

            Route::post('/book-editlocation/{id}', [BookController::class, 'editlocation'])->name('book.editlocation');


            Route::get('/issue-request/{id?}', [BookController::class, 'bookIssueRequest'])->name('book.bookIssueRequest');

        Route::get('/return-request', [BookController::class, 'bookReturnRequest'])->name('book.bookReturnRequest');
        Route::get('/reject-list', [BookController::class, 'rejectList'])->name('book.rejectList');

            Route::post('/Issue-return-request', [BookController::class, 'IssueBookReturnRequest'])->name('book.IssueBookReturnRequest');


            Route::post('/Issue-book', [BookController::class, 'issueBook'])->name('book.issueBook');

            Route::post('/reject-book', [BookController::class, 'rejectBook'])->name('book.rejectBook');
            Route::post('/admin-book-return-request', [BookController::class, 'adminBookReturnRequest'])->name('book.adminBookReturnRequest');
            Route::get('/master-setting', [BookController::class, 'mastersetting'])->name('book.mastersetting');
            Route::post('/master-setting', [BookController::class, 'mastersettingsave'])->name('book.mastersettingsave');
            Route::get('/usersearch', [BookController::class, 'usersearch'])->name('book.usersearch');
            Route::post('/usersearch', [BookController::class, 'usersearch'])->name('book.usersearch');
            Route::get('/view-book-details/{id?}', [BookController::class, 'bookDetails'])->name('book.view-book-details');
            Route::post('/add-newbook', [BookController::class, 'BookaddLocation'])->name('add-newbook');
            Route::post('/check-reg', [BookController::class, 'checkreg'])->name('check-reg');


        });
        Route::prefix('library')->group(function () {
            Route::get('/book/{id?}', [LibraryUserController::class, 'index'])->name('library.index');
            Route::post('/book', [LibraryUserController::class, 'indexsearch'])->name('library.indexsearch');
            Route::post('/request-book', [LibraryUserController::class, 'bookRequest'])->name('library.bookRequest');
            Route::post('/request-return-book', [LibraryUserController::class, 'returnbookRequest'])->name('library.returnbookRequest');
            Route::get('/book-list', [LibraryUserController::class, 'userBookList'])->name('library.userBookList');
            Route::get('/library-card', [LibraryUserController::class, 'libraryCard'])->name('library.library-card');

            Route::get('/library-card-download', [LibraryUserController::class, 'libraryCarddownload'])->name('library.library-carddownload');

            Route::get('/book-request-preview/{id?}', [LibraryUserController::class, 'bookRequestPreview'])->name('library.bookRequestPreview');

            Route::get('/book-user-preview/{id?}', [LibraryUserController::class, 'bookUserPreview'])->name('library.bookUserPreview');

            Route::get('/profile', [LibraryUserController::class, 'profile'])->name('library.user.profile');

        });
        Route::prefix('user')->group(function () {
            //reset password
            Route::post('/change_password', [UserController::class, 'changePassword'])->name('user.change_password');
            //user profile
            Route::get('/user-profile', [UserController::class, 'userProfile'])->name('user.user-profile');
            Route::post('/update-user-profile', [UserController::class, 'updateProfile'])->name('update-user-profile');

            // Route::get('/approve-user', [UserController::class, 'approveUser'])->name('user.approve-user');
            Route::post('/update-user-details/{id}', [UserController::class, 'updateUserDetails'])->name('user.update-user-details');
            Route::post('/get_city', [UserController::class, 'getCity'])->name('user.get_city');
            Route::post('/add-user-details', [UserController::class, 'addUserDetails'])->name('user.add-user-details');

        });



    });
    Route::prefix('library')->group(function () {
        Route::get('/book/{id?}', [LibraryUserController::class, 'index'])->name('library.index');
        Route::post('/book', [LibraryUserController::class, 'indexsearch'])->name('library.indexsearch');
        Route::post('/request-book', [LibraryUserController::class, 'bookRequest'])->name('library.bookRequest');
        Route::post('/request-return-book', [LibraryUserController::class, 'returnbookRequest'])->name('library.returnbookRequest');
        //Pay fine and return book
        Route::post('/fine-payment', [LibraryUserController::class, 'payFine'])->name('library.fine-payment');
        Route::get('/book-list', [LibraryUserController::class, 'userBookList'])->name('library.userBookList');
        Route::get('/library-card', [LibraryUserController::class, 'libraryCard'])->name('library.library-card');

        Route::get('/library-card-download', [LibraryUserController::class, 'libraryCarddownload'])->name('library.library-carddownload');

        Route::get('/book-request-preview/{id?}', [LibraryUserController::class, 'bookRequestPreview'])->name('library.bookRequestPreview');

        Route::get('/book-user-preview/{id?}', [LibraryUserController::class, 'bookUserPreview'])->name('library.bookUserPreview');

        Route::get('/profile', [LibraryUserController::class, 'profile'])->name('library.user.profile');

    });
    Route::prefix('user')->group(function () {
        //reset password
        Route::post('/change_password', [UserController::class, 'changePassword'])->name('user.change_password');
        //user profile
        Route::get('/user-profile', [UserController::class, 'userProfile'])->name('user.user-profile');
        Route::post('/update-user-profile', [UserController::class, 'updateProfile'])->name('update-user-profile');

        // Route::get('/approve-user', [UserController::class, 'approveUser'])->name('user.approve-user');
        Route::post('/update-user-details/{id}', [UserController::class, 'updateUserDetails'])->name('user.update-user-details');
        Route::post('/get_city', [UserController::class, 'getCity'])->name('user.get_city');
        Route::post('/add-user-details', [UserController::class, 'addUserDetails'])->name('user.add-user-details');

    });



});
});


// ======= Websites Routes ==============

Route::get('/{lang?}',[WebhomeController::class,'web_index'])->name('web.index');
Route::get('/{lang}/{slug}',[WebhomeController::class,'page_view'])->name('web.inner');
Route::get('/{lang}/{postId}/{postType}/{post}',[WebhomeController::class,'post_view'])->name('post.view');
