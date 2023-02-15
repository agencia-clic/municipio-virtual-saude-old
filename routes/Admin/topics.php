<?php

Route::get('/topics', [App\Http\Controllers\Admin\TopicsController::class, 'index'])->name('topics');
Route::get('/topics/form/{IdTopics?}', [App\Http\Controllers\Admin\TopicsController::class, 'show'])->name('topics.form');
Route::get('/topics/query', [App\Http\Controllers\Admin\TopicsController::class, 'query'])->name('topics.form.query');
Route::post('/topics/create', [App\Http\Controllers\Admin\TopicsController::class, 'store'])->name('topics.form.create');
Route::post('/topics/update/{IdTopics}', [App\Http\Controllers\Admin\TopicsController::class, 'update'])->name('topics.form.update');
Route::post('/topics/delete/{IdTopics}', [App\Http\Controllers\Admin\TopicsController::class, 'destroy'])->name('topics.form.delete');