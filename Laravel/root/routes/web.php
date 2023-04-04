<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminWorkController;

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

//管理画面トップページ
Route::get('/admin', function () {
    return view('/admin/top');
});
//admin側社員管理
Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('user/register', [UserController::class, 'create'])->name('user.register.create');
Route::post('user/register', [UserController::class, 'store'])->name('user.register.store');
Route::get('user/{user}', [UserController::class, 'show'])->name('user.show');
Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::patch('user/{user}', [UserController::class, 'update'])->name('user.update');
Route::post('user/{user}/confirm', [UserController::class, 'confirm'])->name('user.confirm');
Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy');
//admin側勤怠管理
Route::prefix('admin/works')->group(function () {
    Route::get('/',[AdminWorkController::class,'index'])->name('admin.works');
    Route::post('/',[AdminWorkController::class,'search'])->name('admin.works.search');
});

//ログイン画面(社員)
Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

//ログイン後画面（社員）
Route::middleware(['auth'])->group(function () {
    //勤怠管理トップページ
    Route::get('/home', function () {
        return view('/user/top');
    })->name('home');
    //勤怠管理
    Route::prefix('work')->group(function () {
        Route::get('/{user}', [WorkController::class, 'index'])->name('work'); //一覧表示
        Route::post('/{user}', [WorkController::class, 'show'])->name('work.show'); //月変更
        Route::get('{user}/register/{work}', [WorkController::class, 'edit'])->name('work.register.edit'); //新規登録表示
        Route::post('/{user}/register/{work}', [WorkController::class, 'update'])->name('work.register.update'); //勤怠更新
    });
    //出退勤送信
    Route::prefix('report')->group(function () {
        Route::get('/{user}/store', [ReportController::class, 'store'])->name('report.store'); //出勤登録
        Route::get('/{user}/update', [ReportController::class, 'update'])->name('report.update'); //退勤登録
    });

    // ログアウト
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
