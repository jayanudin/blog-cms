<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\LoginController;

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


Auth::routes(['login' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('auth', [LoginController::class, 'index'])->name('index');
    Route::post('auth/loginAction', [LoginController::class, 'loginAction'])->name('auth.loginAction');
    Route::get('auth/actionLogout', [LoginController::class, 'actionLogout'])->name('auth.actionLogout')->middleware('auth');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('dashboard', [DashboardAdminController::class, 'index'])->name('index');
    Route::get('article', [ArticleController::class, 'index'])->name('index');
    Route::get('article/create', [ArticleController::class, 'create'])->name('article.create');
    Route::get('article/edit/{id}', [ArticleController::class, 'edit'])->name('article.edit');
    Route::post('article/create/store', [ArticleController::class, 'store'])->name('article.store');
    Route::get('article/destroy/{id}', [ArticleController::class, 'destroy'])->name('article.destroy');
    Route::put('article/update/{id}', [ArticleController::class, 'update'])->name('article.update');
    Route::get('article/show/{id}', [ArticleController::class, 'show'])->name('article.show');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::get('category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('category/create/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::put('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('tag', [TagController::class, 'index'])->name('tag.index');
    Route::get('tag/create', [TagController::class, 'create'])->name('tag.create');
    Route::get('tag/edit/{id}', [TagController::class, 'edit'])->name('tag.edit');
    Route::post('tag/create/store', [TagController::class, 'store'])->name('tag.store');
    Route::get('tag/destroy/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
    Route::put('tag/update/{id}', [TagController::class, 'update'])->name('tag.update');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::get('comment', [CommentController::class, 'index'])->name('comment.index');
    Route::get('comment/create', [CommentController::class, 'create'])->name('comment.create');
    Route::get('comment/edit/{id}', [CommentController::class, 'edit'])->name('comment.edit');
    Route::post('comment/create/store', [CommentController::class, 'store'])->name('comment.store');
    Route::get('comment/destroy/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::put('comment/update/{id}', [CommentController::class, 'update'])->name('comment.update');
});

Route::get('admin/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm');

// API

Route::group(['prefix' => 'api/v1', 'as' => 'api/v1.'], function () {
    Route::get('article', [ArticleController::class, 'getArticlesApi'])->name('index');
    Route::get('article/detail/{slug}', [ArticleController::class, 'getArticleBySlugApi'])->name('index');
    Route::get('article/category/{articleId}', [ArticleController::class, 'getCategoryById'])->name('index');
    Route::get('article/tag/{articleId}', [ArticleController::class, 'getTagById'])->name('index');
    Route::get('article/comment/{articleId}', [ArticleController::class, 'getCommentById'])->name('index');
    Route::post('article/comment/store', [CommentController::class, 'storeComment'])->name('index');
});