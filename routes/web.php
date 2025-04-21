<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::get('/', function () {
    return view('welcome');
});



Route::get('/createblog', function () {
    return view('createblog');
})->middleware(['auth', 'verified'])->name('createblog');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

  // Add the post route inside the auth group
  Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
  Route::get('/dashboard', [PostController::class, 'index'])->name('dashboard');
  Route::get('/dashboard/technology', [PostController::class, 'technology'])->name('technology');
  Route::get('/dashboard/business', [PostController::class, 'business'])->name('business');
  Route::get('/dashboard/lifestyle', [PostController::class, 'lifestyle'])->name('lifestyle');

  /* Comments */
  Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
  Route::get('/dashboard/{post}/comments', [PostController::class, 'showComments'])
  ->name('posts.comments');
  Route::get('/dashboard/{post}/comments/create', [PostController::class, 'showMainPost']);



  Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
  Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');



});

require __DIR__.'/auth.php';
