<?php

Route::get('/users-service-units/{IdUsers}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'index'])->name('users_service_units');
Route::get('/users-service-units/form/{IdUsers}/{IdUsersServiceUnits?}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'show'])->name('users_service_units.form');
Route::post('/users-service-units/create/{IdUsers}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'store'])->name('users_service_units.form.create');
Route::post('/users-service-units/update/{IdUsers}/{IdUsersServiceUnits}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'update'])->name('users_service_units.form.update');
Route::post('/users-service-units/delete/{IdUsersServiceUnits}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'destroy'])->name('users_service_units.form.delete');