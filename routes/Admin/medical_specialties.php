<?php

Route::get('/medical-specialties', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'index'])->name('medical_specialties');
Route::get('/medical-specialties/form/{IdMedicalSpecialties?}', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'show'])->name('medical_specialties.form');
Route::post('/medical-specialties/create', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'store'])->name('medical_specialties.form.create');
Route::post('/medical-specialties/update/{IdMedicalSpecialties}', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'update'])->name('medical_specialties.form.update');
Route::post('/medical-specialties/delete/{IdMedicalSpecialties}', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'destroy'])->name('medical_specialties.form.delete');