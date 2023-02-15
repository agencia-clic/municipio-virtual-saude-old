<?php

Route::get('/medication-entries', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'index'])->name('medication_entries');
Route::get('/medication-entries/form/{IdMedicationEntries?}', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'show'])->name('medication_entries.form');
Route::post('/medication-entries/create', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'store'])->name('medication_entries.form.create');
Route::post('/medication-entries/update/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'update'])->name('medication_entries.form.update');
Route::post('/medication-entries/delete/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'destroy'])->name('medication_entries.form.delete');