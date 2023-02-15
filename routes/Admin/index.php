<?php

//home
require_once('home.php');

//users
require_once('users.php');

//query
require_once('query.php');

//service units
require_once('service_units.php');

//users service units
require_once('users_service_units.php');

//medication classifications
require_once('medication_administrations.php');

//medication units
require_once('medication_units.php');

//medicines
require_once('medicines.php');

//cid10
require_once('cid10.php');

//protocols
require_once('protocols.php');

//protocols cid10
require_once('protocols_cid10.php');

//protocols medication
require_once('protocols_medication.php');

//medical specialties
require_once('medical_specialties.php');

//users medical specialties
require_once('users_medical_specialties.php');

//topics
require_once('topics.php');

//topics checks
require_once('topics_checks.php');

//emergency classification manchester
require_once('classification_manchester.php');

//service units forwarding
require_once('service_units_forwarding.php');

//service units forwarding
require_once('call.php');

//procedure groups
require_once('procedures.php');

//medication infusao
require_once('medication_infusao.php');

//medication infusao
require_once('medication_dilutions.php');

//medication entries
require_once('medication_entries.php');

//medication entries registrations
require_once('medication_entries_registrations.php');

//call panel
require_once('call_panel.php');

//emergency services files
require_once('emergency_services_files.php');

//emergency services conducts
require_once('emergency_services_conducts.php');

//emergency services procedures
require_once('emergency_services_procedures.php');

//emergency services procedures groups
require_once('procedures_groups.php');

//medication_prescription
require_once('medication_prescription.php');

//emergency_services_prescriptions
require_once('emergency_services_prescriptions.php');

//emergency_services_forward
require_once('emergency_services_forward.php');

//emergency services forward internal
require_once('emergency_services_forward_internal.php');

//specialty_categories
require_once('specialty_categories.php');

//medication_groups
require_once('medication_groups.php');

//emergency_services_medications
require_once('emergency_services_medications.php');

//medication active principles
require_once('medication_active_principles.php');

//materials
require_once('materials.php');

//emergency services materials
require_once('emergency_services_materials.php');

//beds
require_once('beds.php');

//accommodations
require_once('accommodations.php');

//clinics
require_once('clinics.php');

//type functional units
require_once('type_functional_units.php');

//functional_units
require_once('functional_units.php');

//rooms
require_once('rooms.php');

//rooms beds
require_once('rooms_beds.php');

//central_beds
require_once('central_beds.php');

//approve admissions
require_once('approve_admissions.php');

//emergency_services_vital_data
require_once('emergency_services_vital_data.php');

//flowchart
require_once('flowcharts.php');

//flowcharts_scales
require_once('flowcharts_scales.php');

//units logged in
Route::group(['middleware' => 'auth', 'belongUnit'], function () {

    //emergency_services
    require_once('emergency_services.php');

    //users patients
    require_once('users_patients.php');

    //users diseases
    require_once('users_diseases.php');

    //screenings
    require_once('screenings.php');

    //medical_care
    require_once('medical_care.php');

    //emergency services diagnostics
    require_once('emergency_services_diagnostics.php');

    //inpatients
    require_once('inpatients.php');
    
});