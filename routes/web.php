<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

require_once('Admin/index.php');

// users
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

// users diseases
Route::get('/users-diseases/{IdUsers?}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'index'])->name('users_diseases');
Route::post('/users-diseases/query-json/{IdUsers}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'query_json'])->name('users_diseases.query.json');
Route::get('/users-diseases/form/{IdUsers?}/{IdUsersDiseases?}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'show'])->name('users_diseases.form');
Route::post('/users-diseases/create/{IdUsers?}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'store'])->name('users_diseases.form.create');
Route::post('/users-diseases/update/{IdUsers?}/{IdUsersDiseases}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'update'])->name('users_diseases.form.update');
Route::post('/users-diseases/delete/{IdUsersDiseases}', [App\Http\Controllers\Admin\UsersDiseasesController::class, 'destroy'])->name('users_diseases.form.delete');

// users medical specialties
Route::get('/users-medical-specialties/{IdUsers}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'index'])->name('users_medical_specialties');
Route::get('/users-medical-specialties/form/{IdUsers}/{IdUsersMedicalSpecialties?}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'show'])->name('users_medical_specialties.form');
Route::post('/users-medical-specialties/create/{IdUsers}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'store'])->name('users_medical_specialties.form.create');
Route::post('/users-medical-specialties/update/{IdUsers}/{IdUsersMedicalSpecialties}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'update'])->name('users_medical_specialties.form.update');
Route::post('/users-medical-specialties/delete/{IdUsersMedicalSpecialties}', [App\Http\Controllers\Admin\UsersMedicalSpecialtiesController::class, 'destroy'])->name('users_medical_specialties.form.delete');

// users patients
Route::get('/users-patients/list', [App\Http\Controllers\Admin\UsersPatientsController::class, 'index'])->name('users_patients.list');
Route::get('/users-patients', [App\Http\Controllers\Admin\UsersPatientsController::class, 'show'])->name('users_patients');
Route::get('/users-patients/form/{IdUsers?}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'show'])->name('users_patients.form');
Route::post('/users-patients/create', [App\Http\Controllers\Admin\UsersPatientsController::class, 'store'])->name('users_patients.form.create');
Route::post('/users-patients/update/{IdUsers}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'update'])->name('users_patients.form.update');
Route::get('/users-patients/merger/{IdUsers}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'merger'])->name('users_patients.merger');
Route::post('/users-patients/create/merger/{IdUsers}', [App\Http\Controllers\Admin\UsersPatientsController::class, 'merger_create'])->name('users_patients.merger.create');

// users service units
Route::get('/users-service-units/{IdUsers}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'index'])->name('users_service_units');
Route::get('/users-service-units/form/{IdUsers}/{IdUsersServiceUnits?}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'show'])->name('users_service_units.form');
Route::post('/users-service-units/create/{IdUsers}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'store'])->name('users_service_units.form.create');
Route::post('/users-service-units/update/{IdUsers}/{IdUsersServiceUnits}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'update'])->name('users_service_units.form.update');
Route::post('/users-service-units/delete/{IdUsersServiceUnits}', [App\Http\Controllers\Admin\UsersServiceUnitsController::class, 'destroy'])->name('users_service_units.form.delete');

// service units forwarding
Route::get('/service-units-forwarding/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'index'])->name('service_units_forwarding');
Route::get('/service-units-forwarding/form/{IdServiceUnits}/{IdServiceUnitsForwarding?}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'show'])->name('service_units_forwarding.form');
Route::post('/service-units-forwarding/create/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'store'])->name('service_units_forwarding.form.create');
Route::post('/service-units-forwarding/delete/{IdServiceUnitsForwarding}', [App\Http\Controllers\Admin\ServiceUnitsForwardingController::class, 'destroy'])->name('service_units_forwarding.form.delete');