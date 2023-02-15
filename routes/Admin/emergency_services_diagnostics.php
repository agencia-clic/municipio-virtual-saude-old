<?php

Route::get('/emergency-services-diagnostics/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'index'])->name('emergency_services_diagnostics');
Route::get('/emergency-services-diagnostics/form/{IdEmergencyServices}/{IdEmergencyServicesDiagnostics?}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'show'])->name('emergency_services_diagnostics.form');
Route::post('/emergency-services-diagnostics/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'store'])->name('emergency_services_diagnostics.form.create');
Route::post('/emergency-services-diagnostics/update/{IdEmergencyServices}/{IdEmergencyServicesDiagnostics}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'update'])->name('emergency_services_diagnostics.form.update');
Route::post('/emergency-services-diagnostics/delete/{IdEmergencyServicesDiagnostics}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'destroy'])->name('emergency_services_diagnostics.form.delete');