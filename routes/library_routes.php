<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Library\Admin\AuthController;


Route::prefix('library')->group(function () {


    //Login and register
    Route::get('/login', [AuthController::class, 'libraryLogin'])->name('library.login');
    Route::post('/attempt-login', [AuthController::class, 'login'])->name('library.login-attempt');
    Route::get('/register', [AuthController::class, 'libraryRegister'])->name('library.register');
    Route::get('/get-city', [AuthController::class, 'getCity'])->name('library.get_city');
    Route::post('/store-register', [AuthController::class, 'storeRegister'])->name('library.store-register');
});

