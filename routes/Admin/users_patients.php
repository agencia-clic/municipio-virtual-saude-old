<?php
Route::get('/users-patients/list', [App\Http\Controllers\Admin\UsersPatientsController::class, 'index'])->name('users_patients.list');
Route::get('/users-patients', [App\Http\Controllers\Admin\UsersPatientsController::class, 'show'])->name('users_patients');
Route::get('/users-patients/form/{IdUsers?}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'show'])->name('users_patients.form');
Route::post('/users-patients/create', [App\Http\Controllers\Admin\UsersPatientsController::class, 'store'])->name('users_patients.form.create');
Route::post('/users-patients/update/{IdUsers}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'update'])->name('users_patients.form.update');
Route::get('/users-patients/merger/{IdUsers}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'merger'])->name('users_patients.merger');
Route::post('/users-patients/create/merger/{IdUsers}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'merger_create'])->name('users_patients.merger.create');