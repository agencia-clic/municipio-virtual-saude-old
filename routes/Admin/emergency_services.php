<?php

Route::get('/emergency-services', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'index'])->name('emergency_services');
Route::post('/emergency-services/table', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'table'])->name('emergency_services.table');
Route::get('/emergency-services/form/{IdEmergencyServices?}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'show'])->name('emergency_services.form');
Route::post('/emergency-services/create', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'store'])->name('emergency_services.form.create');
Route::post('/emergency-services/update/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'update'])->name('emergency_services.form.update');
Route::post('/emergency-services/delete/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'destroy'])->name('emergency_services.form.delete');
Route::get('/emergency-services/historic/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'historic'])->name('emergency_services.historic');