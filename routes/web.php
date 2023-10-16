<?php

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('upload', [App\Http\Controllers\HomeController::class, 'upload'])->name('upload');

Route::get('delete',[App\Http\Controllers\HomeController::class, 'delete'])->name('delete');

Route::get('trashed',[App\Http\Controllers\HomeController::class, 'trashed'])->name('trashed');

Route::get('restore_user/{id}',[App\Http\Controllers\HomeController::class, 'restore_user'])->name('restore_user');

Route::get('check/{marks}',[App\Http\Controllers\HomeController::class, 'get_result'])->name('check');