<?php

Route::get('/call_panel', [App\Http\Controllers\Admin\CallPanelController::class, 'index'])->name('call_panel');
Route::get('/call_panel/json', [App\Http\Controllers\Admin\CallPanelController::class, 'json'])->name('call_panel.json');
Route::get('/call_panel/form/{IdCallPanel?}', [App\Http\Controllers\Admin\CallPanelController::class, 'show'])->name('call_panel.form');
Route::post('/call_panel/create', [App\Http\Controllers\Admin\CallPanelController::class, 'store'])->name('call_panel.form.create');
Route::post('/call_panel/update/{IdCallPanel}', [App\Http\Controllers\Admin\CallPanelController::class, 'update'])->name('call_panel.form.update');
Route::post('/call_panel/delete/{IdCallPanel}', [App\Http\Controllers\Admin\CallPanelController::class, 'destroy'])->name('call_panel.form.delete');