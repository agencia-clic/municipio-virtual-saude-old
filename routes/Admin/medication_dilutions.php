<?php

Route::get('/medication-dilutions', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'index'])->name('medication_dilutions');
Route::get('/medication-dilutions/form/{IdMedicationDilutions?}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'show'])->name('medication_dilutions.form');
Route::post('/medication-dilutions/create', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'store'])->name('medication_dilutions.form.create');
Route::post('/medication-dilutions/update/{IdMedicationDilutions}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'update'])->name('medication_dilutions.form.update');
Route::post('/medication-dilutions/delete/{IdMedicationDilutions}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'destroy'])->name('medication_dilutions.form.delete');

Route::get('/medication-dilutions/option', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'option'])->name('medication_dilutions.option');
Route::get('/medication-dilutions/form-modal/{IdMedicationDilutions?}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'show_modal'])->name('medication_dilutions.form_modal');
Route::post('/medication-dilutions/create-modal', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'store_modal'])->name('medication_dilutions.form.create_modal');