<?php

Route::get('/accommodations', [App\Http\Controllers\Admin\AccommodationsController::class, 'index'])->name('accommodations');
Route::get('/accommodations/form/{IdAccommodations?}', [App\Http\Controllers\Admin\AccommodationsController::class, 'show'])->name('accommodations.form');
Route::get('/accommodations/query-json', [App\Http\Controllers\Admin\AccommodationsController::class, 'query_json'])->name('accommodations.json');
Route::post('/accommodations/create', [App\Http\Controllers\Admin\AccommodationsController::class, 'store'])->name('accommodations.form.create');
Route::post('/accommodations/update/{IdAccommodations}', [App\Http\Controllers\Admin\AccommodationsController::class, 'update'])->name('accommodations.form.update');
Route::post('/accommodations/delete/{IdAccommodations}', [App\Http\Controllers\Admin\AccommodationsController::class, 'destroy'])->name('accommodations.form.delete');