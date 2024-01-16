<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('', [DashboardController::class, 'index'])->name('dashboard');

//Route::resource('ideas', IdeaController::class)->except(['index','create','show'])->middleware('auth');
//Route::resource('ideas', IdeaController::class)->except(['show']);


// Route::resource('idea', CommentController::class)->only('store')->middleware('auth');


Route::resource('users', UserController::class)->only('show', 'edit', 'update')->middleware('auth');

Route::get('profile',[UserController::class,'profile'])->middleware('auth')->name('profile');


Route::group(['prefix' => 'ideas/', 'as' => 'idea.'], function () {

    Route::get('/{idea}', [IdeaController::class, 'show'])->name('show');

    Route::group(['middleware' => ['auth']], function () {

        Route::post('', [IdeaController::class, 'store'])->name('store');

        Route::get('{idea}/edit', [IdeaController::class, 'edit'])
            ->name('edit');

        Route::put('{idea}', [IdeaController::class, 'update'])
            ->name('update');
        Route::delete('/{id}', [IdeaController::class, 'destroy'])
            ->name('destroy');




        });



});




    Route::post('/idea/{idea}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/{idea}/comments/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
    Route::get('/{idea}/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/{idea}/comments/{comment}', [CommentController::class, 'update'])->name('comment.update');


// Route::resource('ideas',IdeaController::class)->exept(['index','create','show'])->middleware('auth');
// Route::resource('ideas',IdeaController::class)->only(['show']);



Route::get('/terms', function () {
    return view('terms');
});
