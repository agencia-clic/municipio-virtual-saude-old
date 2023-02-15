<?php

Route::get('/service-units-forwarding/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'index'])->name('service_units_forwarding');
Route::get('/service-units-forwarding/form/{IdServiceUnits}/{IdServiceUnitsForwarding?}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'show'])->name('service_units_forwarding.form');
Route::post('/service-units-forwarding/create/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'store'])->name('service_units_forwarding.form.create');
Route::post('/service-units-forwarding/delete/{IdServiceUnitsForwarding}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'destroy'])->name('service_units_forwarding.form.delete');