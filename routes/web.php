<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\QuizeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::name('user.')->group(function () {
    Route::get('/user/edit', [UserController::class, 'edit'])->name('edit');
    Route::get('/user/{user}', [UserController::class, 'show'])->name('show');
    Route::post('/user/update', [UserController::class, 'update'])->name('update');
});

Route::name('category.')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('index');
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('show');
});

Route::name('like.')->group(function () {
    Route::get('/favorite', [LikeController::class, 'favoriteIndex'])->name('favoriteIndex');
    Route::post('/favorite/{group_id}/{user_id}', [LikeController::class, 'toggleFavorite']);
    Route::post('/good/{group_id}/{user_id}', [LikeController::class, 'toggleGood']);
});

Route::name('quize_group.')->group(function () {
    Route::get('/quize_group/create', [QuizeController::class, 'create'])->name('create');
    Route::post('/quize_group/store', [QuizeController::class, 'store'])->name('store');
    Route::get('/quize_group/{group}', [QuizeController::class, 'show'])->name('show');
    Route::get('/quize_group/{group}/result', [QuizeController::class, 'result'])->name('result');
    Route::get('/quize_group/{group}/{quize}', [QuizeController::class, 'showQuize'])->name('showQuize');
});



require __DIR__ . '/auth.php';
