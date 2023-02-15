<?php

Route::get('/emergency-services-conducts/{type}/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'index'])->name('emergency_services_conducts');
Route::get('/emergency-services-conducts/form/internment/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'internment'])->name('emergency_services_conducts.internment');
Route::post('/emergency-services-conducts/form/{type}/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'store'])->name('emergency_services_conducts.create');
Route::post('/emergency-services-conducts/form/medical-opinion/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'medical_opinion_save'])->name('emergency_services_conducts.medical_opinion');
Route::get('/emergency-services-conducts/form/medication-option/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_pdf'])->name('emergency_services_conducts.medication.option.export');
Route::get('/emergency-services-conducts/medication-declaration-certificate/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_declaration_certificate'])->name('emergency_services_conducts.medication.declaration.certificate.export');

Route::get('/emergency-services-conducts/medication-certificate/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_certificate'])->name('emergency_services_conducts.medication.certificate.export');

Route::get('/emergency-services-conducts/medication-medical-report/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_medical_report'])->name('emergency_services_conducts.medication.medical.report.export');