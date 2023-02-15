<?php

Route::get('/medication-types', [App\Http\Controllers\Admin\MedicationTypesController::class, 'index'])->name('medication_types');
Route::get('/medication-types/form/{IdMedicationTypes?}', [App\Http\Controllers\Admin\MedicationTypesController::class, 'show'])->name('medication_types.form');
Route::post('/medication-types/create', [App\Http\Controllers\Admin\MedicationTypesController::class, 'store'])->name('medication_types.form.create');
Route::post('/medication-types/update/{IdMedicationTypes}', [App\Http\Controllers\Admin\MedicationTypesController::class, 'update'])->name('medication_types.form.update');
Route::post('/medication-types/delete/{IdMedicationTypes}', [App\Http\Controllers\Admin\MedicationTypesController::class, 'destroy'])->name('medication_types.form.delete');