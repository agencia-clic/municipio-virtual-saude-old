<?php

Route::get('/topics-checks/{IdTopics}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'index'])->name('topics_checks');
Route::get('/topics-checks/form/{IdTopics}/{IdTopicsChecks?}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'show'])->name('topics_checks.form');
Route::post('/topics-checks/create/{IdTopics}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'store'])->name('topics_checks.form.create');
Route::post('/topics-checks/update/{IdTopics}/{IdTopicsChecks}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'update'])->name('topics_checks.form.update');
Route::post('/topics-checks/delete/{IdTopicsChecks}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'destroy'])->name('topics_checks.form.delete');