<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


//Login Routes
Route::get('/', function () {
    return view('login');
});
Route::post('login', [RegistrationController::class, 'login'])->name('login');
Route::post('register', [RegistrationController::class, 'register'])->name('sinup');
Route::get('logout', [RegistrationController::class, 'logout'])->name('logout');
Route::get('Forgot', [RegistrationController::class, 'forgot'])->name('user.forgot');
Route::post('sendForgotEmail', [RegistrationController::class, 'sendForgotEmail'])->name('user.send.email');
Route::get('restpassword', [RegistrationController::class, 'sendOnRestPage'])->name('admin.reset.password');
Route::post('restpassword', [RegistrationController::class, 'resetPassword'])->name('admin.reset.info');

//Users Route
Route::group(['prefix' => 'users'], function () {
    Route::get('', [UserController::class, 'index'])->middleware('CheckLogin')->name('users.show');
    Route::get('delete{id}', [UserController::class, 'destroy'])->middleware('CheckLogin')->name('user.delete');
    Route::get('edit/{id}', [UserController::class, 'edit'])->middleware('CheckLogin')->name('user.edit');
    Route::post('update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('create', [UserController::class, 'create'])->middleware('CheckLogin')->name('user.add');
    Route::post('add', [UserController::class, 'store'])->name('user.store');
});

//Admin Route
Route::group(['prefix' => 'admin'], function () {
        Route::get('', function () {
            return view('admin_login');
        })->name('admin');
        Route::post('adminlogin', [RegistrationController::class, 'adminLogin'])->name('admin.login');
        Route::get('data', [UserController::class, 'admin'])->middleware('CheckLogin')->name('admin.show');
});
