<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Training\Auth\RegisterController;
use App\Http\Controllers\Training\Auth\LoginController;
use App\Http\Controllers\Training\Admin\DashboardController;
use App\Http\Controllers\Training\Admin\AuthController;
use App\Http\Controllers\Training\UserDashboardController;
use App\Http\Controllers\Training\TrainingController;
use App\Http\Controllers\Training\Admin\Tr_UserController;
use App\Http\Controllers\Training\Admin\AdminController;
use App\Http\Controllers\Training\Admin\StudentController;
use App\Http\Controllers\Training\Admin\ClassController;
use App\Http\Controllers\Training\TrainingMaster\Master_CategoryController;
use App\Http\Controllers\Training\TrainingMaster\MasterTrainerController;
use App\Http\Controllers\Training\TrainingMaster\MasterMediaController;
use App\Http\Controllers\Training\TrainingMaster\MasterSubjectController;
use App\Http\Controllers\Training\TrainingMaster\MasterCourseController;
use App\Http\Controllers\Training\TrainingMaster\MasterModuleController;
use App\Http\Controllers\Training\TrainingMaster\MasterPlaceController;
use App\Http\Controllers\Training\TrainingMaster\MasterTrainingController;
use App\Http\Controllers\Training\TrainingMaster\MasterEnrollmentController;
use App\Http\Controllers\Training\Admin\AttendanceController;
use App\Http\Controllers\Training\Admin\ReviewController;
use App\Http\Controllers\Training\Admin\ExamController;
use App\Http\Controllers\Training\ProfileController;
use App\Http\Controllers\Training\Meeting\ZoomController;
use App\Http\Controllers\Training\Meeting\GoogleMeetController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\Training\Admin\SponsorController;






/*
|--------------------------------------------------------------------------
| Training Routes
|--------------------------------------------------------------------------
|
| Here is where you can register training routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "training" middleware group. Now create something great!
|
*/





Route::get('get_city', [DashboardController::class, 'getCity'])->name('training.get_city');
// Route::get('reload-captcha', [DashboardController::class, 'reloadCaptcha'])->name('reload-captcha');

Route::get('/refresh-csrf', function () {
    return response()->json(['csrfToken' => csrf_token()]);
});

