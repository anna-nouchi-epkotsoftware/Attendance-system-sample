<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkController;

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

//管理画面
Route::get('/admin', function () {
    return view('/admin/top');
});
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('user/register', [UserController::class, 'create'])->name('user.register.create');
Route::post('user/register', [UserController::class, 'store'])->name('user.register.store');
Route::get('user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('user/{user}', [UserController::class, 'update'])->name('user.update');
Route::post('user/{user}/confirm', [UserController::class, 'confirm'])->name('user.confirm');
Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');



//ログイン画面
Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

});
//ログイン後画面（社員）
Route::middleware(['auth'])->group(function () {
    //勤怠管理
    Route::get('/home', function () {
        return view('/user/top');
    })->name('home');
    Route::get('/works/{user}',[WorkController::class, 'index'])->name('works'); //一覧表示
    Route::post('/works/{user}',[WorkController::class, 'index2'])->name('works.store'); //月変更
    // ログアウト
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');
});
