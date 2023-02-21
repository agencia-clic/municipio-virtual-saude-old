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

// accommodations
Route::get('/accommodations', [App\Http\Controllers\Admin\AccommodationsController::class, 'index'])->name('accommodations');
Route::get('/accommodations/form/{IdAccommodations?}', [App\Http\Controllers\Admin\AccommodationsController::class, 'show'])->name('accommodations.form');
Route::get('/accommodations/query-json', [App\Http\Controllers\Admin\AccommodationsController::class, 'query_json'])->name('accommodations.json');
Route::post('/accommodations/create', [App\Http\Controllers\Admin\AccommodationsController::class, 'store'])->name('accommodations.form.create');
Route::post('/accommodations/update/{IdAccommodations}', [App\Http\Controllers\Admin\AccommodationsController::class, 'update'])->name('accommodations.form.update');
Route::post('/accommodations/delete/{IdAccommodations}', [App\Http\Controllers\Admin\AccommodationsController::class, 'destroy'])->name('accommodations.form.delete');

//home
Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

//query
Route::get('query/city', [App\Http\Controllers\Admin\QueryController::class, 'city'])->name('query.city');

//service-units
Route::get('/service-units', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'index'])->name('service_units');
Route::get('/service-units/form/{IdServiceUnits?}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'show'])->name('service_units.form');
Route::get('/service-units/existe/email', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'existe_email'])->name('service_units.existe.email');
Route::post('/service-units/create', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'store'])->name('service_units.form.create');
Route::post('/service-units/update/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'update'])->name('service_units.form.update');
Route::post('/service-units/delete/{IdServiceUnits}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'destroy'])->name('service_units.form.delete');
Route::get('/service-units/set/{IdServiceUnits?}', [App\Http\Controllers\Admin\ServiceUnitsController::class, 'set'])->name('service_units.set');

//medication-administration
Route::get('/medication-administration', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'index'])->name('medication_administrations');
Route::get('/medication-administration/form/{IdMedicationAdministrations?}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'show'])->name('medication_administrations.form');
Route::post('/medication-administration/create', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'store'])->name('medication_administrations.form.create');
Route::post('/medication-administration/update/{IdMedicationAdministrations}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'update'])->name('medication_administrations.form.update');
Route::post('/medication-administration/delete/{IdMedicationAdministrations}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'destroy'])->name('medication_administrations.form.delete');
Route::get('/medication-administration/query-json', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'query_json'])->name('medication_administration.json');
Route::get('/medication-administration/option', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'option'])->name('medication_administrations.option');
Route::get('/medication-administration/form-modal/{IdMedicationAdministrations?}', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'show_modal'])->name('medication_administrations.form_modal');
Route::post('/medication-administration/create-modal', [App\Http\Controllers\Admin\MedicationAdministrationsController::class, 'store_modal'])->name('medication_administrations.form.create_modal');

//medication-units
Route::get('/medication-units', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'index'])->name('medication_units');
Route::get('/medication-units/form/{IdMedicationUnits?}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'show'])->name('medication_units.form');
Route::get('/medication-units/query-json', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'query_json'])->name('medication_units.json');
Route::post('/medication-units/create', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'store'])->name('medication_units.form.create');
Route::post('/medication-units/update/{IdMedicationUnits}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'update'])->name('medication_units.form.update');
Route::post('/medication-units/delete/{IdMedicationUnits}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'destroy'])->name('medication_units.form.delete');
Route::get('/medication-units/option', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'option'])->name('medication_units.option');
Route::get('/medication-units/form-modal/{IdMedicationUnits?}', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'show_modal'])->name('medication_units.form_modal');
Route::post('/medication-units/create-modal', [App\Http\Controllers\Admin\MedicationUnitsController::class, 'store_modal'])->name('medication_units.form.create_modal');

//medicines
Route::get('/medicines', [App\Http\Controllers\Admin\MedicinesController::class, 'index'])->name('medicines');
Route::get('/medicines/form/{IdMedicines?}', [App\Http\Controllers\Admin\MedicinesController::class, 'show'])->name('medicines.form');
Route::post('/medicines/create', [App\Http\Controllers\Admin\MedicinesController::class, 'store'])->name('medicines.form.create');
Route::post('/medicines/update/{IdMedicines}', [App\Http\Controllers\Admin\MedicinesController::class, 'update'])->name('medicines.form.update');
Route::post('/medicines/delete/{IdMedicines}', [App\Http\Controllers\Admin\MedicinesController::class, 'destroy'])->name('medicines.form.delete');
Route::post('/medicines/query-json', [App\Http\Controllers\Admin\MedicinesController::class, 'query_json'])->name('medicines.query.json');
Route::post('/medicines/selected/{IdUsers}', [App\Http\Controllers\Admin\MedicinesController::class, 'selected'])->name('medicines.selected');

