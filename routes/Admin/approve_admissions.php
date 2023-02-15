<?php

Route::get('/approve-admissions', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'index'])->name('approve_admissions');
Route::post('/approve-admissions/table', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'table'])->name('approve_admissions.table');
Route::post('/approve-admissions/approve-reprove/{IdAdmitPatientRequests}', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'approve_reprove'])->name('approve_admissions.approve');
Route::post('/approve-admissions/query-json', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'query_current'])->name('approve_admissions.json');
