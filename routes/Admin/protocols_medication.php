<?php

Route::get('/protocols-medication/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'index'])->name('protocols_medication');
Route::get('/protocols-medication/form/{IdProtocols}/{IdProtocolsMedication?}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'show'])->name('protocols_medication.form');
Route::post('/protocols-medication/create/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'store'])->name('protocols_medication.form.create');
Route::post('/protocols-medication/update/{IdProtocols}/{IdProtocolsMedication}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'update'])->name('protocols_medication.form.update');
Route::post('/protocols-medication/delete/{IdProtocolsMedication}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'destroy'])->name('protocols_medication.form.delete');