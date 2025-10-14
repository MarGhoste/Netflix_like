<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;

Route::view('/', 'welcome');

//Route::view('dashboard', 'dashboard')
    //->middleware(['auth', 'verified'])
    //->name('dashboard');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

use App\Http\Controllers\ActorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DirectorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\RatingController;


Route::middleware('auth')->group(function () {
    Route::resource('movies', MovieController::class);
    Route::resource('genres', GenreController::class);
    Route::resource('directors', DirectorController::class);
    Route::resource('actors', ActorController::class);
    Route::resource('ratings', RatingController::class);
    Route::resource('comments', CommentController::class);
});

require __DIR__.'/auth.php';
