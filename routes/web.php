<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryTagController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\Api\TagController;

use App\Http\Controllers\UserPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\LikeController;

Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/logout', function () {
    Auth::logout();
    return Redirect::route('login');
})->name('logout'); 

Route::middleware('auth')->group(function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::name('admin.')->prefix('admin')->group(function() {
        Route::resource('categories', CategoryController::class);
        Route::resource('categories.tags', CategoryTagController::class);
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });

    Route::resource('user.posts', UserPostController::class);
    Route::resource('posts', PostController::class);
    Route::resource('posts.comments', PostCommentController::class)->except(['index', 'create', 'show']);
    Route::post('users/{user}/likes', [LikeController::class, 'store'])->name('users.likes.store');

    Route::prefix('api')->group(function() {
        Route::get('category/{category}/tags', [TagController::class, 'index']);
    });
});
