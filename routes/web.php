<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
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

Route::middleware(['auth'])->group(function(){
    Route::resource('categories', CategoriesController::class);
    Route::resource('tags', TagsController::class);
    Route::get('posts/drafts', [PostController::class, 'drafts'])->name('posts.drafts');
    Route::put('posts/drafts/{post}/publish', [PostController::class, 'publishDraft'])->name('posts.publish-draft');
    Route::put('posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
    Route::delete('posts/trash/{post}', [PostController::class, 'trash'])->name('posts.trash');
    Route::get('posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::resource('posts', PostController::class);

    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
    Route::put('/users/{user}/revoke-admin', [UsersController::class, 'revokeAdmin'])->name('users.revoke-admin');
});

