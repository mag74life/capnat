<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});

Route::filter('patient', function()
{
	if (Auth::guest() || Auth::user() && Auth::user()->type != '0') {
		return Redirect::guest('login');
	}
});

Route::filter('staff', function()
{
	if (Auth::guest() || Auth::user() && Auth::user()->type != '1') {
		return Redirect::guest('staff-login');
	}
});

Route::filter('staff0', function()
{
	if (Auth::user() && Auth::user()->userData->role != 0) {
		return Redirect::to('/');
	}
});

Route::filter('staff1', function()
{
	if (Auth::user() && Auth::user()->userData->role < 1) {
		return Redirect::to('/');
	}
});

Route::filter('staff2', function()
{
	if (Auth::user() && Auth::user()->userData->role < 2) {
		return Redirect::to('/');
	}
});

Route::filter('staff3', function()
{
	if (Auth::user() && Auth::user()->userData->role < 3) {
		return Redirect::to('/');
	}
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
