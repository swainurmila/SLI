<?php
use Illuminate\Support\Facades\Route;



// use App\Http\Controllers\Training\UsersTestController;
// use App\Http\Controllers\UserController;


use App\Http\Controllers\common\CommonUserController;
use App\Http\Controllers\Training\TrainingMaster\MasterTrainerController;






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

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('user')->group(function () {
        Route::get('/approve-user', [CommonUserController::class, 'approveUser'])->name('user.approve-user');
    });
    Route::post('/checkmail', [CommonUserController::class, 'checkMail'])->name('register-checkmail');


    Route::post('/training-user-store',[MasterTrainerController::class,'store'])->name('trainer.store');
});






