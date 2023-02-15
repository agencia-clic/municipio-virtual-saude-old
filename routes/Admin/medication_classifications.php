<?php

Route::get('/medication-classifications', [App\Http\Controllers\Admin\MedicationClassificationsController::class, 'index'])->name('medication_classifications');
Route::get('/medication-classifications/form/{IdMedicationClassifications?}', [App\Http\Controllers\Admin\MedicationClassificationsController::class, 'show'])->name('medication_classifications.form');
Route::post('/medication-classifications/create', [App\Http\Controllers\Admin\MedicationClassificationsController::class, 'store'])->name('medication_classifications.form.create');
Route::post('/medication-classifications/update/{IdMedicationClassifications}', [App\Http\Controllers\Admin\MedicationClassificationsController::class, 'update'])->name('medication_classifications.form.update');
Route::post('/medication-classifications/delete/{IdMedicationClassifications}', [App\Http\Controllers\Admin\MedicationClassificationsController::class, 'destroy'])->name('medication_classifications.form.delete');