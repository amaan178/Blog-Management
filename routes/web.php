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
Route::get('blogs/category/{category}', [FrontendController::class, 'category'])->name('blogs.category');
Route::get('blogs/tags/{tag}', [FrontendController::class, 'tag'])->name('blogs.tag');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

// Application routes
// NOTE: have used raw url instead of categories.destroy

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', CategoriesController::class);
    Route::resource('tags', TagsController::class);
    Route::delete('posts/trash/{post}', [PostController::class, 'trash'])->name('posts.trash');
    Route::get('posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');
    Route::put('posts/restore/{post}', [PostController::class, 'restore'])->name('posts.restore');
    Route::get('posts/drafts', [PostController::class, 'drafts'])->name('posts.drafts');
    Route::get('/posts/requests', [PostController::class, 'requests'])->name('posts.approval-requests');
    Route::put('/posts/drafts/{post}/draft', [PostController::class, 'draftPost'])->name('posts.draft-post');
    Route::put('posts/drafts/{post}/publish', [PostController::class, 'publishDraft'])->name('posts.publish-draft');
    Route::resource('posts', PostController::class);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::put('posts/requests/{post}/approve', [PostController::class, 'approveRequest'])->name('posts.approve-request');
    Route::put('posts/requests/{post}/disapprove', [PostController::class, 'disapproveRequest'])->name('posts.disapprove-request');
    Route::put('posts/requests/{post}/reason', [PostController::class, 'disapproveReason'])->name('posts.reason');
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/make-admin', [UsersController::class, 'makeAdmin'])->name('users.make-admin');
    Route::put('/users/{user}/revoke-admin', [UsersController::class, 'revokeAdmin'])->name('users.revoke-admin');
});
