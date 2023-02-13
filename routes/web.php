<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\MyProfileController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\EditUserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

Auth::routes(['verify' => true]);

Route::get('/home', [HomeController::class, 'index'])->middleware('Active')->name('home');

// Route::get('/update', [UserController::class, 'edit']);

// Route::put('/update/edit', [UserController::class, 'update']);

// Route::get('users', [DashboardUserController::class, 'index'])->middleware('auth')->name('users');

// Route::delete('/users/{id}', [DashboardUserController::class, 'destroy']);

Route::middleware(['auth', 'verified'])->group(function() {
Route::prefix('my-profile')->middleware(['auth', 'verified'])->group(function() {
    Route::get('/', [MyProfileController::class, 'index'])->name('my.profile.index');
    Route::put('/', [MyProfileController::class, 'update'])->name('my.profile.update');
});


Route::prefix('user')->middleware('SuperAdmin')->group(function() {
        Route::controller(UserController::class)->group(function () {
            Route::get('/list',  'list')->name('user.list');
            Route::get('/',  'index')->name('user.index');
            Route::get('/{user}' , 'edit')->name('user.edit');
            Route::put('/{user}', 'update')->name('user.update');
            Route::delete('/{user}', 'destroy')->name('user.destroy');
        });
})->name('user');
});


    