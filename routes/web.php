<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\QuizeController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::name('category.')->group(function () {
    Route::get('/category', [CategoryController::class, 'index'])->name('index');
    Route::get('/category/{category}', [CategoryController::class, 'show'])->name('show');
});

Route::name('like')->group(function () {
    Route::post('/favorite/{group_id}/{user_id}', [LikeController::class, 'toggleFavorite']);
    Route::post('/good/{group_id}/{user_id}', [LikeController::class, 'toggleGood']);
});

Route::name('quize_group.')->group(function () {
    Route::get('/quize_group/{group}', [QuizeController::class, 'show'])->name('show');
    Route::get('/quize_group/{group}/result', [QuizeController::class, 'result'])->name('result');
    Route::get('/quize_group/{group}/{quize}', [QuizeController::class, 'showQuize'])->name('showQuize');
});


require __DIR__ . '/auth.php';
