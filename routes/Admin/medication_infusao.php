<?php

Route::get('/medication-infusao', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'index'])->name('medication_infusao');
Route::get('/medication-infusao/form/{IdMedicationInfusao?}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'show'])->name('medication_infusao.form');
Route::post('/medication-infusao/create', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'store'])->name('medication_infusao.form.create');
Route::post('/medication-infusao/update/{IdMedicationInfusao}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'update'])->name('medication_infusao.form.update');
Route::post('/medication-infusao/delete/{IdMedicationInfusao}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'destroy'])->name('medication_infusao.form.delete');

Route::get('/medication-infusao/option', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'option'])->name('medication_infusao.option');
Route::get('/medication-infusao/form-modal/{IdMedicationInfusao?}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'show_modal'])->name('medication_infusao.form_modal');
Route::post('/medication-infusao/create-modal', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'store_modal'])->name('medication_infusao.form.create_modal');