<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TareaController;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';

Route::middleware('auth')->group(function () {
    Route::resource('tareas', TareaController::class)
        ->only(['index', 'store', 'update', 'destroy']);
});