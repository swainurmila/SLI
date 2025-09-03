<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\workshop\Admin\AuthController;
use App\Http\Controllers\workshop\Admin\Ws_HomeController;
use App\Http\Controllers\workshop\Admin\Ws_WorkshopController;
use App\Http\Controllers\workshop\Admin\Ws_WorkshopMaterialController;
use App\Http\Controllers\workshop\Admin\Ws_AttendanceController;
use App\Http\Controllers\workshop\User\Ws_UserHomeController;
use App\Http\Controllers\workshop\User\Ws_EnrollController;
use App\Http\Controllers\workshop\DashboardController;
use App\Http\Controllers\workshop\Ws_NotificationController;
use App\Http\Controllers\workshop\Workshop_UserController;
use App\Http\Controllers\workshop\Ws_certificateController;
use App\Http\Controllers\workshop\Ws_profileController;
use App\Http\Controllers\workshop\Ws_ReviewController;

Route::prefix('workshop')->group(function () {
    Route::get('login',[AuthController::class,'showLogin'])->name('workshop.login.show');
    Route::post('login',[AuthController::class,'attemptLogin'])->name('workshop.login.check');
    Route::get('register',[AuthController::class,'create'])->name('workshop.register.create');
    Route::post('register',[AuthController::class,'store'])->name('workshop.register.store');


    Route::group(['middleware' => ['auth','auth.workshop.isadmin', 'role:Workshop Admin']], function () {
        Route::get('dashboard',[Ws_HomeController::class,'index'])->name('workshop.admin.dashboard');
        Route::post('logout',[Ws_HomeController::class,'adminLogout'])->name('workshop.admin.logout');

       //Create Workshop Routes
       Route::get('workshop',[Ws_WorkshopController::class,'index'])->name('workshop.index');
       Route::get('workshop-create',[Ws_WorkshopController::class,'create'])->name('workshop.create');
       Route::post('workshop-store',[Ws_WorkshopController::class,'store'])->name('workshop.store');
       Route::get('workshop-edit/{id}',[Ws_WorkshopController::class,'edit'])->name('workshop.edit');
       Route::post('workshop-update/{id}',[Ws_WorkshopController::class,'update'])->name('workshop.update');
       Route::get('workshop-view/{id}',[Ws_WorkshopMaterialController::class,'workshopView'])->name('workshop-view');
       //End Workshop Routes



    Route::get('transaction-details-list',[Ws_WorkshopController::class,'transaction'])->name('workshop.transactiondetails');
    Route::get('enrolled-details-list',[Ws_WorkshopController::class,'enrolled'])->name('workshop.enrolledstudentdetails');
    Route::get('review/{id}/delete',[Ws_WorkshopMaterialController::class,'destroy'])->name('workshop.review.destroy');

       //Create schedule for workshop
       Route::get('workshop/{id}/add-schedule',[Ws_WorkshopMaterialController::class,'addSchedule'])->name('workshop.add-schedule');
       Route::get('edit-schedule', [Ws_WorkshopMaterialController::class, 'editSchedule'])->name('workshop.edit-schedule');
       Route::post('create-schedule',[Ws_WorkshopMaterialController::class,'createSchedeule'])->name('workshop.create-schedule');
       Route::post('edit-schedule',[Ws_WorkshopMaterialController::class,'updateSchedeule'])->name('workshop.update-schedule');
       //End Schedule
        //Attendance
        Route::get('workshop-attendance/{id}',[Ws_AttendanceController::class,'attendanceIndex'])->name('workshop.workshop-attendance');
        Route::post('workshop-class-attendance',[Ws_AttendanceController::class,'attendanceStore'])->name('workshop.store-attendance');
        Route::post('submit-regularization/{id}',[Ws_AttendanceController::class,'regularizationSubmit'])->name('workshop.submit-regularization');
        //End Attendance
       //Create Presentation for workshop
       Route::post('create-presentations',[Ws_WorkshopMaterialController::class,'createPresentations'])->name('workshop.create-presentations');
       Route::post('edit-presentations',[Ws_WorkshopMaterialController::class,'editPresentations'])->name('workshop.edit-presentations');
       //end presentation


       // Start profile routes
        Route::get('my-profile',[DashboardController::class,'viewProfile'])->name('admin.workshop.profile');
        Route::patch('update-profile',[DashboardController::class,'updateProfile'])->name('admin.workshop.profile.update');
        //end profile routes

        Route::post('userstore',[AuthController::class,'userstore'])->name('user.store-user');

        //Start Users Routes
        Route::post('userstore',[Workshop_UserController::class,'userstore'])->name('user.store-user');
        Route::get('users',[Workshop_UserController::class,'index'])->name('workshop.users');
        Route::get('users/{id}/edit',[Workshop_UserController::class,'edit'])->name('workshop.users.edit');
        // Route::get('users/edit/{id}/{status}',[Workshop_UserController::class,'updateStatus'])->name('workshop.users.status');
        Route::post('users-update/{id}/{status}',[Workshop_UserController::class,'update'])->name('workshop.users.update');
        //End Users Routes

        Route::post('/get-districts', 'Workshop_UserController@getDistricts')->name('user.get_city');



        //Start Workshop Notification

        Route::get('/workshop-notification',[Ws_NotificationController::class,'notificationIndex'])->name('workshop-notification-index');
        Route::post('/workshop-notification-store',[Ws_NotificationController::class,'notificationStore'])->name('workshop-notification-store');
        Route::post('/workshop-notification/{id}',[Ws_NotificationController::class,'notificationUpdate'])->name('workshop-notification-update');
        Route::delete('/workshop-notification/{id}/delete',[Ws_NotificationController::class,'notificationDestroy'])->name('workshop-delete-notification');

         //End Workshop Notification

        //  Route::get('certificate/choose',[CertificateController::class,'index'])->name('course.admin.certificate.list');
        //  Route::post('certificate/choose',[CertificateController::class,'assignCertificate'])->name('course.admin.certificate.assign');
        //Create Workshop Routes
        Route::get('workshop',[Ws_WorkshopController::class,'index'])->name('workshop.index');
        Route::get('workshop-create',[Ws_WorkshopController::class,'create'])->name('workshop.create');
        Route::post('workshop-store',[Ws_WorkshopController::class,'store'])->name('workshop.store');
        Route::get('workshop-edit/{id}',[Ws_WorkshopController::class,'edit'])->name('workshop.edit');
        Route::post('workshop-update/{id}',[Ws_WorkshopController::class,'update'])->name('workshop.update');
        // Route::get('workshop-view/{id}',[Ws_WorkshopMaterialController::class,'workshopView'])->name('workshop-view');
        //End Workshop Routes

        //Create schedule for workshop
        Route::post('create-schedule',[Ws_WorkshopMaterialController::class,'createSchedeule'])->name('workshop.create-schedule');
        Route::post('edit-schedule',[Ws_WorkshopMaterialController::class,'editSchedeule'])->name('workshop.edit-schedule');
        //End Schedule

        //Create Presentation for workshop
        Route::post('create-presentations',[Ws_WorkshopMaterialController::class,'createPresentations'])->name('workshop.create-presentations');
        Route::post('edit-presentations',[Ws_WorkshopMaterialController::class,'editPresentations'])->name('workshop.edit-presentations');
        //end presentation

        //End Workshop
        Route::get('certificate/choose',[Ws_certificateController::class,'index'])->name('workshop.admin.certificate.list');
        Route::post('certificate/choose',[Ws_certificateController::class,'assignCertificate'])->name('course.admin.certificate.assign');

    });

    Route::group(['middleware' => ['auth','auth.workshop', 'role:User']], function () {
        Route::get('user-dashboard',[Ws_UserHomeController::class,'index'])->name('workshop.user.dashboard');
        Route::post('user-logout',[Ws_UserHomeController::class,'userLogout'])->name('workshop.user.logout');

        //View and enroll Workshop
        Route::any('workshop-list',[Ws_EnrollController::class,'index'])->name('user.workshop.list');
        Route::post('search-workshop',[Ws_EnrollController::class,'searchWorkshop'])->name('user.workshop.list.search');
        Route::get('workshop-details/{id}',[Ws_EnrollController::class,'workshopDetails'])->name('user.workshop.details');

        Route::get('cart-list',[Ws_EnrollController::class,'showCart'])->name('user.workshop.showCart');
        Route::get('add-to-cart/{id}',[Ws_EnrollController::class,'addToCart'])->name('user.workshop.addCart');
        Route::get('{id}/cart/remove',[Ws_EnrollController::class,'removeFormCart'])->name('user.workshop.details.removeCart');
        Route::get('checkout/{id}',[Ws_EnrollController::class,'checkout'])->name('user.workshop.checkout');
        Route::patch('enroll/{id}',[Ws_EnrollController::class,'enroll'])->name('user.workshop.enroll');


       //profile routes
       Route::get('enrolled-list',[Ws_profileController::class,'enrolledList'])->name('user.workshop.enrolled.list');
       Route::get('settings',[Ws_profileController::class,'settingInfo'])->name('user.workshop.settings.info');
       Route::Patch('settings',[Ws_profileController::class,'settingInfoUpdate'])->name('user.workshop.settings.info.update');
       Route::get('view-workshop-schedule/{id}',[Ws_profileController::class,'viewSchedule'])->name('user.workshop.view-workshop-schedule');

       //Attendance Routes
       Route::get('view-attendance',[Ws_AttendanceController::class, 'viewAttendance'])->name('workshop.user.view-attendance');
       Route::post('user-attendance-regularization',[Ws_AttendanceController::class,'userAttendanceregularization'])->name('user.attendance-regularization');
       //Review Routes
       Route::post('{id}/review/store',[Ws_ReviewController::class,'reviewStore'])->name('user.workshop.review.store');
       Route::get('reviews-list',[Ws_ReviewController::class,'getAllReviews'])->name('user.workshop.review.show');

        //Download Certificate
        Route::get('user-Certificate/{id}',[Ws_AttendanceController::class,'getCertificate'])->name('user.workshop.Certificate');

    });
});
