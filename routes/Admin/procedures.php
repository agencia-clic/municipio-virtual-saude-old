<?php

Route::get('/procedures', [App\Http\Controllers\Admin\ProceduresController::class, 'index'])->name('procedures')->middleware('roles:procedures');
Route::get('/procedures/form/{IdProcedures?}', [App\Http\Controllers\Admin\ProceduresController::class, 'show'])->name('procedures.form')->middleware('roles:procedures.create,procedures.update');
Route::post('/procedures/create', [App\Http\Controllers\Admin\ProceduresController::class, 'store'])->name('procedures.form.create')->middleware('roles:procedures.create');
Route::get('/procedures/list/json', [App\Http\Controllers\Admin\ProceduresController::class, 'list_json'])->name('procedures.form.json');
Route::post('/procedures/update/{IdProcedures}', [App\Http\Controllers\Admin\ProceduresController::class, 'update'])->name('procedures.form.update')->middleware('roles:procedures.update');
Route::post('/procedures/delete/{IdProcedures}', [App\Http\Controllers\Admin\ProceduresController::class, 'destroy'])->name('procedures.form.delete')->middleware('roles:procedures.delete');
Route::get('/procedures/existe/code', [App\Http\Controllers\Admin\ProceduresController::class, 'existe_code'])->name('procedures.existe.code');