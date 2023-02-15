<?php

Route::get('/protocols', [App\Http\Controllers\Admin\ProtocolsController::class, 'index'])->name('protocols');
Route::get('/protocols/form/{IdProtocols?}', [App\Http\Controllers\Admin\ProtocolsController::class, 'show'])->name('protocols.form');
Route::post('/protocols/create', [App\Http\Controllers\Admin\ProtocolsController::class, 'store'])->name('protocols.form.create');
Route::post('/protocols/update/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsController::class, 'update'])->name('protocols.form.update');
Route::post('/protocols/delete/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsController::class, 'destroy'])->name('protocols.form.delete');