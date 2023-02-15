<?php

Route::get('/materials', [App\Http\Controllers\Admin\MaterialsController::class, 'index'])->name('materials');
Route::get('/materials/form/{IdMaterials?}', [App\Http\Controllers\Admin\MaterialsController::class, 'show'])->name('materials.form');
Route::get('/materials/query-json', [App\Http\Controllers\Admin\MaterialsController::class, 'query_json'])->name('materials.json');
Route::post('/materials/create', [App\Http\Controllers\Admin\MaterialsController::class, 'store'])->name('materials.form.create');
Route::post('/materials/update/{IdMaterials}', [App\Http\Controllers\Admin\MaterialsController::class, 'update'])->name('materials.form.update');
Route::post('/materials/delete/{IdMaterials}', [App\Http\Controllers\Admin\MaterialsController::class, 'destroy'])->name('materials.form.delete');