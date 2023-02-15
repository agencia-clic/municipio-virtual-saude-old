<?php
Route::get('/medication-groups/{IdEmergencyServices}', [App\Http\Controllers\Admin\MedicationGroupsController::class, 'index'])->name('medication_groups');