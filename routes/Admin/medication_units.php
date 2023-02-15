<?php

Route::get('/medication-units', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'index'])->name('medication_units');
Route::get('/medication-units/form/{IdMedicationUnits?}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'show'])->name('medication_units.form');
Route::get('/medication-units/query-json', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'query_json'])->name('medication_units.json');
Route::post('/medication-units/create', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'store'])->name('medication_units.form.create');
Route::post('/medication-units/update/{IdMedicationUnits}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'update'])->name('medication_units.form.update');
Route::post('/medication-units/delete/{IdMedicationUnits}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'destroy'])->name('medication_units.form.delete');

Route::get('/medication-units/option', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'option'])->name('medication_units.option');
Route::get('/medication-units/form-modal/{IdMedicationUnits?}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'show_modal'])->name('medication_units.form_modal');
Route::post('/medication-units/create-modal', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'store_modal'])->name('medication_units.form.create_modal');