<?php
Route::get('/emergency-services-medications/list/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'index'])->name('emergency_services_medications');
Route::get('/emergency-services-medications/table-list/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'table'])->name('emergency_services_medications.table');
Route::post('/emergency-services-medications/create/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'store'])->name('emergency_services_medications.form.create');
Route::post('/emergency-services-medications/update/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'update_data'])->name('emergency_services_medications.data.update');
Route::post('/emergency-services-medications/delete/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'destroy'])->name('emergency_services_medications.form.delete');

Route::get('/emergency-services-medications/update/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'update_check'])->name('emergency_services_medications.check.update');

Route::post('/emergency-services-medications/check-send-update/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_send_update'])->name('emergency_services_medications.check.send.update');


//check-in
Route::get('/emergency-services-medications/check-list/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_list'])->name('emergency_services_medications.list.check');
Route::get('/emergency-services-medications/check-run/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check'])->name('emergency_services_medications.check');
Route::get('/emergency-services-medications/check-form-table/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'table_ckeck'])->name('emergency_services_medications.table.check');

Route::get('/emergency-services-medications/check-admin/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_admin'])->name('emergency_services_medications.check.admin');


Route::post('/emergency-services-medications/save-check/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_save'])->name('emergency_services_medications.save.check');

Route::get('/emergency-services-medications/export/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'export_pdf'])->name('emergency_services_medications.export');
Route::get('/emergency-services-medications/history/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_history'])->name('emergency_services_medications.history');

Route::get('/emergency-services-medications/denied-medication/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'denied_medication_export'])->name('emergency_services_medications.denied.medication.export');