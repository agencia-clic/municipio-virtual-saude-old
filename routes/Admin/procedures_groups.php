<?php
Route::get('/procedures-groups/{IdEmergencyServices}', [App\Http\Controllers\Admin\ProceduresGroupsController::class, 'index'])->name('procedures_groups');