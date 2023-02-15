<?php

Route::get('/screenings', [App\Http\Controllers\Admin\ScreeningsController::class, 'index'])->name('screenings');
Route::post('/screenings/table', [App\Http\Controllers\Admin\ScreeningsController::class, 'table'])->name('screenings.table');
Route::get('/screenings/welcome/{IdEmergencyServices}', [App\Http\Controllers\Admin\ScreeningsController::class, 'welcome'])->name('screenings.welcome');
Route::get('/screenings/form/{IdEmergencyServices}/{IdScreenings?}', [App\Http\Controllers\Admin\ScreeningsController::class, 'show'])->name('screenings.form');
Route::post('/screenings/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\ScreeningsController::class, 'store'])->name('screenings.form.create');
Route::post('/screenings/update/{IdEmergencyServices}/{IdScreenings}', [App\Http\Controllers\Admin\ScreeningsController::class, 'update'])->name('screenings.form.update');
Route::post('/screenings/delete/{IdEmergencyServices}/{IdScreenings}', [App\Http\Controllers\Admin\ScreeningsController::class, 'destroy'])->name('screenings.form.delete');