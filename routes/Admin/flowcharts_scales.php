<?php

Route::get('/flowcharts-scales', [App\Http\Controllers\Admin\FlowchartsScalesController::class, 'index'])->name('flowcharts-scales');
Route::get('/flowcharts-scales/itens', [App\Http\Controllers\Admin\FlowchartsScalesController::class, 'flowcharts_itens'])->name('flowcharts-scales-itens');
Route::post('/flowcharts-scales/create', [App\Http\Controllers\Admin\FlowchartsScalesController::class, 'save_flowcharts_itens'])->name('flowcharts.scales.create');