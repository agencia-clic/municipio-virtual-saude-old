<?php

Route::get('/users-diseases/{IdUsers?}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'index'])->name('users_diseases');
Route::post('/users-diseases/query-json/{IdUsers}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'query_json'])->name('users_diseases.query.json');
Route::get('/users-diseases/form/{IdUsers?}/{IdUsersDiseases?}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'show'])->name('users_diseases.form');
Route::post('/users-diseases/create/{IdUsers?}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'store'])->name('users_diseases.form.create');
Route::post('/users-diseases/update/{IdUsers?}/{IdUsersDiseases}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'update'])->name('users_diseases.form.update');
Route::post('/users-diseases/delete/{IdUsersDiseases}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'destroy'])->name('users_diseases.form.delete');