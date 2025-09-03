<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Eoffice\Auth\LoginController;

use App\Http\Controllers\Eoffice\Admin\DashboardController;
use App\Http\Controllers\Eoffice\Admin\EofficeUserController;


use App\Http\Controllers\Eoffice\Admin\FileController;
use App\Http\Controllers\Eoffice\DeliveryModeController;
use App\Http\Controllers\Eoffice\SectionController;
use App\Http\Controllers\Eoffice\GroupController;
use App\Http\Controllers\Eoffice\MainCatagoryController;
use App\Http\Controllers\Eoffice\SubCatagoryController;
use App\Http\Controllers\Eoffice\FileFormatController;
use App\Http\Controllers\Eoffice\MailContentController;
use App\Http\Controllers\Eoffice\Admin\AppointmentController;


use App\Http\Controllers\Eoffice\FileActionController;
use App\Http\Controllers\Eoffice\PriorityController;
use App\Http\Controllers\Eoffice\LetterTypeController;
use App\Http\Controllers\Eoffice\Auth\UserRegisterController;


use App\Http\Controllers\Eoffice\EAppointmentController;

use App\Http\Controllers\Eoffice\Admin\RolePermissionController;


use App\Http\Controllers\Eoffice\DepartmentController;
use App\Http\Controllers\Eoffice\PurposeController;






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






