<?php

Route::get('/service-units', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'index'])->name('service_units');
Route::get('/service-units/form/{IdServiceUnits?}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'show'])->name('service_units.form');
Route::get('/service-units/existe/email', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'existe_email'])->name('service_units.existe.email');
Route::post('/service-units/create', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'store'])->name('service_units.form.create');
Route::post('/service-units/update/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'update'])->name('service_units.form.update');
Route::post('/service-units/delete/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'destroy'])->name('service_units.form.delete');
Route::get('/service-units/set/{IdServiceUnits?}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'set'])->name('service_units.set');