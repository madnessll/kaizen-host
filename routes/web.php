<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\ReplyController;



Route::get('/', [MainPageController::class, 'index'])->name('main_page');
Route::get('/forums/{forum}', [ForumController::class, 'show'])->name('forums.show');
Route::post('/forums', [ForumController::class, 'store'])->name('forums.store');
Route::delete('/forums/{forum}', [ForumController::class, 'destroy'])->name('forums.destroy');
Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');
Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');
Route::post('/forums/{forum}/topics', [TopicController::class, 'store'])->name('topics.store');


Route::middleware('auth')->group(function () {
    Route::post('/topics/{topic}/replies', [ReplyController::class, 'store'])->name('replies.store');
    Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])->name('replies.destroy');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
