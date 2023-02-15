<?php

Route::get('/cid10', [App\Http\Controllers\Admin\Cid10Controller::class, 'index'])->name('cid10')->middleware('roles:cid10');
Route::get('/cid10/form/{IdCid10?}', [App\Http\Controllers\Admin\Cid10Controller::class, 'show'])->name('cid10.form')->middleware('roles:cid10.create,cid10.update');
Route::post('/cid10/create', [App\Http\Controllers\Admin\Cid10Controller::class, 'store'])->name('cid10.form.create')->middleware('roles:cid10.create');
Route::get('/cid10/existe/code', [App\Http\Controllers\Admin\Cid10Controller::class, 'existe_code'])->name('cid10.existe.code');
Route::get('/cid10/list/json', [App\Http\Controllers\Admin\Cid10Controller::class, 'list_json'])->name('cid10.form.json');
Route::get('/cid10/query-json', [App\Http\Controllers\Admin\Cid10Controller::class, 'query_json'])->name('cid10.json');
Route::post('/cid10/update/{IdCid10}', [App\Http\Controllers\Admin\Cid10Controller::class, 'update'])->name('cid10.form.update')->middleware('roles:cid10.update');
Route::post('/cid10/delete/{IdCid10}', [App\Http\Controllers\Admin\Cid10Controller::class, 'destroy'])->name('cid10.form.delete')->middleware('roles:cid10.delete');