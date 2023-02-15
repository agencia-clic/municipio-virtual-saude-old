<?php

Route::get('/flowcharts', [App\Http\Controllers\Admin\FlowchartsController::class, 'index'])->name('flowcharts');
Route::get('/flowcharts/form/{IdFlowcharts?}', [App\Http\Controllers\Admin\FlowchartsController::class, 'show'])->name('flowcharts.form');
Route::get('/flowcharts/query', [App\Http\Controllers\Admin\FlowchartsController::class, 'query'])->name('flowcharts.form.query');
Route::post('/flowcharts/create', [App\Http\Controllers\Admin\FlowchartsController::class, 'store'])->name('flowcharts.form.create');
Route::post('/flowcharts/update/{IdFlowcharts}', [App\Http\Controllers\Admin\FlowchartsController::class, 'update'])->name('flowcharts.form.update');
Route::post('/flowcharts/delete/{IdFlowcharts}', [App\Http\Controllers\Admin\FlowchartsController::class, 'destroy'])->name('flowcharts.form.delete');