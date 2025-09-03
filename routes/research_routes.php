<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Research\AuthController;
use App\Http\Controllers\Research\DashboardController;
use App\Http\Controllers\Research\NotificationController;
use App\Http\Controllers\Research\ResearchUserController;
use App\Http\Controllers\Research\PaperController;
use App\Http\Controllers\Research\SubmittedPaperController;
use App\Http\Controllers\Research\CertificateController;
use App\Http\Controllers\Research\ResearchCategoryController;
use App\Http\Controllers\Research\ResearchRoleController;









/*
|--------------------------------------------------------------------------
| Research Publication Routes
|--------------------------------------------------------------------------
|
| Here is where you can register Research Publication routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "Research Publication" middleware group. Now create something great!
|
*/






Route::prefix('research')->group(function () {


    Route::get('login',[AuthController::class,'showLogin'])->name('research.login.show');
    Route::post('login',[AuthController::class,'attemptLogin'])->name('research.login.check');

    Route::get('register',[AuthController::class,'showRegister'])->name('research.register.create');
    Route::post('register',[AuthController::class,'storeRegister'])->name('research.register.store');

    Route::post('case-studies/register',[AuthController::class,'storeRegister'])->name('research.case-studies.register.store');




    Route::post('logout',[AuthController::class,'researchLogout'])->name('admin.research.logout');

    Route::group(['middleware' => ['auth']], function () {
        Route::get('dashboard',[DashboardController::class,'dashboard'])->name('research.admin.dashboard');
        Route::get('view-profile',[DashboardController::class,'viewProfile'])->name('research.admin.view.profile');
        Route::patch('view-profile',[DashboardController::class,'updateProfile'])->name('research.admin.update.profile');

        Route::group(['middleware' => ['auth','role:Research Admin']], function () {

            Route::resource('user', ResearchUserController::class)->names([
                'index' => 'research.user.index',
                'store' => 'research.user.store',
                'update' => 'research.user.update',
            ]);

            Route::resource('notification', NotificationController::class)->names([
                'index' => 'research.notification.index',
                'store' => 'research.notification.store',
                'update' => 'research.notification.update',
                'destroy' => 'research.notification.destroy'
            ]);

            Route::resource('submitted-papers', SubmittedPaperController::class)->names([
                'index' => 'research.admin.submitted-papers.index',
                'create'=> 'research.admin.submitted-papers.create',
                'update' => 'research.admin.submitted-papers.update',
            ]);


            Route::resource('role', ResearchRoleController::class)->names([
                'index' => 'research.admin.role.index',
                'create'=> 'research.admin.role.create',
                'edit'=> 'research.admin.role.edit',
                'store'=> 'research.admin.role.store',
                'update' => 'research.admin.role.update',
            ]);

            Route::get('download-paper/{id}',[SubmittedPaperController::class,'downloadPapers'])->name('research.admin.download-paper');

            Route::get('certificate',[CertificateController::class,'index'])->name('research.admin.certificate.index');
            Route::post('certificate',[CertificateController::class,'assignCertificate'])->name('research.admin.certificate.assign');

            Route::get('/cat-sub-master', [ResearchCategoryController ::class, 'CatagySubject'])->name('cat-sub-master');
            Route::post('/check-category-name', [ResearchCategoryController ::class, 'checkCategoryName'])->name('check-category-name');
            Route::post('/add-cat-sub', [ResearchCategoryController::class, 'categorysubjectAdd'])->name('add-cat-sub');
            Route::post('/update-cat-sub/{id}', [ResearchCategoryController::class, 'categorysubjectUpdate'])->name('update-cat-sub');
            Route::post('/delete-cat-sub/{id}', [ResearchCategoryController::class, 'categorysubjectDelete'])->name('delete-cat-sub');

        });

        Route::group(['middleware' => ['auth','role:Research User']], function () {

            Route::resource('papers', PaperController::class)->names([
                'index' => 'research.admin.paper.index',
                'create'=> 'research.admin.paper.create',
                'store' => 'research.admin.paper.store',
                'update' => 'research.admin.paper.update',
                'destroy' => 'research.admin.paper.destroy'
            ]);

            Route::get('certificate-download/{id}',[CertificateController::class,'downloadCertificate'])->name('research.admin.certificate.download');


        });
    });

});

