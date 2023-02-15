<?php

Route::get('/rooms', [App\Http\Controllers\Admin\RoomsController::class, 'index'])->name('rooms');
Route::get('/rooms/form/{IdRooms?}', [App\Http\Controllers\Admin\RoomsController::class, 'show'])->name('rooms.form');
Route::post('/rooms/create', [App\Http\Controllers\Admin\RoomsController::class, 'store'])->name('rooms.form.create');
Route::post('/rooms/update/{IdRooms}', [App\Http\Controllers\Admin\RoomsController::class, 'update'])->name('rooms.form.update');
Route::post('/rooms/delete/{IdRooms}', [App\Http\Controllers\Admin\RoomsController::class, 'destroy'])->name('rooms.form.delete');
Route::post('/rooms/query-json', [App\Http\Controllers\Admin\RoomsController::class, 'query_json'])->name('rooms.query.json');