<?php

Route::get('query/city', [App\Http\Controllers\Admin\QueryController::class, 'city'])->name('query.city');