<?php

Route::get('/call/screen', [App\Http\Controllers\Admin\CallController::class, 'screen'])->name('call.screen');
Route::post('/call/historic', [App\Http\Controllers\Admin\CallController::class, 'historic'])->name('call.historic');
Route::post('/call', [App\Http\Controllers\Admin\CallController::class, 'call_current'])->name('call');

Route::post('/call/save/{IdEmergencyServices}/{IdUsers}', [App\Http\Controllers\Admin\CallController::class, 'store'])->name('call.save');
Route::get('/call/save/{IdEmergencyServices}/{IdUsers}', [App\Http\Controllers\Admin\CallController::class, 'list'])->name('call.list');

