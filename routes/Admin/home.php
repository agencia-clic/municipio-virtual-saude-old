<?php
Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');