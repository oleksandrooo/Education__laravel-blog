<?php

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
Route::controller(\App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/', 'index');
});
Route::prefix('admin')->middleware(['auth', 'admin', 'verified'])->group(function () {
    Route::controller(\App\Http\Controllers\AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin.main.index');
    });
    Route::prefix('categories')->group(function () {
        Route::controller(\App\Http\Controllers\CategoryController::class)->group(function () {
            Route::get('/', 'index')->name('admin.category.index');
            Route::get('/create', 'create')->name('admin.category.create');
            Route::post('/', 'store')->name('admin.category.store');
            Route::get('/{category}', 'show')->name('admin.category.show');
            Route::get('/{category}/edit', 'edit')->name('admin.category.edit');
            Route::patch('/{category}', 'update')->name('admin.category.update');
            Route::delete('/{category}', 'destroy')->name('admin.category.destroy');
        });
    });
    Route::prefix('tags')->group(function () {
        Route::controller(\App\Http\Controllers\TagController::class)->group(function () {
            Route::get('/', 'index')->name('admin.tag.index');
            Route::get('/create', 'create')->name('admin.tag.create');
            Route::post('/', 'store')->name('admin.tag.store');
            Route::get('/{tag}', 'show')->name('admin.tag.show');
            Route::get('/{tag}/edit', 'edit')->name('admin.tag.edit');
            Route::patch('/{tag}', 'update')->name('admin.tag.update');
            Route::delete('/{tag}', 'destroy')->name('admin.tag.destroy');
        });
    });
    Route::prefix('posts')->group(function () {
        Route::controller(\App\Http\Controllers\PostController::class)->group(function () {
            Route::get('/', 'index')->name('admin.post.index');
            Route::get('/create', 'create')->name('admin.post.create');
            Route::post('/', 'store')->name('admin.post.store');
            Route::get('/{post}', 'show')->name('admin.post.show');
            Route::get('/{post}/edit', 'edit')->name('admin.post.edit');
            Route::patch('/{post}', 'update')->name('admin.post.update');
            Route::delete('/{post}', 'destroy')->name('admin.post.destroy');
        });
    });
    Route::prefix('users')->group(function () {
        Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
            Route::get('/', 'index')->name('admin.user.index');
            Route::get('/create', 'create')->name('admin.user.create');
            Route::post('/', 'store')->name('admin.user.store');
            Route::get('/{user}', 'show')->name('admin.user.show');
            Route::get('/{user}/edit', 'edit')->name('admin.user.edit');
            Route::patch('/{user}', 'update')->name('admin.user.update');
            Route::delete('/{user}', 'destroy')->name('admin.user.destroy');
        });
    });
});


Route::prefix('personal')->middleware(['auth', 'verified'])->group(function () {
    Route::controller(\App\Http\Controllers\PersonalController::class)->group(function () {
        Route::get('/', 'index')->name('personal.main.index');
    });
    Route::prefix('liked')->group(function () {
        Route::controller(\App\Http\Controllers\LikedController::class)->group(function () {
            Route::get('/', 'index')->name('personal.liked.index');
            //Route::get('/create', 'create')->name('personal.liked.create');
            //Route::post('/', 'store')->name('personal.liked.store');
            //Route::get('/{liked}', 'show')->name('personal.liked.show');
            Route::delete('/{post}', 'destroy')->name('personal.liked.destroy');
        });
    });
    Route::prefix('comments')->group(function () {
        Route::controller(\App\Http\Controllers\CommentController::class)->group(function () {
            Route::get('/', 'index')->name('personal.comment.index');
            //Route::get('/create', 'create')->name('personal.comment.create');
            //Route::post('/', 'store')->name('personal.comment.store');
            //Route::get('/{comment}', 'show')->name('personal.comment.show');
            Route::get('/{comment}/edit', 'edit')->name('personal.comment.edit');
            Route::patch('/{comment}', 'update')->name('personal.comment.update');
            Route::delete('/{comment}', 'destroy')->name('personal.comment.destroy');
        });
    });
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

