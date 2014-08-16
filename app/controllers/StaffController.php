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
			'except' => array(
				'showLogin',
				'handleLogin',
			),
		));
		
		// Only clinicians can access
		$this->beforeFilter('staff0', array(
			'only' => array(
				
			),
		));
		
		// Only research staff and above can access
		$this->beforeFilter('staff1', array(
			'only' => array(
				'showAddPatient',
				'handleAddPatient',
				'showRemovePatient',
				'handleRemovePatient',
			),
		));
		
		// Only project manager and above can access
		$this->beforeFilter('staff2', array(
			'only' => array(
				'showPatientLookup',
				'handlePatientLookup',
				'showAddClinician',
				'handleAddClinician',
				'showAddResearchStaff',
				'handleAddResearchStaff',
			),
		));
		
		// Only head researcher can access
		$this->beforeFilter('staff3', array(
			'only' => array(
				'showResearchData',
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
	
	// Show patient dashboard
	public function showDashboard() {
		$user = Auth::user();
		return View::make('staff' . $user->userData->role . '-dashboard', array(
			'title'		=> 'Dashboard',
			'role'		=> $user->userData->role,
		));
	}
	
	// Show add patient
	public function showAddPatient() {
		$unique = Session::get('unique');
		$password = Session::get('password');
		if ($unique || $password) {
			return View::make('staff-add-patient-results', array(
				'title'		=> 'Patient Added',
				'unique'	=> $unique,
				'password'	=> $password,
			));
		} else {
			return View::make('staff-add-patient', array(
				'title'	=> 'Add Patient',
			));
		}
	}
	
	// Handle add patient
	public function handleAddPatient() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'name'			=> 'required',
			'dob'			=> 'required|date',
			'gender'		=> 'required',
			'race'			=> 'required',
			'ethnicity'		=> 'required',
			'education'		=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('add-patient')->withErrors($validator)->withInput(Input::all());
		} else {
			// Get the next available patient number
			$unique = User::where('type', '=', '0')->select(DB::raw('MAX( CAST( `unique` AS UNSIGNED) ) + 1 as next'))->first()->next;
			
			// Generate a password
			$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
			$password = '';
			for ($i = 0; $i < 6; $i++) {
				$password .= $characters[rand(0, strlen($characters) - 1)];
			}
			
			$user = User::create(array(
				'unique'		=> $unique,
				'type'			=> '0',
				'password'		=> Hash::make($password),
			));
			$patient = new Patient(array(
				'name'			=> Input::get('name'),
				'dob'			=> date('Y-m-d', strtotime(Input::get('dob'))),
				'gender'		=> Input::get('gender'),
				'race'			=> Input::get('race'),
				'ethnicity'		=> Input::get('ethnicity'),
				'education'		=> Input::get('education'),
			));
			$user->userData()->save($patient);
			
			return Redirect::to('add-patient')->with('unique', $unique)->with('password', $password);
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
