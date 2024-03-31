<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\ProviderController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//authentication
Route::get('/auth/google/redirect', [ProviderController::class, 'redirect']);
Route::get('/auth/google/callback', [ProviderController::class, 'callback']);
//profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//category
// Route::get('/category', [CategoryController::class,'index'])->name('category.index');
// Route::get('/category/{category}/edit', [CategoryController::class,'edit'])->name('category.edit');
// Route::put('/category/{category}', [CategoryController::class,'update'])->name('category.update');
// Route::post('/category', [CategoryController::class,'store'])->name('category.store');
// Route::delete('/category/{category}', [CategoryController::class,'destroy'])->name('category.destroy');
Route::resource('/category', CategoryController::class)->except(['show','create']);
//user
// Route::get('/user', [UserController::class, 'index'])->name('user.index');
// Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
// Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
// Route::delete('/user/{user}',[UserController::class, 'destroy'])->name('user.destroy');
Route::resource('/user', UserController::class)->except('show','create','store');
//article
Route::get('/article', [ArticleController::class, 'index'])->name('article.index');
Route::post('/article', [ArticleController::class, 'store'])->name('article.store');
Route::get('/article/create', [ArticleController::class, 'create'])->name('article.create');
Route::get('/article/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');
Route::put('/article/{article}', [ArticleController::class, 'update'])->name('article.update');
Route::delete('/article/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');

//laravel file manager
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::get('/', function () {
    return view('welcome');
});
Route::get('/coba', function () {
    return view('coba');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



require __DIR__.'/auth.php';
