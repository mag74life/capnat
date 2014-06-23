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
Route::get('create-patient', 'StaffController@showCreatePatient');
Route::post('create-patient', 'StaffController@handleCreatePatient');
Route::get('view-patients', 'StaffController@showViewPatients');