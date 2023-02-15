<?php

Route::get('/classification-manchester/{IdEmergencyServices}', [App\Http\Controllers\Admin\ClassificationManchesterController::class, 'index'])->name('classification_manchester');
Route::get('/classification-manchester/form/{IdEmergencyServices}/{IdClassificationManchester?}', [App\Http\Controllers\Admin\ClassificationManchesterController::class, 'show'])->name('classification_manchester.form');
Route::post('/classification-manchester/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\ClassificationManchesterController::class, 'store'])->name('classification_manchester.form.create');
Route::post('/classification-manchester/update/{IdEmergencyServices}/{IdClassificationManchester}', [App\Http\Controllers\Admin\ClassificationManchesterController::class, 'update'])->name('classification_manchester.form.update');
Route::post('/classification-manchester/delete/{IdClassificationManchester}', [App\Http\Controllers\Admin\ClassificationManchesterController::class, 'destroy'])->name('classification_manchester.form.delete');