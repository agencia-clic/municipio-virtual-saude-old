<?php

Route::get('/medicines', [App\Http\Controllers\Admin\MedicinesController::class, 'index'])->name('medicines');
Route::get('/medicines/form/{IdMedicines?}', [App\Http\Controllers\Admin\MedicinesController::class, 'show'])->name('medicines.form');
Route::post('/medicines/create', [App\Http\Controllers\Admin\MedicinesController::class, 'store'])->name('medicines.form.create');
Route::post('/medicines/update/{IdMedicines}', [App\Http\Controllers\Admin\MedicinesController::class, 'update'])->name('medicines.form.update');
Route::post('/medicines/delete/{IdMedicines}', [App\Http\Controllers\Admin\MedicinesController::class, 'destroy'])->name('medicines.form.delete');
Route::post('/medicines/query-json', [App\Http\Controllers\Admin\MedicinesController::class, 'query_json'])->name('medicines.query.json');
Route::post('/medicines/selected/{IdUsers}', [App\Http\Controllers\Admin\MedicinesController::class, 'selected'])->name('medicines.selected');