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
				'type'		=> 1,
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
			$unique = DB::select("SHOW TABLE STATUS LIKE 'patients'")[0]->Auto_increment;
			
			// Generate a password
			$password = $this->generatePassword();
			
			$user = User::create(array(
				'unique'		=> $unique,
				'type'			=> '0',
				'password'		=> Hash::make($password),
			));
			$patient = new Patient(array(
				'name'			=> trim(Input::get('name')),
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
	
	// Show remove patient
	public function showRemovePatient() {
		$unique = Session::get('unique');
		if ($unique) {
			return View::make('staff-remove-patient-results', array(
				'title'		=> 'Patient Removed',
				'unique'	=> $unique,
			));
		} else {
			return View::make('staff-remove-patient', array(
				'title'	=> 'Remove Patient',
			));
		}
	}
	
	// Handle remove patient
	public function handleRemovePatient() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique'		=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('remove-patient')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique = Input::get('unique');
			$patient = Patient::find($unique);
			if (!empty($patient)) {
				$patient->user()->delete();
				return Redirect::to('remove-patient')->with('unique', $unique);
			} else {
				return Redirect::to('remove-patient')->withErrors(array('failedIdMatch' => 'Patient ' . $unique . ' cannot be removed. No such patient exists in the database.'))->withInput(Input::all());
			}
		}
	}
	
	// Show reset patient password
	public function showPatientPassword() {
		$unique = Session::get('unique');
		$password = Session::get('password');
		if ($unique || $password) {
			return View::make('staff-patient-password-results', array(
				'title'		=> 'Password Reset',
				'unique'	=> $unique,
				'password'	=> $password,
			));
		} else {
			return View::make('staff-patient-password', array(
				'title'	=> 'Reset Patient Password',
			));
		}
	}
	
	// Handle reset patient password
	public function handlePatientPassword() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique'		=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('patient-password')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique = Input::get('unique');
			$patient = Patient::find($unique);
			if (!empty($patient)) {
				$user = $patient->user;
				
				// Generate a new password
				$password = $this->generatePassword();
				
				// Update the password in the database
				$user->password = Hash::make($password);
				$user->save();
				
				return Redirect::to('patient-password')->with('unique', $unique)->with('password', $password);
			} else {
				return Redirect::to('patient-password')->withErrors(array('failedIdMatch' => 'The password for patient ' . $unique . ' cannot be reset. No such patient exists in the database.'))->withInput(Input::all());
			}
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
	
	// Generate patient password
	private function generatePassword() {
		$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
		$password = '';
		for ($i = 0; $i < 6; $i++) {
			$password .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $password;
	}

}