Route::prefix('training')->group(function () {

    // Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin.training.guest'], function () {
    //     Route::get('login', [AuthController::class, 'loginShow'])->name('admin.training.login');
    //     Route::post('login', [AuthController::class, 'loginCheck'])->name('admin.training.logincheck');

    // });

    Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin.training'], function () {
        Route::post('logout',[DashboardController::class,'adminLogout'])->name('admin.training.logout');
    });



    Route::group(['middleware' => ['auth','auth.training']], function () {

        Route::get('user-dashboard',[TrainingController::class,'UserTrainingList'])->name('trainingUser.UserTrainingList');
        Route::get('logout',[UserDashboardController::class,'logout'])->name('training.logout');
        Route::get('home',[UserDashboardController::class,'index'])->name('training.dashboard');


        //Training
            Route::any('list',[TrainingController::class,'index'])->name('training.list');

            Route::get('details/{id}',[TrainingController::class,'courseDetails'])->name('training-user.course-details');
            Route::post('details/{id}/review',[TrainingController::class,'storeReview'])->name('training-user.store.review');

            Route::post('search-training',[TrainingController::class,'searchTraining'])->name('training.list.search');

        //End Training

        //Cart
            Route::get('cart',[TrainingController::class,'cart'])->name('training-user.cart');
            Route::get('add-cart/{id}',[TrainingController::class,'addCart'])->name('training-user.add-cart');
            Route::get('cart/{id}/remove',[TrainingController::class,'cartRemove'])->name('training-user.cart.remove');
        //End Cart

        //Checkout
            Route::get('details/{id}/enroll',[TrainingController::class,'enroll'])->name('training-user.enroll');
            Route::post('details/{id}/order',[TrainingController::class,'order'])->name('training-user.order');
        //End Checkout



        // user attendance


        Route::get('user-attendance',[AttendanceController::class,'userAttendance'])->name('training-user.userAttendance');
        Route::post('user-attendance-regularization-request',[AttendanceController::class,'userAttendanceregularizationRequest'])->name('training-user.userAttendanceregularizationRequest');
        Route::get('batch/user-class/{id}',[ClassController::class,'index'])->name('training-user.class.list');


        Route::get('batch/user-class-Certificate/{id}',[ClassController::class,'Certificate'])->name('training-user.class.Certificate');
        // Akshey

        Route::get('/batch/user-class/view/{id}',[ClassController::class,'show'])->name('training.user.class.view');

        Route::patch('/batch/user-class/view/{id}/assignment/update',[ProfileController::class,'submitAssignment'])->name('training.user.submit.assignment');

        //Profile
        Route::get('profile',[ProfileController::class,'index'])->name('training-user.profile');
        Route::get('enrolled-courses',[ProfileController::class,'enrolledCourses'])->name('training-user.profile.enrolled-courses');
        Route::get('feedbacks',[ProfileController::class,'feedback'])->name('training-user.profile.feedbacks');
        Route::get('feedbacks/{id}/delete',[ProfileController::class,'feedbackDestroy'])->name('training-user.profile.feedbacks.destroy');

        Route::get('settings',[ProfileController::class,'settingInfo'])->name('training-user.profile.settings.info');
        Route::put('settings',[ProfileController::class,'settingInfoUpdate'])->name('training-user.profile.settings.info.update');


    });
    Route::group(['middleware' => ['auth.training.guest']], function () {
        Route::get('register',[RegisterController::class,'create'])->name('training.register.create');
        Route::post('register',[RegisterController::class,'store'])->name('training.register.store');
        Route::get('login',[LoginController::class,'showLogin'])->name('training.login.show');
        Route::post('login',[LoginController::class,'attemptLogin'])->name('training.login.check');
    });



    Route::group(['middleware' => ['auth.training.isadmin']], function () {

        Route::get('dashboard',[DashboardController::class,'index'])->name('admin.training.dashboard');
        Route::post('logout',[AuthController::class,'adminLogout'])->name('admin.training.logout');

        Route::get('my-profile',[DashboardController::class,'profile'])->name('admin.training.profile');
        Route::patch('update-profile',[DashboardController::class,'updateProfile'])->name('admin.training.profile.update');




        //Users Routes
            Route::get('users',[Tr_UserController::class,'index'])->name('training.users');
            Route::get('users/{id}/edit',[Tr_UserController::class,'edit'])->name('training.users.edit');
            Route::get('users/edit/{id}/{status}',[Tr_UserController::class,'updateStatus'])->name('training.users.status');
            Route::put('users/{id}',[Tr_UserController::class,'update'])->name('training.users.update');


        //End Users Routes

        //Sponsor Routes
            // Route::get('sponsors',[SponsorController::class,'index'])->name('training.sponsor.users');

            Route::resource('sponsors', SponsorController::class)->names([
                'index' => 'training.sponsor.index',
                'store' => 'training.sponsor.store',
                'update' => 'training.sponsor.update',
            ]);


        //End Sponsor Routes


        // Training Category
            Route::get('/training-category',[Master_CategoryController::class,'index'])->name('training-category-index');
            Route::post('/training-category-store',[Master_CategoryController::class,'store'])->name('training-category-store');
            Route::post('/training-category/{id}',[Master_CategoryController::class,'update'])->name('training-category-update');
            Route::delete('/training-category/{id}/delete',[Master_CategoryController::class,'destroy'])->name('training-delete-category');
        //End Training Category

        // Training Category
            Route::get('/training-user-list',[MasterTrainerController::class,'index'])->name('trainer.index');
            Route::post('/training-user-store',[MasterTrainerController::class,'store'])->name('trainer.store');

            Route::post('/training-user-details/{id}', [MasterTrainerController::class, 'updateUserDetails'])->name('trainer.userUpdate');


            Route::get('/training-assign-class/{id?}', [MasterTrainerController::class, 'trainingAssignClass'])->name('trainer.trainingAssignClass');


             //Training Transaction details
        Route::get('transaction-list',[MasterTrainerController::class,'transaction'])->name('training.transactiondetails');

            // Route::post('/training-category/{id}',[MasterTrainerController::class,'update'])->name('training-category-update');
            // Route::delete('/training-category/{id}/delete',[MasterTrainerController::class,'destroy'])->name('training-delete-category');
        //End Training Category


        // Training media
            Route::get('/training-media',[MasterMediaController::class,'index'])->name('training-media-index');
            Route::post('/training-media-store',[MasterMediaController::class,'store'])->name('training-media-store');
            Route::post('/training-media/{id}',[MasterMediaController::class,'update'])->name('training-media-update');
            Route::delete('/training-media/{id}/delete',[MasterMediaController::class,'destroy'])->name('training-delete-media');
        //End Training Category

        //Subjects
            Route::get('/training-subjects',[MasterSubjectController::class,'index'])->name('training-subjects-index');
            Route::post('/training-subjects-store',[MasterSubjectController::class,'store'])->name('training-subjects-store');
            Route::post('/training-subjects/{id}',[MasterSubjectController::class,'update'])->name('training-subjects-update');
            Route::delete('/training-subjects/{id}/delete',[MasterSubjectController::class,'destroy'])->name('training-delete-subjects');
        //End Subjects


        // Training Course
            Route::get('/training-course',[MasterCourseController::class,'index'])->name('training-course-index');
            Route::post('/training-course-store',[MasterCourseController::class,'store'])->name('training-course-store');
            Route::post('/training-course/{id}',[MasterCourseController::class,'update'])->name('training-course-update');
            Route::delete('/training-course/{id}/delete',[MasterCourseController::class,'destroy'])->name('training-delete-course');
        //End Training Course

        // Training Module
            Route::get('/training-module',[MasterModuleController::class,'index'])->name('training-module-index');
            Route::post('/training-module-store',[MasterModuleController::class,'store'])->name('training-module-store');
            Route::post('/training-module/{id}',[MasterModuleController::class,'update'])->name('training-module-update');
            Route::delete('/training-module/{id}/delete',[MasterModuleController::class,'destroy'])->name('training-delete-module');
        // End Training Module


        // Training Place
            Route::get('/training-place',[MasterPlaceController::class,'index'])->name('training-place-index');
            Route::post('/training-place-store',[MasterPlaceController::class,'store'])->name('training-place-store');
            Route::post('/training-place/{id}',[MasterPlaceController::class,'update'])->name('training-place-update');
            Route::delete('/training-place/{id}/delete',[MasterPlaceController::class,'destroy'])->name('training-delete-place');
        // End Training Place



        // Training Enrollments Dates
            Route::get('/training-enrollment',[MasterEnrollmentController::class,'index'])->name('training-enrollment-index');
            Route::post('/training-enrollment-store',[MasterEnrollmentController::class,'store'])->name('training-enrollment-store');
            Route::put('/training-enrollment-update/{id}',[MasterEnrollmentController::class,'update'])->name('training-enrollment-update');
            Route::get('get-training-category',[MasterEnrollmentController::class,'getCategory'])->name('training-category');




        // End Training Enrollments Dates


        //Training
        Route::get('training-list',[MasterTrainingController::class,'trainingList'])->name('training.admin.trainingList');
        // Route::get('training-list-type/{id}',[MasterTrainingController::class,'trainingListType'])->name('training.admin.trainingListType');
        Route::get('training-list/{id}',[MasterTrainingController::class,'index'])->name('training.admin.about');
        //Assign Training to user
        Route::get('assign-training-to-user/{id}',[MasterTrainingController::class,'assignTraining'])->name('training.admin.assign-training-to-user');
        Route::post('assign-training-store',[MasterTrainingController::class,'assignTrainingStore'])->name('training.admin.assign-training-store');
        Route::get('get_training_id', [MasterTrainingController::class,'getTrainingId'])->name('training.admin.get_training');

        Route::get('training-list/export',[MasterTrainingController::class,'exportList'])->name('training.admin.export.list');
            // new changes for certificate wise
        //End Training

        //Class
        Route::get('batch/class/{id}',[ClassController::class,'index'])->name('training.admin.class.list');
        Route::get('batch/class/{id}/create',[ClassController::class,'create'])->name('training.admin.class.create');


        Route::get('batch/class/{id}/edit',[ClassController::class,'edit'])->name('training.admin.class.edit');

        Route::get('/batch/class/view/{id}',[ClassController::class,'show'])->name('training.admin.class.view');
        Route::post('class-store',[ClassController::class,'store'])->name('training.admin.class.store');
        Route::post('class-media-store',[ClassController::class,'mediaStore'])->name('training.admin.class.mediaStore');
        Route::post('class-ebook-store',[ClassController::class,'eBookStore'])->name('training.admin.class.eBookStore');
        Route::post('class-assignment-store',[ClassController::class,'assignmentStore'])->name('training.admin.class.assignmentStore');


        //End Class

        //Students
            Route::get('student-list',[StudentController::class,'index'])->name('training.admin.student.list');
            Route::get('get-batches/{training_id}',[AdminController::class,'fetchBatchList'])->name('training.fetch.batchlist');
            Route::get('student-export',[StudentController::class,'export'])->name('training.admin.student.export');
            Route::put('student/{studentid}/branch-update',[StudentController::class,'studentBranchUpdate'])->name('training.student.branch.update');
        //End Students

        //Training Batch
            Route::get('batches',[AdminController::class,'batchList'])->name('training.batchList');
            Route::get('certificate-setting',[AdminController::class,'CertificateSetting'])->name('training.CertificateSetting');

            Route::post('certificate-setting',[AdminController::class,'CertificateSettingSave'])->name('training.CertificateSettingSave');

            Route::get('create-training',[AdminController::class,'createTraining'])->name('training.createTraining');

            Route::post('create-training-store',[AdminController::class,'createTrainingStore'])->name('training.createTrainingstore');
            Route::post('remove-batch',[AdminController::class,'removeBatches'])->name('training.remove.batch');



            Route::get('edit-training/{id}',[AdminController::class,'editTraining'])->name('training.editTraining');
            Route::post('edit-training-store/{id}',[AdminController::class,'editTrainingStore'])->name('training.editTrainingstore');

            Route::get('{trainingid}/batch/{batchid}/details',[AdminController::class,'batchDetails'])->name('training.admin.batch.details');
            Route::post('{trainingid}/batch/{batchid}/details',[AdminController::class,'batchDetailsStore'])->name('training.admin.batch.details.store');
        //End Training Batch

        //Review
            Route::get('reviews',[ReviewController::class,'index'])->name('training.admin.review.list');
            Route::get('review/{id}/delete',[ReviewController::class,'destroy'])->name('training.admin.review.delete');
        //End Review


        //Meetings
            Route::get('auth/zoom', [ZoomController::class, 'redirectToZoom'])->name('training.admin.auth.zoom');
            Route::get('zoom/oauthredirect', [ZoomController::class, 'handleZoomCallback']);
            Route::post('create-zoom-meeting',[ZoomController::class,'create'])->name('training.admin.zoom.create');
            Route::patch('update-zoom-meeting/{id}',[ZoomController::class,'update'])->name('training.admin.zoom.update');
            Route::get('google-meet-callback', [GoogleMeetController::class, 'handleCallback'])->name('training.admin.auth.googlemeet');
            Route::patch('update-google-meet/{id}', [GoogleMeetController::class, 'update'])->name('training.admin.auth.googlemeet.update');
        //End Meetings


        //Assignment
            Route::get('batch/class/view/{id}/assignment/{assignment_id}', [ClassController::class, 'assignmentIndex'])->name('training.admin.class.assignment');

            Route::post('batch/class/view/{id}/assignment/{assignment_id}', [ClassController::class, 'studentAssignmentStore'])->name('training.admin.class.assignment.store');

            Route::get('assignment/{assignment_file}/download', [ClassController::class, 'studentAssignmentDownload'])->name('training.admin.class.assignment.download');

        //End Assignment

        //training added by sponsor
        Route::get('sponsor-added-training',[AdminController::class,'sponsorAddedTraining'])->name('training.admin.sponsor-added-training');
        Route::get('view-user-list/{id}',[AdminController::class,'viewtrainingUser'])->name('training.admin.view-user-list');
        //Start Examination

        // Route::get('{id}/exam/create', [ExamController::class, 'create'])->name('training.admin.exam.create');
        // Route::post('{id}/exam/create', [ExamController::class, 'store'])->name('training.admin.exam.store');






    // Route::get('attendances/ajax_employees/', ['as' => 'admin.attendance.ajax_employees', 'uses' => 'AttendancesController@ajax_employees']);
    // Route::get('attendances/ajax_attendance', ['as' => 'admin.attendance.ajax_attendance', 'uses' => 'AttendancesController@ajax_attendance']);
    // Route::get('attendances/report/{attendances}', ['as' => 'admin.attendance.report', 'uses' => 'AttendancesController@report']);
    // Route::post('attendance/update/row', ['as' => 'admin.attendance.update.row', 'uses' => 'AttendancesController@updateAttendanceRow']);
    // Route::post('attendance/clockIn', ['as' => 'admin.attendance.clockin', 'uses' => 'AttendancesController@clockInIP']);
    // // attendance Filter route
    // Route::post('attendances/filter', ['as'=>'admin.attendance.filter','uses'=>'AttendancesController@filterAttendance']);
    // Route::get('attendances-employee', ['as'=>'admin.attendance.employee','uses'=>'AttendancesController@attendanceEmployee']);
    // Route::resource('attendances', 'App\Http\Controllers\Training\admin\AttendanceController', ['as' => 'admin']);

    Route::any('attendance-index/{id}',[AttendanceController::class,'index'])->name('attendance.index');
    // Route::resource('/admin', 'App\Http\Controllers\AdminController');

    Route::any('attendance-store',[AttendanceController::class,'store'])->name('attendance.store');
    Route::post('user-regularization-submit/{id}',[AttendanceController::class,'regularizationSubmit'])->name('training-user.admin.regularizationSubmit');



    });



});

