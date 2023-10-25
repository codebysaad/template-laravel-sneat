<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/user', [UserController::class, 'index'])->name('admin.user');
    Route::get('/user/get', [UserController::class, 'get_data'])->name('admin.user.get');
    Route::post('/user/create', [UserController::class, 'store'])->name('admin.user.create');
    Route::post('/user/update', [UserController::class, 'update'])->name('admin.user.update');
    Route::post('/user/delete', [UserController::class, 'delete'])->name('admin.user.delete');
});

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home-user', [HomeController::class, 'index'])->name('user.home');
});
