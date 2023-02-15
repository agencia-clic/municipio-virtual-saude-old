<?php
Route::get('/emergency-services-procedures/list/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'index'])->name('emergency_services_procedures');
Route::get('/emergency-services-procedures/table-list/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'table'])->name('emergency_services_procedures.table');
Route::post('/emergency-services-procedures/create/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'store'])->name('emergency_services_procedures.form.create');
Route::post('/emergency-services-procedures/update/{IdEmergencyServices}/{IdEmergencyServicesProcedures}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'update_data'])->name('emergency_services_procedures.data.update');
Route::post('/emergency-services-procedures/delete/{IdEmergencyServicesProcedures}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'destroy'])->name('emergency_services_procedures.form.delete');

Route::get('/emergency-services-procedures/run/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'run'])->name('emergency_services_procedures.run');
Route::get('/emergency-services-procedures/table-run/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'table_run'])->name('emergency_services_procedures.table.run');
Route::get('/emergency-services-procedures/table-run-form/{IdEmergencyServicesProcedures}/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'table_form'])->name('emergency_services_procedures.form.run');

Route::post('/emergency-services-procedures/save-run/{IdEmergencyServicesProcedures}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'run_save'])->name('emergency_services_procedures.save.run');

Route::get('/emergency-services-procedures/run-list', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'run_list'])->name('emergency_services_procedures.list.run');
Route::get('/emergency-services-procedures/export/{IdEmergencyServices}/{IdProceduresGroups}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'export_procedures'])->name('emergency_services_procedures.export');