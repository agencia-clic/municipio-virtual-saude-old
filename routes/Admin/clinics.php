<?php

Route::get('/clinics', [App\Http\Controllers\Admin\ClinicsController::class, 'index'])->name('clinics');
Route::get('/clinics/form/{IdClinics?}', [App\Http\Controllers\Admin\ClinicsController::class, 'show'])->name('clinics.form');
Route::get('/clinics/query-json', [App\Http\Controllers\Admin\ClinicsController::class, 'query_json'])->name('clinics.json');
Route::post('/clinics/create', [App\Http\Controllers\Admin\ClinicsController::class, 'store'])->name('clinics.form.create');
Route::post('/clinics/update/{IdClinics}', [App\Http\Controllers\Admin\ClinicsController::class, 'update'])->name('clinics.form.update');
Route::post('/clinics/delete/{IdClinics}', [App\Http\Controllers\Admin\ClinicsController::class, 'destroy'])->name('clinics.form.delete');