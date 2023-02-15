<?php

Route::get('/protocols-cid10/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'index'])->name('protocols_cid10');
Route::get('/protocols-cid10/form/{IdProtocols}/{IdProtocolsCid10?}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'show'])->name('protocols_cid10.form');
Route::post('/protocols-cid10/create/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'store'])->name('protocols_cid10.form.create');
Route::post('/protocols-cid10/update/{IdProtocols}/{IdProtocolsCid10}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'update'])->name('protocols_cid10.form.update');
Route::post('/protocols-cid10/delete/{IdProtocolsCid10}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'destroy'])->name('protocols_cid10.form.delete');