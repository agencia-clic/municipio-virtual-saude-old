<?php

Route::get('/medication-prescription', [App\Http\Controllers\Admin\MedicationPrescriptionController::class, 'index'])->name('medication_prescription');
Route::get('/medication-prescription/create', [App\Http\Controllers\Admin\MedicationPrescriptionController::class, 'store'])->name('medication_prescription.save');