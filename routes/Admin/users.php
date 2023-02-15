<?php

Route::get('/users', [App\Http\Controllers\Admin\UsersController::class, 'index'])->name('users');
Route::get('/users/form/{IdUsers?}', [App\Http\Controllers\Admin\UsersController::class, 'show'])->name('users.form');
Route::get('/users/existe/cpf-cnpj', [App\Http\Controllers\Admin\UsersController::class, 'existe_cpf'])->name('users.existe.cpf');
Route::get('/users/existe/email', [App\Http\Controllers\Admin\UsersController::class, 'existe_email'])->name('users.existe.email');
Route::post('/users/create', [App\Http\Controllers\Admin\UsersController::class, 'store'])->name('users.form.create');
Route::post('/users/update/{IdUsers}', [App\Http\Controllers\Admin\UsersController::class, 'update'])->name('users.form.update');
Route::post('/users/delete/{IdUsers}', [App\Http\Controllers\Admin\UsersController::class, 'destroy'])->name('users.form.delete');
Route::post('/users/query', [App\Http\Controllers\Admin\UsersController::class, 'query'])->name('users.form.query');
Route::post('/users/query-json', [App\Http\Controllers\Admin\UsersController::class, 'query_json'])->name('users.query.json');
Route::post('/users/query-json-responsavel', [App\Http\Controllers\Admin\UsersController::class, 'query_json_responsavel'])->name('users.query.responsavel.json');