<?php

Route::get('/type-functional-units', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'index'])->name('type_functional_units');
Route::get('/type-functional-units/form/{IdTypeFunctionalUnits?}', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'show'])->name('type_functional_units.form');
Route::get('/type-functional-units/query-json', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'query_json'])->name('type_functional_units.json');
Route::post('/accommotype-functional-unitsdations/create', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'store'])->name('type_functional_units.form.create');
Route::post('/type-functional-units/update/{IdTypeFunctionalUnits}', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'update'])->name('type_functional_units.form.update');
Route::post('/type-functional-units/delete/{IdTypeFunctionalUnits}', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'destroy'])->name('type_functional_units.form.delete');