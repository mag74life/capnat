<?php

class StaffController extends BaseController {

	public function __construct() {
		// Only allow guests to access the login page
		$this->beforeFilter('guest', array(
			'only' => array(
				'showLogin',
				'handleLogin'
			),
		));
		
		// Only allow logged in staff to access the staff pages
		$this->beforeFilter('staff', array(
			'only' => array(
				'showCreatePatient',
				'handleCreatePatient',
				'showViewPatients',
			),
		));
	}
	
	// Show staff login
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
	
	// Show create patient
	public function showCreatePatient() {
		$unique = Session::get('unique');
		$password = Session::get('password');
		if ($unique || $password) {
			return View::make('staff-create-patient-results', array(
				'title'		=> 'Patient Created',
				'unique'	=> $unique,
				'password'	=> $password,
			));
		} else {
			return View::make('staff-create-patient', array(
				'title'	=> 'Create Patient',
			));
		}
	}
	
	// Handle create patient
	public function handleCreatePatient() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'name'		=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('create-patient')->withErrors($validator)->withInput(Input::all());
		} else {
			$next = User::where('type', '0')->max('unique') + 1;
			
			$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$password = '';
			for ($i = 0; $i < 6; $i++) {
				$password .= $characters[rand(0, strlen($characters) - 1)];
			}
			
			$user = User::create(array(
				'unique'		=> $next,
				'type'			=> '0',
				'password'		=> Hash::make($password),
			));
			$patient = new Patient(array(
				'name'			=> Input::get('name'),
			));
			$user->userData()->save($patient);
			
			return Redirect::to('create-patient')->with('unique', $next)->with('password', $password);
		}
	}
	
	// Show patient data
	public function showViewPatients() {
		$patients = Patient::orderBy('name', 'asc')->get();
		foreach ($patients as $patient) {
			$exams = $patient->exams;
			$patient['exams'] = $exams;
		}
		return View::make('staff-view-patients', array(
			'title'		=> 'Patient Data',
			'patients'	=> $patients,
		));	
	}

}
