<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\QuizeController;
use App\Http\Controllers\QuizeGroupController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::name('user.')->group(function () {
    Route::middleware('auth')->get('/user/edit', [UserController::class, 'edit'])->name('edit');
    Route::get('/user/{user}', [UserController::class, 'show'])->name('show');
    Route::middleware('auth')->post('/user/update', [UserController::class, 'update'])->name('update');
});

Route::name('category.')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('index');
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('show');
});

Route::name('like.')->group(function () {
    Route::get('/favorite', [LikeController::class, 'favoriteIndex'])->name('favoriteIndex');
    Route::middleware('auth')->post('/favorite/{group_id}/{user_id}', [LikeController::class, 'toggleFavorite']);
    Route::middleware('auth')->post('/good/{group_id}/{user_id}', [LikeController::class, 'toggleGood']);
});

Route::name('quize_group.')->group(function () {
    Route::get('/quize_group/menu', [QuizeGroupController::class, 'menu'])->name('menu');
    Route::middleware('auth')->get('/quize_group/create', [QuizeGroupController::class, 'create'])->name('create');
    Route::middleware('auth')->post('/quize_group/store', [QuizeGroupController::class, 'store'])->name('store');
    Route::middleware('auth')->get('/quize_group/edit_list', [QuizeGroupController::class, 'editList'])->name('edit_list');
    Route::middleware('auth')->get('/quize_group/edit/{quize_group}', [QuizeGroupController::class, 'edit'])->name('edit');
    Route::middleware('auth')->post('/quize_group/edit/update/{quize_group}', [QuizeGroupController::class, 'update'])->name('update');
    Route::get('/quize_group/{group}', [QuizeGroupController::class, 'show'])->name('show');
    Route::get('/quize_group/{group}/result', [QuizeGroupController::class, 'result'])->name('result');
});

Route::name('quize.')->group(function () {
    Route::middleware('auth')->get('/quize/create/{quize_group}', [QuizeController::class, 'create'])->name('create');
    Route::middleware('auth')->post('/quize/store', [QuizeController::class, 'store'])->name('store');
    Route::middleware('auth')->get('/quize/edit/{quize_group}', [QuizeController::class, 'edit'])->name('edit');
    Route::middleware('auth')->post('/quize/update', [QuizeController::class, 'update'])->name('update');
    Route::get('/quize/{group}/{quize}', [QuizeController::class, 'show'])->name('show');
});


require __DIR__ . '/auth.php';
