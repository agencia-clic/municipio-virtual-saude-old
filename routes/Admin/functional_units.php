<?php

Route::get('/functional-units', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'index'])->name('functional_units');
Route::get('/functional-units/form/{IdFunctionalUnits?}', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'show'])->name('functional_units.form');
Route::get('/functional-units/query-json', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'query_json'])->name('functional_units.json');
Route::post('/accommofunctional-unitsdations/create', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'store'])->name('functional_units.form.create');
Route::post('/functional-units/update/{IdFunctionalUnits}', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'update'])->name('functional_units.form.update');
Route::post('/functional-units/delete/{IdFunctionalUnits}', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'destroy'])->name('functional_units.form.delete');