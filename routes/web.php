<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizeGroupController;
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

Route::resource('quize_group', QuizeGroupController::class);


require __DIR__ . '/auth.php';
