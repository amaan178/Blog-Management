<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'index'])->name('blogs.home');
Route::get('/blogs/{post}', [FrontendController::class,'show'])->name('blogs.show');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

//Application routes
Route::resource('categories', CategoriesController::class)->middleware(['auth']);
Route::resource('tags', TagsController::class)->middleware(['auth']);
Route::resource('posts', PostController::class)->middleware(['auth']);
