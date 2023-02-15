<?php

Route::get('/central-beds', [App\Http\Controllers\Admin\CentralBedsController::class, 'index'])->name('central_beds');
Route::get('/central-beds/table', [App\Http\Controllers\Admin\CentralBedsController::class, 'table'])->name('central_beds.table');

Route::get('/central-beds/interning-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'interning'])->name('central_beds.interning');
Route::post('/central-beds/interning-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'interning_store'])->name('central_beds.interning.create');

Route::get('/central-beds/cleaning-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'cleaning'])->name('central_beds.cleaning');
Route::post('/central-beds/cleaning-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'cleaning_store'])->name('central_beds.cleaning.create');
Route::post('/central-beds/cleaning-finish/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'cleaning_finish'])->name('central_beds.cleaning.finish');

Route::post('/central-beds/block-store/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'block_store'])->name('central_beds.block');

Route::get('/central-beds/transfer-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer'])->name('central_beds.transfer');
Route::post('/central-beds/transfer-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer_store'])->name('central_beds.transfer.create');

Route::get('/central-beds/transfer-beds-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer_beds'])->name('central_beds.transfer.beds');
Route::post('/central-beds/transfer-beds-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer_store_beds'])->name('central_beds.transfer.beds.create');