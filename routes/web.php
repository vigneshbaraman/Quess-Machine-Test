<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'index'])->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create',[HomeController::class,'create'])->name('create_blog');
Route::get('/content',[HomeController::class,'content'])->name('create_content');
Route::get('/edit/{slug}',[HomeController::class,'edit'])->name('edit-blog')
->middleware('check.post.ownership');
Route::post('/store',[HomeController::class,'store'])->name('store');
Route::post('/update/{id}',[HomeController::class,'update'])->name('update');
Route::post('delete-post',[HomeController::class,'destroy'])->name('delete-post')
->middleware('check.post.delete');
Route::get('logout',[HomeController::class,'logout'])->name('logout');
