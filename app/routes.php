<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route parameter patterns
Route::pattern('page', '[0-9]+');


// Homepage
if (Auth::guest()) { // Show login page if user is not logged in
	$dashboard = 'PatientController@showLogin';
} else if (Auth::user()->type == '0') { // Show patient dashboard if user is a patient
	$dashboard = 'PatientController@showDashboard';
} else { // Show staff dashboard
	$dashboard = 'StaffController@showDashboard';
}
Route::get('/', $dashboard);

// Patient
Route::get('login', 'PatientController@showLogin');
Route::post('login', 'PatientController@handleLogin');
Route::any('logout', 'PatientController@handleLogout');
Route::get('survey/{page?}', 'PatientController@showSurvey');
Route::post('survey/{page?}', 'PatientController@handleSurvey');

// Staff
Route::get('staff-login', 'StaffController@showLogin');
Route::post('staff-login', 'StaffController@handleLogin');
Route::any('staff-logout', 'StaffController@handleLogout');
Route::get('add-patient', 'StaffController@showAddPatient');
Route::post('add-patient', 'StaffController@handleAddPatient');
Route::get('remove-patient', 'StaffController@showRemovePatient');
Route::post('remove-patient', 'StaffController@handleRemovePatient');
Route::get('patient-password', 'StaffController@showPatientPassword');
Route::post('patient-password', 'StaffController@handlePatientPassword');
Route::get('add-clinician', 'StaffController@showAddClinician');
Route::post('add-clinician', 'StaffController@handleAddClinician');
Route::get('remove-clinician', 'StaffController@showRemoveClinician');
Route::post('remove-clinician', 'StaffController@handleRemoveClinician');
Route::get('add-staff', 'StaffController@showAddStaff');
Route::post('add-staff', 'StaffController@handleAddStaff');
Route::get('remove-staff', 'StaffController@showRemoveStaff');
Route::post('remove-staff', 'StaffController@handleRemoveStaff');
Route::get('patient-lookup', 'StaffController@showPatientLookup');
Route::post('patient-lookup', 'StaffController@handlePatientLookup');




Route::get('view-patients', 'StaffController@showViewPatients');