<?php

Route::get('/emergency-services-materials/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'index'])->name('emergency_services_materials');
Route::get('/emergency-services-materials/form/{IdEmergencyServices}/{IdEmergencyServicesMaterials?}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'show'])->name('emergency_services_materials.form');
Route::post('/emergency-services-materials/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'store'])->name('emergency_services_materials.form.create');
Route::post('/emergency-services-materials/update/{IdEmergencyServices}/{IdEmergencyServicesMaterials}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'update'])->name('emergency_services_materials.form.update');
Route::post('/emergency-services-materials/delete/{IdEmergencyServicesMaterials}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'destroy'])->name('emergency_services_materials.form.delete');