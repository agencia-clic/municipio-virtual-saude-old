<?php

Route::get('/emergency-services-forward/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'index'])->name('emergency_services_forward');
Route::get('/emergency-services-forward/form/{IdEmergencyServices}/{IdEmergencyServicesForward?}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'show'])->name('emergency_services_forward.form');
Route::post('/emergency-services-forward/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'store'])->name('emergency_services_forward.form.create');
Route::post('/emergency-services-forward/update/{IdEmergencyServices}/{IdEmergencyServicesForward}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'update'])->name('emergency_services_forward.form.update');
Route::post('/emergency-services-forward/delete/{IdEmergencyServicesForward}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'destroy'])->name('emergency_services_forward.form.delete');
Route::get('/emergency-services-forward/export/{IdEmergencyServices}/{IdEmergencyServicesForward?}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'export_pdf'])->name('emergency_services_forward.export');