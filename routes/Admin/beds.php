<?php

Route::get('/beds', [App\Http\Controllers\Admin\BedsController::class, 'index'])->name('beds');
Route::get('/beds/form/{IdBeds?}', [App\Http\Controllers\Admin\BedsController::class, 'show'])->name('beds.form');
Route::get('/beds/query-json', [App\Http\Controllers\Admin\BedsController::class, 'query_json'])->name('beds.json');
Route::post('/beds/create', [App\Http\Controllers\Admin\BedsController::class, 'store'])->name('beds.form.create');
Route::post('/beds/update/{IdBeds}', [App\Http\Controllers\Admin\BedsController::class, 'update'])->name('beds.form.update');
Route::post('/beds/delete/{IdBeds}', [App\Http\Controllers\Admin\BedsController::class, 'destroy'])->name('beds.form.delete');