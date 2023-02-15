<?php

Route::get('/users-medical-specialties/{IdUsers}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'index'])->name('users_medical_specialties');
Route::get('/users-medical-specialties/form/{IdUsers}/{IdUsersMedicalSpecialties?}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'show'])->name('users_medical_specialties.form');
Route::post('/users-medical-specialties/create/{IdUsers}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'store'])->name('users_medical_specialties.form.create');
Route::post('/users-medical-specialties/update/{IdUsers}/{IdUsersMedicalSpecialties}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'update'])->name('users_medical_specialties.form.update');
Route::post('/users-medical-specialties/delete/{IdUsersMedicalSpecialties}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'destroy'])->name('users_medical_specialties.form.delete');