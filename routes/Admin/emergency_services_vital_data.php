<?php

Route::get('/emergency-services-vital-data/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'index'])->name('emergency_services_vital_data');
Route::get('/emergency-services-vital-data/form/{IdEmergencyServices}/{IdEmergencyServicesVitalData?}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'show'])->name('emergency_services_vital_data.form');
Route::post('/emergency-services-vital-data/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'store'])->name('emergency_services_vital_data.form.create');
Route::post('/emergency-services-vital-data/delete/{IdEmergencyServicesVitalData}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'destroy'])->name('emergency_services_vital_data.form.delete');
Route::get('/emergency-services-vital-data/export/{IdEmergencyServices}/{IdEmergencyServicesVitalData?}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'export_pdf'])->name('emergency_services_vital_data.export');