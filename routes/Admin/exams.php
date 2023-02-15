<?php

Route::get('/exams', [App\Http\Controllers\Admin\ExamsController::class, 'index'])->name('exams');
Route::get('/exams/form/{IdExams?}', [App\Http\Controllers\Admin\ExamsController::class, 'show'])->name('exams.form');
Route::get('/exams/list/json', [App\Http\Controllers\Admin\ExamsController::class, 'list_exams_json'])->name('exams.list.json');
Route::post('/exams/create', [App\Http\Controllers\Admin\ExamsController::class, 'store'])->name('exams.form.create');
Route::post('/exams/update/{IdExams}', [App\Http\Controllers\Admin\ExamsController::class, 'update'])->name('exams.form.update');
Route::post('/exams/delete/{IdExams}', [App\Http\Controllers\Admin\ExamsController::class, 'destroy'])->name('exams.form.delete');