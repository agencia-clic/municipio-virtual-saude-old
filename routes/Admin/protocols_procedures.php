<?php
Route::get('/protocols-procedures/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsProceduresController::class, 'index'])->name('protocols_procedures');
Route::get('/protocols-procedures/form/{IdProtocols}/{IdProtocolsProcedures?}', [App\Http\Controllers\Admin\ProtocolsProceduresController::class, 'show'])->name('protocols_procedures.form');
Route::post('/protocols-procedures/create/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsProceduresController::class, 'store'])->name('protocols_procedures.form.create');
Route::post('/protocols-procedures/update/{IdProtocols}/{IdProtocolsProcedures}', [App\Http\Controllers\Admin\ProtocolsProceduresController::class, 'update'])->name('protocols_procedures.form.update');
Route::post('/protocols-procedures/delete/{IdProtocolsProcedures}', [App\Http\Controllers\Admin\ProtocolsProceduresController::class, 'destroy'])->name('protocols_procedures.form.delete');