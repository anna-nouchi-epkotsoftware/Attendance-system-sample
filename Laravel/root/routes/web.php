<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
    return view('/admin/top');
});
Route::get('/users',[UserController::class,'index'])->name('users');
Route::get('user/register', [UserController::class,'create'])->name('user.register.create');
Route::post('user/register', [UserController::class,'store'])->name('user.register.store');
Route::get('user/{user}', [UserController::class,'show'])->name('user.show');
Route::get('user/{user}/edit', [UserController::class,'edit'])->name('user.edit');
Route::patch('user/{user}', [UserController::class,'update'])->name('user.update');
Route::post('user/{user}/confirm', [UserController::class,'confirm'])->name('user.confirm');
Route::delete('user/{user}',[UserController::class,'destroy'])->name('user.destroy');