Route::prefix('e_office')->group(function () {

    Route::group(['middleware' => ['auth.office.guest']], function () {
        Route::get('register',[UserRegisterController::class,'registerShow'])->name('office.register.show');
        Route::post('register',[UserRegisterController::class,'EofficeUserStore'])->name('office.register.store');
        Route::post('/checkadhaar', [UserRegisterController::class, 'checkAdhaar'])->name('register-checkadhaar');
        
        Route::get('login',[LoginController::class,'showLogin'])->name('office.login.show');
        Route::post('login',[LoginController::class,'attemptLogin'])->name('office.login.check');
        Route::get('logout',[LoginController::class,'officeLogout'])->name('office.logout');

        Route::post('appointments-adhaar/otp',[EAppointmentController::class,'sendOtp'])->name('appointments.adhaar.otp');
        Route::post('appointments-adhaar/verify-otp',[EAppointmentController::class,'verifyOtp'])->name('appointments.adhaar.otp.verify');
    });


    Route::group(['middleware' => ['auth.office.isoffice']],function () {


            Route::get('dashboard',[DashboardController::class,'index'])->name('admin.office.dashboard');

            Route::get('view-profile',[DashboardController::class,'viewProfile'])->name('admin.office.viewprofile');
            Route::patch('update-profile',[DashboardController::class,'updateProfile'])->name('admin.office.updateprofile');




            // Route::middleware(['can:eoffice-superadmin'])->group(function () {

                //User
                Route::get('/users', [EofficeUserController::class, 'index'])->name('admin.office.user.index');
                Route::post('/users', [EofficeUserController::class, 'storeEofficeUser'])->name('admin.office.user.store');
                Route::patch('/users/{id}', [EofficeUserController::class, 'updateEofficeUser'])->name('admin.office.user.update');


                // Route::post('/add-fileaction', [FileActionController::class, 'FileActionAdd'])->name('add-fileaction');
                // Route::post('/update-fileaction/{id}', [FileActionController::class, 'FileActionUpdate'])->name('update-fileaction');
                // Route::post('/delete-fileaction/{id}', [FileActionController::class, 'FileActionDelete'])->name('delete-fileaction');

                Route::get('/deliverymode-master', [DeliveryModeController::class, 'deliverymodeMaster'])->name('deliverymode-master');
                Route::post('/add-deliverymode', [DeliveryModeController::class, 'deliverymodeAdd'])->name('add-deliverymode');
                Route::post('/update-deliverymode/{id}', [DeliveryModeController::class, 'deliverymodeUpdate'])->name('update-deliverymode');
                Route::post('/delete-deliverymode/{id}', [DeliveryModeController::class, 'deliverymodeDelete'])->name('delete-deliverymode');

                //section master
                Route::get('/section-master', [SectionController::class, 'sectionMaster'])->name('section-master');
                Route::post('/add-section', [SectionController::class, 'SectionAdd'])->name('add-section');
                Route::post('/update-section/{id}', [SectionController::class, 'sectionUpdate'])->name('update-section');
                Route::post('/delete-section/{id}', [SectionController::class, 'sectionDelete'])->name('delete-section');

                //office group master
                Route::get('/officegroup-master', [GroupController::class, 'groupMaster'])->name('officegroup-master');
                Route::post('/add-group', [GroupController::class, 'GroupAdd'])->name('add-group');
                Route::post('/update-group/{id}', [GroupController::class, 'GroupUpdate'])->name('update-group');
                Route::post('/delete-group/{id}', [GroupController::class, 'GroupDelete'])->name('delete-group');

                //office main catagory
                Route::get('/officemain-catagory-master', [MainCatagoryController::class, 'MainMaster'])->name('officemain-catagory-master');
                Route::post('/add-maincatagory', [MainCatagoryController::class, 'CatagoryAdd'])->name('add-maincatagory');
                Route::post('/update-catagory/{id}', [MainCatagoryController::class, 'CatagoryUpdate'])->name('update-catagory');
                Route::post('/delete-catagory/{id}', [MainCatagoryController::class, 'CatagoryDelete'])->name('delete-catagory');
                    //ajax route
                    // routes/web.php

                Route::get('/main-categories', [SubCatagoryController::class, 'fetchMainCategories'])->name('maincatagories');

                //office sub catagory
                Route::get('/officesub-catagory-master', [SubCatagoryController::class, 'SubCatagoryMaster'])->name('officesub-catagory-master');
                Route::post('/add-subcatagory', [SubCatagoryController::class, 'SubCatagoryAdd'])->name('add-subcatagory');
                Route::post('/update-subcatagory/{id}', [SubCatagoryController::class, 'SubCatagoryUpdate'])->name('update-subcatagory');
                Route::post('/delete-subcatagor/{id}', [SubCatagoryController::class, 'SubCatagoryDelete'])->name('delete-subcatagory');



                // file format  master
                Route::get('/fileformat-master', [FileFormatController::class, 'fileMaster'])->name('fileformat-master');
                Route::post('/add-fileformat', [FileFormatController::class, 'FileAdd'])->name('add-fileformat');
                Route::post('/update-fileformat/{id}', [FileFormatController::class, 'FileUpdate'])->name('update-fileformat');
                Route::post('/delete-fileformat/{id}', [FileFormatController::class, 'FileDelete'])->name('delete-fileformat');

                //Mail Content Master
                Route::get('/mailcontent-master', [MailContentController::class, 'MailMaster'])->name('mailcontent-master');
                Route::post('/add-mailcontent', [MailContentController::class, 'MailAdd'])->name('add-mailcontent');
                Route::post('/update-mailcontent/{id}', [MailContentController::class, 'MailUpdate'])->name('update-mailcontent');
                Route::post('/delete-mailcontent/{id}', [MailContentController::class, 'MailDelete'])->name('delete-mailcontent');



                Route::get('/priority-master', [PriorityController::class, 'PriorityMaster'])->name('priority-master');
                Route::post('/add-priority', [PriorityController::class, 'PriorityAdd'])->name('add-priority');
                Route::post('/update-priority/{id}', [PriorityController::class, 'PriorityUpdate'])->name('update-priority');
                Route::post('/delete-priority/{id}', [PriorityController::class, 'PriorityDelete'])->name('delete-priority');

                //File Action Master
                Route::get('/fileaction-master', [FileActionController::class, 'FileActionMaster'])->name('fileaction-master');
                Route::post('/add-fileaction', [FileActionController::class, 'FileActionAdd'])->name('add-fileaction');
                Route::post('/update-fileaction/{id}', [FileActionController::class, 'FileActionUpdate'])->name('update-fileaction');
                Route::post('/delete-fileaction/{id}', [FileActionController::class, 'FileActionDelete'])->name('delete-fileaction');


                Route::resource('role', RolePermissionController::class)->names([
                    'index' => 'eoffice.admin.role.index',
                    'create' => 'eoffice.admin.role.create',
                    'edit' => 'eoffice.admin.role.edit',
                    'store' => 'eoffice.admin.role.store',
                    'update' => 'eoffice.admin.role.update',
                    'destroy' => 'appointments.destroy',
                ]);



                Route::get('/dept-master', [DepartmentController ::class, 'DepartmentMaster'])->name('dept-master');
                Route::post('/add-department', [DepartmentController::class, 'DepartmentAdd'])->name('add-department');
                Route::post('/update-department/{id}', [DepartmentController::class, 'DepartmentUpdate'])->name('update-department');
                Route::post('/delete-department/{id}', [DepartmentController::class, 'DepartmentDelete'])->name('delete-department');

                //Office Purpose Master
                Route::get('/purpose-master', [PurposeController ::class, 'PurposeMaster'])->name('purpose-master');
                Route::post('/add-purpose', [PurposeController::class, 'PurposeAdd'])->name('add-purpose');
                Route::post('/update-purpose/{id}', [PurposeController::class, 'PurposeUpdate'])->name('update-purpose');
                Route::post('/delete-purpose/{id}', [PurposeController::class, 'PurposeDelete'])->name('delete-purpose');

                //Office Letter Type
                Route::get('/letter-type-master', [LetterTypeController ::class, 'LetterTypeMaster'])->name('letter-type-master');
                Route::post('/add-letter-type', [LetterTypeController::class, 'LetterTypeAdd'])->name('add-letter-type');
                Route::post('/update-lettertype/{id}', [LetterTypeController::class, 'LetterTypeUpdate'])->name('update-lettertype');
                Route::post('/delete-lettertype/{id}', [LetterTypeController::class, 'LetterTypeDelete'])->name('delete-lettertype');

            // });

            // Route::middleware(['can:eoffice-user'])->group(function () {


                Route::get('create-file',[FileController::class,'createFile'])->name('admin.office.createFile'); 
                
                Route::get('edit-file/{id}',[FileController::class,'editFile'])->name('admin.office.editFile'); 
                
                Route::post('edit-file-save/{id?}',[FileController::class,'editFileSave'])->name('admin.office.editFileSave'); 
                
                Route::get('index',[FileController::class,'index'])->name('admin.office.index'); 
                
                Route::post('create-file-save',[FileController::class,'createFilesave'])->name('admin.office.createFilesave'); 
            
                Route::get('add-dispatch-mode',[FileController::class,'adddispatchMode'])->name('admin.office.adddispatchMode'); 

                // Route::get('create-file',[FileController::class,'createFile'])->name('admin.office.createFile');

                Route::get('edit-file/{id?}',[FileController::class,'editFile'])->name('admin.office.editFile');

                Route::post('edit-file-save/{id?}',[FileController::class,'editFileSave'])->name('admin.office.editFileSave');

                Route::get('index',[FileController::class,'index'])->name('admin.office.index');

                Route::post('create-file-save',[FileController::class,'createFilesave'])->name('admin.office.createFilesave');

                Route::get('add-dispatch-mode',[FileController::class,'adddispatchMode'])->name('admin.office.adddispatchMode');

                Route::post('save-add-dispatch-mode',[FileController::class,'saveAdddispatchMode'])->name('admin.office.saveAdddispatchMode');


                Route::post('/get_mode', [FileController::class, 'getMode'])->name('admin.office.getMode');




                Route::get('/inbox-file', [FileController::class, 'inboxFile'])->name('admin.office.inboxFile');

                Route::get('/sent-receipt', [FileController::class, 'sentReceipt'])->name('admin.office.sentReceipt');

                Route::get('/office-report', [FileController::class, 'officeReport'])->name('admin.office.office-report');
                Route::get('/repot-view-file/{id}', [FileController::class, 'reportViewFile'])->name('admin.office.repot-view-file');

                Route::get('/draft-file', [FileController::class, 'draftFile'])->name('admin.office.draftFile');



                Route::get('/recyclebin', [FileController::class, 'recyclebin'])->name('admin.office.recyclebin');
                Route::post('/delete-recyclebin-file/{id}', [FileController::class, 'deleteRecyclebin'])->name('admin.office.delete-recyclebin-file');

                Route::post('/delete-file-flow/{id}', [FileController::class, 'deleteFileFlow'])->name('admin.office.delete-file-flow');

                Route::get('restore-file/{id}', [FileController::class, 'restoreFile'])->name('admin.office.restore-file');

                
                Route::get('/view-file/{id}', [FileController::class, 'viewFile'])->name('admin.office.view-file');


                Route::post('/sentFile', [FileController::class, 'sentFile'])->name('admin.office.sentFile');
                Route::post('/replyFile', [FileController::class, 'replyFile'])->name('admin.office.replyFile');



                Route::post('/save-draft', [FileController::class, 'saveDraft'])->name('admin.office.saveDraft');

                Route::get('/appointment', [AppointmentController::class, 'index'])->name('admin.office.appointment.index');
                Route::get('all-appointments', [AppointmentController::class, 'allAppointments'])->name('admin.office.appointment.all-appointments');

                Route::post('/save-request-appointment', [AppointmentController::class, 'saveRequestAppointment'])->name('admin.office.appointment.saveRequestAppointment');


                Route::post('/save-approve-appointment', [AppointmentController::class, 'saveapproveAppointment'])->name('admin.office.appointment.saveapproveAppointment');

                Route::post('/save-reject-appointment', [AppointmentController::class, 'rejectAppoitment'])->name('admin.office.appointment.rejectAppoitment');


                Route::post('/save-momSubmit', [AppointmentController::class, 'momSubmit'])->name('admin.office.momSubmit');



                Route::resource('appointments', EAppointmentController::class)->names([
                    'index' => 'eoffice.appointments.index',
                    'create' => 'appointments.create',
                    'store' => 'eoffice.appointments.store',
                    'show' => 'appointments.show',
                    'edit' => 'appointments.edit',
                    'update' => 'appointments.update',
                    'destroy' => 'appointments.destroy',
                ]);

                Route::get('my-appointments',[EAppointmentController::class,'myAppointments'])->name('eoffice.myappointments.all');
                



                Route::get('get-authority-users', [AppointmentController::class, 'getAuthority'])->name('admin.office.getauthority');

            // });

    });






});

