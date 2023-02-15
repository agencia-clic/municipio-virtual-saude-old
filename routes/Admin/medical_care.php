<?php

Route::get('/medical-care/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'index'])->name('medical_care');
Route::post('/medical-care/table/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'table'])->name('medical_care.table');
Route::post('/medical-care/watch/{IdEmergencyServices}/{IdMedicalCareLottery}', [App\Http\Controllers\Admin\MedicalCareController::class, 'watch'])->name('medical_care.watch');
Route::post('/medical-care/release/{IdEmergencyServices}/{IdMedicalCareLottery}', [App\Http\Controllers\Admin\MedicalCareController::class, 'release'])->name('medical_care.release');

Route::get('/medical-care/list_iframe/{IdEmergencyServices}', [App\Http\Controllers\Admin\MedicalCareController::class, 'list_iframe'])->name('medical_care.list_iframe');

Route::get('/medical-care/form/{IdFlowcharts}/{IdEmergencyServices}/{IdEmergencyServicesInternal}/{IdMedicalCare?}', [App\Http\Controllers\Admin\MedicalCareController::class, 'show'])->name('medical_care.form');

Route::get('/medical-care/form-iframe/{IdEmergencyServices}/{IdMedicalCare?}', [App\Http\Controllers\Admin\MedicalCareController::class, 'show_iframe'])->name('medical_care.form.iframe');
Route::post('/medical-care/create/{IdEmergencyServices}/{IdEmergencyServicesInternal}/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'store'])->name('medical_care.form.create');


Route::post('/medical-care/update/{IdEmergencyServices}/{IdMedicalCare}/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'update'])->name('medical_care.form.update');

Route::post('/medical-care/create-iframe/{IdEmergencyServices}', [App\Http\Controllers\Admin\MedicalCareController::class, 'store_iframe'])->name('medical_care.form.iframe.create');

Route::post('/medical-care/update-iframe/{IdEmergencyServices}/{IdMedicalCare}', [App\Http\Controllers\Admin\MedicalCareController::class, 'update_iframe'])->name('medical_care.update.iframe');
Route::post('/medical-care/delete/{IdEmergencyServices}/{IdMedicalCare}', [App\Http\Controllers\Admin\MedicalCareController::class, 'destroy'])->name('medical_care.form.delete');