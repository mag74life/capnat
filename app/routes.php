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

//Homepage
Route::get('/', 'HomeController@showIndex');

//Patient
Route::get('login', 'PatientController@showLogin');
Route::post('login', 'PatientController@handleLogin');
Route::any('logout', 'PatientController@handleLogout');
Route::get('survey', 'PatientController@showSurvey');
Route::post('survey', 'PatientController@handleSurvey');

//Staff
Route::get('staff-login', 'StaffController@showLogin');
Route::post('staff-login', 'StaffController@handleLogin');
Route::any('staff-logout', 'StaffController@doLogout');
