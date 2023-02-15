<?php

Route::get('/emergency-services-files/{IdEmergencyServices?}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'index'])->name('emergency_services_files');
Route::get('/emergency-services-files/form/{IdEmergencyServices?}/{IdEmergencyServicesFiles?}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'show'])->name('emergency_services_files.form');
Route::post('/emergency-services-files/create/{IdEmergencyServices?}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'store'])->name('emergency_services_files.form.create');
Route::post('/emergency-services-files/update/{IdEmergencyServices?}/{IdEmergencyServicesFiles}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'update'])->name('emergency_services_files.form.update');
Route::post('/emergency-services-files/delete/{IdEmergencyServicesFiles}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'destroy'])->name('emergency_services_files.form.delete');