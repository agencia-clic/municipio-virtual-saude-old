<?php

Route::get('/specialty-categories', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'index'])->name('specialty_categories');
Route::get('/specialty-categories/form/{IdSpecialtyCategories?}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'show'])->name('specialty_categories.form');
Route::post('/specialty-categories/create', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'store'])->name('specialty_categories.form.create');
Route::post('/specialty-categories/update/{IdSpecialtyCategories}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'update'])->name('specialty_categories.form.update');
Route::post('/specialty-categories/delete/{IdSpecialtyCategories}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'destroy'])->name('specialty_categories.form.delete');
Route::get('/specialty-categories/query-json', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'query_json'])->name('specialty_categories.json');

Route::get('/specialty-categories/option', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'option'])->name('specialty_categories.option');
Route::get('/specialty-categories/form-modal/{IdSpecialtyCategories?}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'show_modal'])->name('specialty_categories.form_modal');
Route::post('/specialty-categories/create-modal', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'store_modal'])->name('specialty_categories.form.create_modal');