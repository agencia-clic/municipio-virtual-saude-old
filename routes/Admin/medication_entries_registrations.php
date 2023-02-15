<?php

Route::get('/medication-entries-registrations/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'index'])->name('medication_entries_registrations');
Route::get('/medication-entries-registrations/form/{IdMedicationEntries}/{IdMedicationEntriesRegistrations?}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'show'])->name('medication_entries_registrations.form');
Route::post('/medication-entries-registrations/create/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'store'])->name('medication_entries_registrations.form.create');
Route::post('/medication-entries-registrations/update/{IdMedicationEntries}/{IdMedicationEntriesRegistrations}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'update'])->name('medication_entries_registrations.form.update');
Route::post('/medication-entries-registrations/delete/{IdMedicationEntries}/{IdMedicationEntriesRegistrations}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'destroy'])->name('medication_entries_registrations.form.delete');