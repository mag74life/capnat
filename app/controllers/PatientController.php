<?php

class PatientController extends BaseController {

	public function __construct() {
		// Only allow guests to access the login page
		$this->beforeFilter('guest', array(
			'only' => array('showLogin', 'handleLogin'),
		));
		
		// Only allow logged in patients to access the patient survey
		$this->beforeFilter('patient', array(
			'only' => array('showSurvey'),
		));
	}
	
	public function showLogin() {
		return View::make('patient-login', array(
			'title'	=> 'Login',
		));
	}
	
	// Handle patient login
	public function handleLogin() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique'	=> 'required|integer',
			'password'	=> 'required|alpha_num',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'unique'	=> Input::get('unique'),
				'password'	=> Input::get('password'),
				'type'		=> Input::get('type'),
			);
			
			if (Auth::attempt($userdata)) {
				return Redirect::intended('/');
			} else {
				return Redirect::to('login')->withErrors(array('failedAuth' => 'The ID or password you entered is incorrect.'))->withInput(Input::except('password'));
			}
		}
	}
	
	// Handle patient logout
	public function handleLogout() {
		Auth::logout();
		return Redirect::to('login');
	}
	
	// Show patient survey
	public function showSurvey() {
		return View::make('patient-survey', array(
			'title'	=> 'Survey',
		));
	}
	
	// Handle patient survey
	public function handleSurvey() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'q1'		=> 'required',
			'q2'		=> 'required',
			'q3'		=> 'required',
			'q4'		=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('survey')->withErrors($validator)->withInput(Input::all());
		} else {
			
		}
	}

}