//CID10
Route::get('/cid10', [App\Http\Controllers\Admin\Cid10Controller::class, 'index'])->name('cid10')->middleware('roles:cid10');
Route::get('/cid10/form/{IdCid10?}', [App\Http\Controllers\Admin\Cid10Controller::class, 'show'])->name('cid10.form')->middleware('roles:cid10.create,cid10.update');
Route::post('/cid10/create', [App\Http\Controllers\Admin\Cid10Controller::class, 'store'])->name('cid10.form.create')->middleware('roles:cid10.create');
Route::get('/cid10/existe/code', [App\Http\Controllers\Admin\Cid10Controller::class, 'existe_code'])->name('cid10.existe.code');
Route::get('/cid10/list/json', [App\Http\Controllers\Admin\Cid10Controller::class, 'list_json'])->name('cid10.form.json');
Route::get('/cid10/query-json', [App\Http\Controllers\Admin\Cid10Controller::class, 'query_json'])->name('cid10.json');
Route::post('/cid10/update/{IdCid10}', [App\Http\Controllers\Admin\Cid10Controller::class, 'update'])->name('cid10.form.update')->middleware('roles:cid10.update');
Route::post('/cid10/delete/{IdCid10}', [App\Http\Controllers\Admin\Cid10Controller::class, 'destroy'])->name('cid10.form.delete')->middleware('roles:cid10.delete');

