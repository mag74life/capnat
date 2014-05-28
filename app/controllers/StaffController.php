<?php

class StaffController extends BaseController {

	public function __construct() {
		// We want to filter out guests since they have already logged in.
		$this->beforeFilter('guest', array('except' => 'doLogout'));
	}
	
	public function showLogin() {
		return View::make('staff-login', array(
			'title'	=> 'Staff Login',
		));
	}
	
	// Handle staff login
	public function handleLogin() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique'	=> 'required|alpha_num',
			'password'	=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('staff-login')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'unique'	=> Input::get('unique'),
				'password'	=> Input::get('password'),
				'type'		=> Input::get('type'),
			);
			
			if (Auth::attempt($userdata)) {
				return Redirect::intended('/');
			} else {
				return Redirect::to('staff-login')->withErrors(array('failedAuth' => 'The uniquename or password you entered is incorrect.'))->withInput(Input::except('password'));
			}
		}
	}
	
	// Handle staff logout
	public function handleLogout() {
		Auth::logout();
		return Redirect::to('staff-login');
	}

}
