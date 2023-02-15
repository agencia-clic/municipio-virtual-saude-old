<?php

Route::get('/medication-active-principles', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'index'])->name('medication_active_principles');
Route::get('/medication-active-principles/form/{IdMedicationActivePrinciples?}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'show'])->name('medication_active_principles.form');
Route::get('/medication-active-principles/query-json', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'query_json'])->name('medication_active_principles.json');
Route::post('/medication-active-principles/create', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'store'])->name('medication_active_principles.form.create');
Route::post('/medication-active-principles/update/{IdMedicationActivePrinciples}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'update'])->name('medication_active_principles.form.update');
Route::post('/medication-active-principles/delete/{IdMedicationActivePrinciples}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'destroy'])->name('medication_active_principles.form.delete');

Route::get('/medication-active-principles/option', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'option'])->name('medication_active_principles.option');
Route::get('/medication-active-principles/form-modal/{IdMedicationActivePrinciples?}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'show_modal'])->name('medication_active_principles.form_modal');
Route::post('/medication-active-principles/create-modal', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'store_modal'])->name('medication_active_principles.form.create_modal');