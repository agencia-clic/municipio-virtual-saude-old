<?php

Route::get('/inpatients', [App\Http\Controllers\Admin\InpatientsController::class, 'index'])->name('inpatients');
Route::get('/observation', [App\Http\Controllers\Admin\InpatientsController::class, 'observation'])->name('observation');
Route::get('/revaluation', [App\Http\Controllers\Admin\InpatientsController::class, 'revaluation'])->name('revaluation');