//protocols
Route::get('/protocols', [App\Http\Controllers\Admin\ProtocolsController::class, 'index'])->name('protocols');
Route::get('/protocols/form/{IdProtocols?}', [App\Http\Controllers\Admin\ProtocolsController::class, 'show'])->name('protocols.form');
Route::post('/protocols/create', [App\Http\Controllers\Admin\ProtocolsController::class, 'store'])->name('protocols.form.create');
Route::post('/protocols/update/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsController::class, 'update'])->name('protocols.form.update');
Route::post('/protocols/delete/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsController::class, 'destroy'])->name('protocols.form.delete');

//protocols-CID10
Route::get('/protocols-cid10/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'index'])->name('protocols_cid10');
Route::get('/protocols-cid10/form/{IdProtocols}/{IdProtocolsCid10?}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'show'])->name('protocols_cid10.form');
Route::post('/protocols-cid10/create/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'store'])->name('protocols_cid10.form.create');
Route::post('/protocols-cid10/update/{IdProtocols}/{IdProtocolsCid10}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'update'])->name('protocols_cid10.form.update');
Route::post('/protocols-cid10/delete/{IdProtocolsCid10}', [App\Http\Controllers\Admin\ProtocolsCid10Controller::class, 'destroy'])->name('protocols_cid10.form.delete');

//protocols-Mediciation
Route::get('/protocols-medication/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'index'])->name('protocols_medication');
Route::get('/protocols-medication/form/{IdProtocols}/{IdProtocolsMedication?}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'show'])->name('protocols_medication.form');
Route::post('/protocols-medication/create/{IdProtocols}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'store'])->name('protocols_medication.form.create');
Route::post('/protocols-medication/update/{IdProtocols}/{IdProtocolsMedication}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'update'])->name('protocols_medication.form.update');
Route::post('/protocols-medication/delete/{IdProtocolsMedication}', [App\Http\Controllers\Admin\ProtocolsMedicationController::class, 'destroy'])->name('protocols_medication.form.delete');

//medical-specialties
Route::get('/medical-specialties', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'index'])->name('medical_specialties');
Route::get('/medical-specialties/form/{IdMedicalSpecialties?}', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'show'])->name('medical_specialties.form');
Route::post('/medical-specialties/create', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'store'])->name('medical_specialties.form.create');
Route::post('/medical-specialties/update/{IdMedicalSpecialties}', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'update'])->name('medical_specialties.form.update');
Route::post('/medical-specialties/delete/{IdMedicalSpecialties}', [App\Http\Controllers\Admin\MedicalSpecialtiesController::class, 'destroy'])->name('medical_specialties.form.delete');

//topics
Route::get('/topics', [App\Http\Controllers\Admin\TopicsController::class, 'index'])->name('topics');
Route::get('/topics/form/{IdTopics?}', [App\Http\Controllers\Admin\TopicsController::class, 'show'])->name('topics.form');
Route::get('/topics/query', [App\Http\Controllers\Admin\TopicsController::class, 'query'])->name('topics.form.query');
Route::post('/topics/create', [App\Http\Controllers\Admin\TopicsController::class, 'store'])->name('topics.form.create');
Route::post('/topics/update/{IdTopics}', [App\Http\Controllers\Admin\TopicsController::class, 'update'])->name('topics.form.update');
Route::post('/topics/delete/{IdTopics}', [App\Http\Controllers\Admin\TopicsController::class, 'destroy'])->name('topics.form.delete');

//topics-checks
Route::get('/topics-checks/{IdTopics}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'index'])->name('topics_checks');
Route::get('/topics-checks/form/{IdTopics}/{IdTopicsChecks?}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'show'])->name('topics_checks.form');
Route::post('/topics-checks/create/{IdTopics}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'store'])->name('topics_checks.form.create');
Route::post('/topics-checks/update/{IdTopics}/{IdTopicsChecks}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'update'])->name('topics_checks.form.update');
Route::post('/topics-checks/delete/{IdTopicsChecks}', [App\Http\Controllers\Admin\TopicsChecksController::class, 'destroy'])->name('topics_checks.form.delete');

//call
Route::get('/call/screen', [App\Http\Controllers\Admin\CallController::class, 'screen'])->name('call.screen');
Route::post('/call/historic', [App\Http\Controllers\Admin\CallController::class, 'historic'])->name('call.historic');
Route::post('/call', [App\Http\Controllers\Admin\CallController::class, 'call_current'])->name('call');
Route::post('/call/save/{IdEmergencyServices}/{IdUsers}', [App\Http\Controllers\Admin\CallController::class, 'store'])->name('call.save');
Route::get('/call/save/{IdEmergencyServices}/{IdUsers}', [App\Http\Controllers\Admin\CallController::class, 'list'])->name('call.list');

//procedures
Route::get('/procedures', [App\Http\Controllers\Admin\ProceduresController::class, 'index'])->name('procedures')->middleware('roles:procedures');
Route::get('/procedures/form/{IdProcedures?}', [App\Http\Controllers\Admin\ProceduresController::class, 'show'])->name('procedures.form')->middleware('roles:procedures.create,procedures.update');
Route::post('/procedures/create', [App\Http\Controllers\Admin\ProceduresController::class, 'store'])->name('procedures.form.create')->middleware('roles:procedures.create');
Route::get('/procedures/list/json', [App\Http\Controllers\Admin\ProceduresController::class, 'list_json'])->name('procedures.form.json');
Route::post('/procedures/update/{IdProcedures}', [App\Http\Controllers\Admin\ProceduresController::class, 'update'])->name('procedures.form.update')->middleware('roles:procedures.update');
Route::post('/procedures/delete/{IdProcedures}', [App\Http\Controllers\Admin\ProceduresController::class, 'destroy'])->name('procedures.form.delete')->middleware('roles:procedures.delete');
Route::get('/procedures/existe/code', [App\Http\Controllers\Admin\ProceduresController::class, 'existe_code'])->name('procedures.existe.code');

//medication-infusao
Route::get('/medication-infusao', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'index'])->name('medication_infusao');
Route::get('/medication-infusao/form/{IdMedicationInfusao?}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'show'])->name('medication_infusao.form');
Route::post('/medication-infusao/create', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'store'])->name('medication_infusao.form.create');
Route::post('/medication-infusao/update/{IdMedicationInfusao}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'update'])->name('medication_infusao.form.update');
Route::post('/medication-infusao/delete/{IdMedicationInfusao}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'destroy'])->name('medication_infusao.form.delete');
Route::get('/medication-infusao/option', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'option'])->name('medication_infusao.option');
Route::get('/medication-infusao/form-modal/{IdMedicationInfusao?}', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'show_modal'])->name('medication_infusao.form_modal');
Route::post('/medication-infusao/create-modal', [App\Http\Controllers\Admin\MedicationInfusaoController::class, 'store_modal'])->name('medication_infusao.form.create_modal');

//medication-dilutions
Route::get('/medication-dilutions', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'index'])->name('medication_dilutions');
Route::get('/medication-dilutions/form/{IdMedicationDilutions?}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'show'])->name('medication_dilutions.form');
Route::post('/medication-dilutions/create', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'store'])->name('medication_dilutions.form.create');
Route::post('/medication-dilutions/update/{IdMedicationDilutions}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'update'])->name('medication_dilutions.form.update');
Route::post('/medication-dilutions/delete/{IdMedicationDilutions}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'destroy'])->name('medication_dilutions.form.delete');
Route::get('/medication-dilutions/option', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'option'])->name('medication_dilutions.option');
Route::get('/medication-dilutions/form-modal/{IdMedicationDilutions?}', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'show_modal'])->name('medication_dilutions.form_modal');
Route::post('/medication-dilutions/create-modal', [App\Http\Controllers\Admin\MedicationDilutionsController::class, 'store_modal'])->name('medication_dilutions.form.create_modal');

//medication-entries
Route::get('/medication-entries', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'index'])->name('medication_entries');
Route::get('/medication-entries/form/{IdMedicationEntries?}', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'show'])->name('medication_entries.form');
Route::post('/medication-entries/create', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'store'])->name('medication_entries.form.create');
Route::post('/medication-entries/update/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'update'])->name('medication_entries.form.update');
Route::post('/medication-entries/delete/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesController::class, 'destroy'])->name('medication_entries.form.delete');

//medication-entries-registrations
Route::get('/medication-entries-registrations/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'index'])->name('medication_entries_registrations');
Route::get('/medication-entries-registrations/form/{IdMedicationEntries}/{IdMedicationEntriesRegistrations?}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'show'])->name('medication_entries_registrations.form');
Route::post('/medication-entries-registrations/create/{IdMedicationEntries}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'store'])->name('medication_entries_registrations.form.create');
Route::post('/medication-entries-registrations/update/{IdMedicationEntries}/{IdMedicationEntriesRegistrations}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'update'])->name('medication_entries_registrations.form.update');
Route::post('/medication-entries-registrations/delete/{IdMedicationEntries}/{IdMedicationEntriesRegistrations}', [App\Http\Controllers\Admin\MedicationEntriesRegistrationsController::class, 'destroy'])->name('medication_entries_registrations.form.delete');

//call-panel
Route::get('/call_panel', [App\Http\Controllers\Admin\CallPanelController::class, 'index'])->name('call_panel');
Route::get('/call_panel/json', [App\Http\Controllers\Admin\CallPanelController::class, 'json'])->name('call_panel.json');
Route::get('/call_panel/form/{IdCallPanel?}', [App\Http\Controllers\Admin\CallPanelController::class, 'show'])->name('call_panel.form');
Route::post('/call_panel/create', [App\Http\Controllers\Admin\CallPanelController::class, 'store'])->name('call_panel.form.create');
Route::post('/call_panel/update/{IdCallPanel}', [App\Http\Controllers\Admin\CallPanelController::class, 'update'])->name('call_panel.form.update');
Route::post('/call_panel/delete/{IdCallPanel}', [App\Http\Controllers\Admin\CallPanelController::class, 'destroy'])->name('call_panel.form.delete');

//emergency-services-files
Route::get('/emergency-services-files/{IdEmergencyServices?}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'index'])->name('emergency_services_files');
Route::get('/emergency-services-files/form/{IdEmergencyServices?}/{IdEmergencyServicesFiles?}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'show'])->name('emergency_services_files.form');
Route::post('/emergency-services-files/create/{IdEmergencyServices?}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'store'])->name('emergency_services_files.form.create');
Route::post('/emergency-services-files/update/{IdEmergencyServices?}/{IdEmergencyServicesFiles}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'update'])->name('emergency_services_files.form.update');
Route::post('/emergency-services-files/delete/{IdEmergencyServicesFiles}', [App\Http\Controllers\Admin\EmergencyServicesFilesController::class, 'destroy'])->name('emergency_services_files.form.delete');

//emergency-services-conducts
Route::get('/emergency-services-conducts/{type}/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'index'])->name('emergency_services_conducts');
Route::get('/emergency-services-conducts/form/internment/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'internment'])->name('emergency_services_conducts.internment');
Route::post('/emergency-services-conducts/form/{type}/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'store'])->name('emergency_services_conducts.create');
Route::post('/emergency-services-conducts/form/medical-opinion/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'medical_opinion_save'])->name('emergency_services_conducts.medical_opinion');
Route::get('/emergency-services-conducts/form/medication-option/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_pdf'])->name('emergency_services_conducts.medication.option.export');
Route::get('/emergency-services-conducts/medication-declaration-certificate/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_declaration_certificate'])->name('emergency_services_conducts.medication.declaration.certificate.export');
Route::get('/emergency-services-conducts/medication-certificate/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_certificate'])->name('emergency_services_conducts.medication.certificate.export');
Route::get('/emergency-services-conducts/medication-medical-report/export/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesConductsController::class, 'export_medical_report'])->name('emergency_services_conducts.medication.medical.report.export');

//emergency-services-procedures
Route::get('/emergency-services-procedures/list/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'index'])->name('emergency_services_procedures');
Route::get('/emergency-services-procedures/table-list/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'table'])->name('emergency_services_procedures.table');
Route::post('/emergency-services-procedures/create/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'store'])->name('emergency_services_procedures.form.create');
Route::post('/emergency-services-procedures/update/{IdEmergencyServices}/{IdEmergencyServicesProcedures}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'update_data'])->name('emergency_services_procedures.data.update');
Route::post('/emergency-services-procedures/delete/{IdEmergencyServicesProcedures}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'destroy'])->name('emergency_services_procedures.form.delete');
Route::get('/emergency-services-procedures/run/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'run'])->name('emergency_services_procedures.run');
Route::get('/emergency-services-procedures/table-run/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'table_run'])->name('emergency_services_procedures.table.run');
Route::get('/emergency-services-procedures/table-run-form/{IdEmergencyServicesProcedures}/{IdEmergencyServices}/{IdProceduresGroups?}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'table_form'])->name('emergency_services_procedures.form.run');
Route::post('/emergency-services-procedures/save-run/{IdEmergencyServicesProcedures}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'run_save'])->name('emergency_services_procedures.save.run');
Route::get('/emergency-services-procedures/run-list', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'run_list'])->name('emergency_services_procedures.list.run');
Route::get('/emergency-services-procedures/export/{IdEmergencyServices}/{IdProceduresGroups}', [App\Http\Controllers\Admin\EmergencyServicesProceduresController::class, 'export_procedures'])->name('emergency_services_procedures.export');

//procedures-groups
Route::get('/procedures-groups/{IdEmergencyServices}', [App\Http\Controllers\Admin\ProceduresGroupsController::class, 'index'])->name('procedures_groups');

//medication-prescription
Route::get('/medication-prescription', [App\Http\Controllers\Admin\MedicationPrescriptionController::class, 'index'])->name('medication_prescription');
Route::get('/medication-prescription/create', [App\Http\Controllers\Admin\MedicationPrescriptionController::class, 'store'])->name('medication_prescription.save');

//emergency-services-prescriptions
Route::get('/emergency-services-prescriptions/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesPrescriptionsController::class, 'index'])->name('emergency_services_prescriptions');
Route::get('/emergency-services-prescriptions/form/{IdEmergencyServices}/{IdEmergencyServicesPrescriptions?}', [App\Http\Controllers\Admin\EmergencyServicesPrescriptionsController::class, 'show'])->name('emergency_services_prescriptions.form');
Route::post('/emergency-services-prescriptions/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesPrescriptionsController::class, 'store'])->name('emergency_services_prescriptions.form.create');
Route::post('/emergency-services-prescriptions/update/{IdEmergencyServices}/{IdEmergencyServicesPrescriptions}', [App\Http\Controllers\Admin\EmergencyServicesPrescriptionsController::class, 'update'])->name('emergency_services_prescriptions.form.update');
Route::post('/emergency-services-prescriptions/delete/{IdEmergencyServicesPrescriptions}', [App\Http\Controllers\Admin\EmergencyServicesPrescriptionsController::class, 'destroy'])->name('emergency_services_prescriptions.form.delete');
Route::get('/emergency-services-prescriptions/export/{IdEmergencyServices}/{IdEmergencyServicesPrescriptions?}', [App\Http\Controllers\Admin\EmergencyServicesPrescriptionsController::class, 'export_pdf'])->name('emergency_services_prescriptions.export');

//emergency-services-forward
Route::get('/emergency-services-forward/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'index'])->name('emergency_services_forward');
Route::get('/emergency-services-forward/form/{IdEmergencyServices}/{IdEmergencyServicesForward?}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'show'])->name('emergency_services_forward.form');
Route::post('/emergency-services-forward/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'store'])->name('emergency_services_forward.form.create');
Route::post('/emergency-services-forward/update/{IdEmergencyServices}/{IdEmergencyServicesForward}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'update'])->name('emergency_services_forward.form.update');
Route::post('/emergency-services-forward/delete/{IdEmergencyServicesForward}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'destroy'])->name('emergency_services_forward.form.delete');
Route::get('/emergency-services-forward/export/{IdEmergencyServices}/{IdEmergencyServicesForward?}', [App\Http\Controllers\Admin\EmergencyServicesForwardController::class, 'export_pdf'])->name('emergency_services_forward.export');

//emergency-services-forward-internal
Route::get('/emergency-services-forward-internal/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesForwardInternalController::class, 'index'])->name('emergency_services_forward_internal');
Route::get('/emergency-services-forward-internal/form/{IdEmergencyServices}/{IdEmergencyServicesInternal?}', [App\Http\Controllers\Admin\EmergencyServicesForwardInternalController::class, 'show'])->name('emergency_services_forward_internal.form');
Route::post('/emergency-services-forward-internal/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesForwardInternalController::class, 'store'])->name('emergency_services_forward_internal.form.create');
Route::post('/emergency-services-forward-internal/update/{IdEmergencyServices}/{IdEmergencyServicesInternal}', [App\Http\Controllers\Admin\EmergencyServicesForwardInternalController::class, 'update'])->name('emergency_services_forward_internal.form.update');
Route::post('/emergency-services-forward-internal/delete/{IdEmergencyServicesInternal}', [App\Http\Controllers\Admin\EmergencyServicesForwardInternalController::class, 'destroy'])->name('emergency_services_forward_internal.form.delete');
Route::get('/emergency-services-forward-internal/export/{IdEmergencyServices}/{IdEmergencyServicesInternal?}', [App\Http\Controllers\Admin\EmergencyServicesForwardInternalController::class, 'export_pdf'])->name('emergency_services_forward_internal.export');

//specialty-categories
Route::get('/specialty-categories', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'index'])->name('specialty_categories');
Route::get('/specialty-categories/form/{IdSpecialtyCategories?}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'show'])->name('specialty_categories.form');
Route::post('/specialty-categories/create', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'store'])->name('specialty_categories.form.create');
Route::post('/specialty-categories/update/{IdSpecialtyCategories}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'update'])->name('specialty_categories.form.update');
Route::post('/specialty-categories/delete/{IdSpecialtyCategories}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'destroy'])->name('specialty_categories.form.delete');
Route::get('/specialty-categories/query-json', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'query_json'])->name('specialty_categories.json');
Route::get('/specialty-categories/option', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'option'])->name('specialty_categories.option');
Route::get('/specialty-categories/form-modal/{IdSpecialtyCategories?}', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'show_modal'])->name('specialty_categories.form_modal');
Route::post('/specialty-categories/create-modal', [App\Http\Controllers\Admin\SpecialtyCategoriesController::class, 'store_modal'])->name('specialty_categories.form.create_modal');

//medication-groups
Route::get('/medication-groups/{IdEmergencyServices}', [App\Http\Controllers\Admin\MedicationGroupsController::class, 'index'])->name('medication_groups');

//emergency-services-medications
Route::get('/emergency-services-medications/list/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'index'])->name('emergency_services_medications');
Route::get('/emergency-services-medications/table-list/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'table'])->name('emergency_services_medications.table');
Route::post('/emergency-services-medications/create/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'store'])->name('emergency_services_medications.form.create');
Route::post('/emergency-services-medications/update/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'update_data'])->name('emergency_services_medications.data.update');
Route::post('/emergency-services-medications/delete/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'destroy'])->name('emergency_services_medications.form.delete');
Route::get('/emergency-services-medications/update/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'update_check'])->name('emergency_services_medications.check.update');
Route::post('/emergency-services-medications/check-send-update/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_send_update'])->name('emergency_services_medications.check.send.update');
//--------------check-in----------------
Route::get('/emergency-services-medications/check-list/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_list'])->name('emergency_services_medications.list.check');
Route::get('/emergency-services-medications/check-run/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check'])->name('emergency_services_medications.check');
Route::get('/emergency-services-medications/check-form-table/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'table_ckeck'])->name('emergency_services_medications.table.check');
Route::get('/emergency-services-medications/check-admin/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_admin'])->name('emergency_services_medications.check.admin');
Route::post('/emergency-services-medications/save-check/{IdEmergencyServices}/{IdMedicationGroups}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_save'])->name('emergency_services_medications.save.check');
Route::get('/emergency-services-medications/export/{IdEmergencyServices}/{IdMedicationGroups?}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'export_pdf'])->name('emergency_services_medications.export');
Route::get('/emergency-services-medications/history/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'check_history'])->name('emergency_services_medications.history');
Route::get('/emergency-services-medications/denied-medication/{IdEmergencyServices}/{IdEmergencyServicesMedications}', [App\Http\Controllers\Admin\EmergencyServicesMedicationsController::class, 'denied_medication_export'])->name('emergency_services_medications.denied.medication.export');

//medication-active-principles
Route::get('/medication-active-principles', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'index'])->name('medication_active_principles');
Route::get('/medication-active-principles/form/{IdMedicationActivePrinciples?}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'show'])->name('medication_active_principles.form');
Route::get('/medication-active-principles/query-json', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'query_json'])->name('medication_active_principles.json');
Route::post('/medication-active-principles/create', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'store'])->name('medication_active_principles.form.create');
Route::post('/medication-active-principles/update/{IdMedicationActivePrinciples}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'update'])->name('medication_active_principles.form.update');
Route::post('/medication-active-principles/delete/{IdMedicationActivePrinciples}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'destroy'])->name('medication_active_principles.form.delete');
Route::get('/medication-active-principles/option', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'option'])->name('medication_active_principles.option');
Route::get('/medication-active-principles/form-modal/{IdMedicationActivePrinciples?}', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'show_modal'])->name('medication_active_principles.form_modal');
Route::post('/medication-active-principles/create-modal', [App\Http\Controllers\Admin\MedicationActivePrinciplesController::class, 'store_modal'])->name('medication_active_principles.form.create_modal');

//materials
Route::get('/materials', [App\Http\Controllers\Admin\MaterialsController::class, 'index'])->name('materials');
Route::get('/materials/form/{IdMaterials?}', [App\Http\Controllers\Admin\MaterialsController::class, 'show'])->name('materials.form');
Route::get('/materials/query-json', [App\Http\Controllers\Admin\MaterialsController::class, 'query_json'])->name('materials.json');
Route::post('/materials/create', [App\Http\Controllers\Admin\MaterialsController::class, 'store'])->name('materials.form.create');
Route::post('/materials/update/{IdMaterials}', [App\Http\Controllers\Admin\MaterialsController::class, 'update'])->name('materials.form.update');
Route::post('/materials/delete/{IdMaterials}', [App\Http\Controllers\Admin\MaterialsController::class, 'destroy'])->name('materials.form.delete');

//emergency-services-materials
Route::get('/emergency-services-materials/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'index'])->name('emergency_services_materials');
Route::get('/emergency-services-materials/form/{IdEmergencyServices}/{IdEmergencyServicesMaterials?}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'show'])->name('emergency_services_materials.form');
Route::post('/emergency-services-materials/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'store'])->name('emergency_services_materials.form.create');
Route::post('/emergency-services-materials/update/{IdEmergencyServices}/{IdEmergencyServicesMaterials}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'update'])->name('emergency_services_materials.form.update');
Route::post('/emergency-services-materials/delete/{IdEmergencyServicesMaterials}', [App\Http\Controllers\Admin\EmergencyServicesMaterialsController::class, 'destroy'])->name('emergency_services_materials.form.delete');

//beds
Route::get('/beds', [App\Http\Controllers\Admin\BedsController::class, 'index'])->name('beds');
Route::get('/beds/form/{IdBeds?}', [App\Http\Controllers\Admin\BedsController::class, 'show'])->name('beds.form');
Route::get('/beds/query-json', [App\Http\Controllers\Admin\BedsController::class, 'query_json'])->name('beds.json');
Route::post('/beds/create', [App\Http\Controllers\Admin\BedsController::class, 'store'])->name('beds.form.create');
Route::post('/beds/update/{IdBeds}', [App\Http\Controllers\Admin\BedsController::class, 'update'])->name('beds.form.update');
Route::post('/beds/delete/{IdBeds}', [App\Http\Controllers\Admin\BedsController::class, 'destroy'])->name('beds.form.delete');

//clinics
Route::get('/clinics', [App\Http\Controllers\Admin\ClinicsController::class, 'index'])->name('clinics');
Route::get('/clinics/form/{IdClinics?}', [App\Http\Controllers\Admin\ClinicsController::class, 'show'])->name('clinics.form');
Route::get('/clinics/query-json', [App\Http\Controllers\Admin\ClinicsController::class, 'query_json'])->name('clinics.json');
Route::post('/clinics/create', [App\Http\Controllers\Admin\ClinicsController::class, 'store'])->name('clinics.form.create');
Route::post('/clinics/update/{IdClinics}', [App\Http\Controllers\Admin\ClinicsController::class, 'update'])->name('clinics.form.update');
Route::post('/clinics/delete/{IdClinics}', [App\Http\Controllers\Admin\ClinicsController::class, 'destroy'])->name('clinics.form.delete');

//type-functional-units
Route::get('/type-functional-units', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'index'])->name('type_functional_units');
Route::get('/type-functional-units/form/{IdTypeFunctionalUnits?}', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'show'])->name('type_functional_units.form');
Route::get('/type-functional-units/query-json', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'query_json'])->name('type_functional_units.json');
Route::post('/accommotype-functional-unitsdations/create', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'store'])->name('type_functional_units.form.create');
Route::post('/type-functional-units/update/{IdTypeFunctionalUnits}', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'update'])->name('type_functional_units.form.update');
Route::post('/type-functional-units/delete/{IdTypeFunctionalUnits}', [App\Http\Controllers\Admin\TypeFunctionalUnitsController::class, 'destroy'])->name('type_functional_units.form.delete');

//functional-units
Route::get('/functional-units', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'index'])->name('functional_units');
Route::get('/functional-units/form/{IdFunctionalUnits?}', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'show'])->name('functional_units.form');
Route::get('/functional-units/query-json', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'query_json'])->name('functional_units.json');
Route::post('/accommofunctional-unitsdations/create', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'store'])->name('functional_units.form.create');
Route::post('/functional-units/update/{IdFunctionalUnits}', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'update'])->name('functional_units.form.update');
Route::post('/functional-units/delete/{IdFunctionalUnits}', [App\Http\Controllers\Admin\FunctionalUnitsController::class, 'destroy'])->name('functional_units.form.delete');

//rooms
Route::get('/rooms', [App\Http\Controllers\Admin\RoomsController::class, 'index'])->name('rooms');
Route::get('/rooms/form/{IdRooms?}', [App\Http\Controllers\Admin\RoomsController::class, 'show'])->name('rooms.form');
Route::post('/rooms/create', [App\Http\Controllers\Admin\RoomsController::class, 'store'])->name('rooms.form.create');
Route::post('/rooms/update/{IdRooms}', [App\Http\Controllers\Admin\RoomsController::class, 'update'])->name('rooms.form.update');
Route::post('/rooms/delete/{IdRooms}', [App\Http\Controllers\Admin\RoomsController::class, 'destroy'])->name('rooms.form.delete');
Route::post('/rooms/query-json', [App\Http\Controllers\Admin\RoomsController::class, 'query_json'])->name('rooms.query.json');

//rooms beds
Route::get('/rooms-beds/{IdRooms}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'index'])->name('rooms_beds');
Route::get('/rooms-beds/form/{IdRooms}/{IdRoomsBeds?}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'show'])->name('rooms_beds.form');
Route::post('/rooms-beds/create/{IdRooms}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'store'])->name('rooms_beds.form.create');
Route::post('/rooms-beds/update/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'update'])->name('rooms_beds.form.update');
Route::post('/rooms-beds/delete/{IdRoomsBeds}', [App\Http\Controllers\Admin\RoomsBedsController::class, 'destroy'])->name('rooms_beds.form.delete');
Route::post('/rooms-beds/query-json', [App\Http\Controllers\Admin\RoomsBedsController::class, 'query_json'])->name('rooms_beds.query.json');

//central-beds
Route::get('/central-beds', [App\Http\Controllers\Admin\CentralBedsController::class, 'index'])->name('central_beds');
Route::get('/central-beds/table', [App\Http\Controllers\Admin\CentralBedsController::class, 'table'])->name('central_beds.table');
Route::get('/central-beds/interning-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'interning'])->name('central_beds.interning');
Route::post('/central-beds/interning-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'interning_store'])->name('central_beds.interning.create');
Route::get('/central-beds/cleaning-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'cleaning'])->name('central_beds.cleaning');
Route::post('/central-beds/cleaning-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'cleaning_store'])->name('central_beds.cleaning.create');
Route::post('/central-beds/cleaning-finish/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'cleaning_finish'])->name('central_beds.cleaning.finish');
Route::post('/central-beds/block-store/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'block_store'])->name('central_beds.block');
Route::get('/central-beds/transfer-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer'])->name('central_beds.transfer');
Route::post('/central-beds/transfer-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer_store'])->name('central_beds.transfer.create');
Route::get('/central-beds/transfer-beds-form/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer_beds'])->name('central_beds.transfer.beds');
Route::post('/central-beds/transfer-beds-create/{IdRooms}/{IdRoomsBeds}', [App\Http\Controllers\Admin\CentralBedsController::class, 'transfer_store_beds'])->name('central_beds.transfer.beds.create');

//approve-admissions
Route::get('/approve-admissions', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'index'])->name('approve_admissions');
Route::post('/approve-admissions/table', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'table'])->name('approve_admissions.table');
Route::post('/approve-admissions/approve-reprove/{IdAdmitPatientRequests}', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'approve_reprove'])->name('approve_admissions.approve');
Route::post('/approve-admissions/query-json', [App\Http\Controllers\Admin\ApproveAdmissionsController::class, 'query_current'])->name('approve_admissions.json');

//emergency-services-vital-data
Route::get('/emergency-services-vital-data/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'index'])->name('emergency_services_vital_data');
Route::get('/emergency-services-vital-data/form/{IdEmergencyServices}/{IdEmergencyServicesVitalData?}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'show'])->name('emergency_services_vital_data.form');
Route::post('/emergency-services-vital-data/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'store'])->name('emergency_services_vital_data.form.create');
Route::post('/emergency-services-vital-data/delete/{IdEmergencyServicesVitalData}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'destroy'])->name('emergency_services_vital_data.form.delete');
Route::get('/emergency-services-vital-data/export/{IdEmergencyServices}/{IdEmergencyServicesVitalData?}', [App\Http\Controllers\Admin\EmergencyServicesVitalDataController::class, 'export_pdf'])->name('emergency_services_vital_data.export');

Route::group(['middleware' => 'auth', 'belongUnit'], function () {

    //emergency_services
    Route::get('/emergency-services', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'index'])->name('emergency_services');
    Route::post('/emergency-services/table', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'table'])->name('emergency_services.table');
    Route::get('/emergency-services/form/{IdEmergencyServices?}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'show'])->name('emergency_services.form');
    Route::post('/emergency-services/create', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'store'])->name('emergency_services.form.create');
    Route::post('/emergency-services/update/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'update'])->name('emergency_services.form.update');
    Route::post('/emergency-services/delete/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'destroy'])->name('emergency_services.form.delete');
    Route::get('/emergency-services/historic/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesController::class, 'historic'])->name('emergency_services.historic');

    //screenings
    Route::get('/screenings', [App\Http\Controllers\Admin\ScreeningsController::class, 'index'])->name('screenings');
    Route::post('/screenings/table', [App\Http\Controllers\Admin\ScreeningsController::class, 'table'])->name('screenings.table');
    Route::get('/screenings/welcome/{IdEmergencyServices}', [App\Http\Controllers\Admin\ScreeningsController::class, 'welcome'])->name('screenings.welcome');
    Route::get('/screenings/form/{IdEmergencyServices}/{IdScreenings?}', [App\Http\Controllers\Admin\ScreeningsController::class, 'show'])->name('screenings.form');
    Route::post('/screenings/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\ScreeningsController::class, 'store'])->name('screenings.form.create');
    Route::post('/screenings/update/{IdEmergencyServices}/{IdScreenings}', [App\Http\Controllers\Admin\ScreeningsController::class, 'update'])->name('screenings.form.update');
    Route::post('/screenings/delete/{IdEmergencyServices}/{IdScreenings}', [App\Http\Controllers\Admin\ScreeningsController::class, 'destroy'])->name('screenings.form.delete');

    //medical_care
    Route::get('/medical-care/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'index'])->name('medical_care');
    Route::post('/medical-care/table/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'table'])->name('medical_care.table');
    Route::post('/medical-care/watch/{IdEmergencyServices}/{IdMedicalCareLottery}', [App\Http\Controllers\Admin\MedicalCareController::class, 'watch'])->name('medical_care.watch');
    Route::post('/medical-care/release/{IdEmergencyServices}/{IdMedicalCareLottery}', [App\Http\Controllers\Admin\MedicalCareController::class, 'release'])->name('medical_care.release');
    Route::get('/medical-care/list_iframe/{IdEmergencyServices}', [App\Http\Controllers\Admin\MedicalCareController::class, 'list_iframe'])->name('medical_care.list_iframe');
    Route::get('/medical-care/form/{IdFlowcharts}/{IdEmergencyServices}/{IdEmergencyServicesInternal}/{IdMedicalCare?}', [App\Http\Controllers\Admin\MedicalCareController::class, 'show'])->name('medical_care.form');
    Route::get('/medical-care/form-iframe/{IdEmergencyServices}/{IdMedicalCare?}', [App\Http\Controllers\Admin\MedicalCareController::class, 'show_iframe'])->name('medical_care.form.iframe');
    Route::post('/medical-care/create/{IdEmergencyServices}/{IdEmergencyServicesInternal}/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'store'])->name('medical_care.form.create');
    Route::post('/medical-care/update/{IdEmergencyServices}/{IdMedicalCare}/{IdFlowcharts}', [App\Http\Controllers\Admin\MedicalCareController::class, 'update'])->name('medical_care.form.update');
    Route::post('/medical-care/create-iframe/{IdEmergencyServices}', [App\Http\Controllers\Admin\MedicalCareController::class, 'store_iframe'])->name('medical_care.form.iframe.create');
    Route::post('/medical-care/update-iframe/{IdEmergencyServices}/{IdMedicalCare}', [App\Http\Controllers\Admin\MedicalCareController::class, 'update_iframe'])->name('medical_care.update.iframe');
    Route::post('/medical-care/delete/{IdEmergencyServices}/{IdMedicalCare}', [App\Http\Controllers\Admin\MedicalCareController::class, 'destroy'])->name('medical_care.form.delete');

    //emergency services diagnostics
    Route::get('/emergency-services-diagnostics/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'index'])->name('emergency_services_diagnostics');
    Route::get('/emergency-services-diagnostics/form/{IdEmergencyServices}/{IdEmergencyServicesDiagnostics?}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'show'])->name('emergency_services_diagnostics.form');
    Route::post('/emergency-services-diagnostics/create/{IdEmergencyServices}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'store'])->name('emergency_services_diagnostics.form.create');
    Route::post('/emergency-services-diagnostics/update/{IdEmergencyServices}/{IdEmergencyServicesDiagnostics}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'update'])->name('emergency_services_diagnostics.form.update');
    Route::post('/emergency-services-diagnostics/delete/{IdEmergencyServicesDiagnostics}', [App\Http\Controllers\Admin\EmergencyServicesDiagnosticsController::class, 'destroy'])->name('emergency_services_diagnostics.form.delete');

    //inpatients
    Route::get('/inpatients', [App\Http\Controllers\Admin\InpatientsController::class, 'index'])->name('inpatients');
    Route::get('/observation', [App\Http\Controllers\Admin\InpatientsController::class, 'observation'])->name('observation');
    Route::get('/revaluation', [App\Http\Controllers\Admin\InpatientsController::class, 'revaluation'])->name('revaluation');
    
});