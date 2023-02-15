<?php

Route::get('/rooms-beds/{IdRooms}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'index'])->name('rooms_beds');
Route::get('/rooms-beds/form/{IdRooms}/{IdRoomsBeds?}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'show'])->name('rooms_beds.form');
Route::post('/rooms-beds/create/{IdRooms}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'store'])->name('rooms_beds.form.create');
Route::post('/rooms-beds/update/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'update'])->name('rooms_beds.form.update');
Route::post('/rooms-beds/delete/{IdRoomsBeds}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'destroy'])->name('rooms_beds.form.delete');
Route::post('/rooms-beds/query-json', [App\Http\Controllers\Admin\RoomsBedsController::class, 'query_json'])->name('rooms_beds.query.json');