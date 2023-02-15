<?php

Route::get('/medication-administration', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'index'])->name('medication_administrations');
Route::get('/medication-administration/form/{IdMedicationAdministrations?}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'show'])->name('medication_administrations.form');
Route::post('/medication-administration/create', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'store'])->name('medication_administrations.form.create');
Route::post('/medication-administration/update/{IdMedicationAdministrations}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'update'])->name('medication_administrations.form.update');
Route::post('/medication-administration/delete/{IdMedicationAdministrations}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'destroy'])->name('medication_administrations.form.delete');
Route::get('/medication-administration/query-json', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'query_json'])->name('medication_administration.json');

Route::get('/medication-administration/option', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'option'])->name('medication_administrations.option');
Route::get('/medication-administration/form-modal/{IdMedicationAdministrations?}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'show_modal'])->name('medication_administrations.form_modal');
Route::post('/medication-administration/create-modal', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'store_modal'])->name('medication_administrations.form.create_modal');