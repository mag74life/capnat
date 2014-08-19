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
				'handleClinicianDashboard',
			),
		));
		
		// Only research staff and above can access
		$this->beforeFilter('staff1', array(
			'only' => array(
				'showAddPatient',
				'handleAddPatient',
				'showRemovePatient',
				'handleRemovePatient',
				'showPatientPassword',
				'handlePatientPassword',
			),
		));
		
		// Only project manager and above can access
		$this->beforeFilter('staff2', array(
			'only' => array(
				'showPatientLookup',
				'handlePatientLookup',
				'showAddClinician',
				'handleAddClinician',
				'showAddStaff',
				'handleAddStaff',
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
			'unique_id'	=> 'required',
			'password'	=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('staff-login')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'unique_id'	=> Input::get('unique_id'),
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
		Session::flush();
		Auth::logout();
		return Redirect::to('staff-login');
	}
	
	// Show staff dashboard
	public function showDashboard() {
		$vars = array(
			'title'		=> 'Dashboard',
		);
		$user = Auth::user();
		$role = $user->userData->role;
		if ($role == '0') { // User is clinician
			$patient = Session::get('patient');
			if ($patient) {
				$newest = Patient::find($patient)->exams->first(); // Grab patient's most recent exam
				if ($newest != NULL) {
					if ($newest->survey_total != NULL && $newest->assessment_total == NULL) { // Clinician can start new assessment
						$vars['option'] = 'Start a new assessment';
					} elseif ($newest != NULL) { // Clinician can revise assessment
						$vars['option'] = 'Revise assessment';
					}
				} else {
					
				}
			}
		}
		return View::make('staff' . $role . '-dashboard', $vars);
	}
	
	// Handle clinician dashboard
	public function handleClinicianDashboard() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique_id'		=> 'required|numeric',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('/')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique_id = Input::get('unique_id');
			$patient = Patient::find($unique_id);
			if (!empty($patient)) {
				Session::put('patient', $unique_id);
				return Redirect::to('/')->withInput(Input::all());
			} else {
				return Redirect::to('/')->withErrors(array('failedIdMatch' => 'Patient ' . $unique_id . ' cannot be selected. No such patient exists in the database.'))->withInput(Input::all());
			}
		}
	}
	
	// Show add patient
	public function showAddPatient() {
		$unique_id = Session::get('unique_id');
		$password = Session::get('password');
		if ($unique_id || $password) {
			return View::make('staff-add-patient-results', array(
				'title'		=> 'Patient Added',
				'unique_id'	=> $unique_id,
				'password'	=> $password,
			));
		} else {
			return View::make('staff-add-patient', array(
				'title'				=> 'Add Patient',
				'genderOptions'		=> PatientDemographics::getOptions('gender'),
				'raceOptions'		=> PatientDemographics::getOptions('race'),
				'ethnicityOptions'	=> PatientDemographics::getOptions('ethnicity'),
				'educationOptions'	=> PatientDemographics::getOptions('education'),
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
			$unique_id = DB::select("SHOW TABLE STATUS LIKE 'patients'")[0]->Auto_increment;
			
			// Generate a password
			$password = $this->generatePassword();
			
			$user = User::create(array(
				'unique_id'		=> $unique_id,
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
			
			return Redirect::to('add-patient')->with('unique_id', $unique_id)->with('password', $password);
		}
	}
	
	// Show remove patient
	public function showRemovePatient() {
		$unique_id = Session::get('unique_id');
		if ($unique_id) {
			return View::make('staff-remove-patient-results', array(
				'title'		=> 'Patient Removed',
				'unique_id'	=> $unique_id,
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
			'unique_id'		=> 'required|numeric',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('remove-patient')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique_id = Input::get('unique_id');
			$patient = Patient::find($unique_id);
			if (!empty($patient)) {
				$patient->user()->delete();
				return Redirect::to('remove-patient')->with('unique_id', $unique_id);
			} else {
				return Redirect::to('remove-patient')->withErrors(array('failedIdMatch' => 'Patient ' . $unique_id . ' cannot be removed. No such patient exists in the database.'))->withInput(Input::all());
			}
		}
	}
	
	// Show patient lookup
	public function showPatientLookup() {
		$results = Session::get('results');
		return View::make('staff-patient-lookup', array(
			'title'				=> 'Patient Lookup',
			'genderOptions'		=> array('' => '') + PatientDemographics::getOptions('gender'),
			'raceOptions'		=> array('' => '') + PatientDemographics::getOptions('race'),
			'ethnicityOptions'	=> array('' => '') + PatientDemographics::getOptions('ethnicity'),
			'results'			=> $results,
		));
	}
	
	// Handle patient lookup
	public function handlePatientLookup() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'dob'		=> 'date',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('patient-lookup')->withErrors($validator)->withInput(Input::all());
		} else {
			$results = Patient::where(function ($query) {
				if (Input::get('name') != '') {
					$name = '%' . preg_replace('/[^a-z]*([a-z]+)[^a-z]*/i', '$1%', Input::get('name'));
					$query->where('name', 'like', $name);
				}
				if (Input::get('dob') != '') {
					$query->where('dob', '=', date('Y-m-d', strtotime(Input::get('dob'))));
				}
				if (Input::get('gender')  != '') {
					$query->where('gender', '=', Input::get('gender'));
				}
				if (Input::get('race')  != '') {
					$query->where('race', '=', Input::get('race'));
				}
				if (Input::get('ethnicity')  != '') {
					$query->where('ethnicity', '=', Input::get('ethnicity'));
				}
			})->get();
			return Redirect::to('patient-lookup')->with('results', $results)->withInput(Input::all());
		}
	}
	
	// Show reset patient password
	public function showPatientPassword() {
		$unique_id = Session::get('unique_id');
		$password = Session::get('password');
		if ($unique_id || $password) {
			return View::make('staff-patient-password-results', array(
				'title'		=> 'Password Reset',
				'unique_id'	=> $unique_id,
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
			'unique_id'		=> 'required|numeric',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('patient-password')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique_id = Input::get('unique_id');
			$patient = Patient::find($unique_id);
			if (!empty($patient)) {
				$user = $patient->user;
				
				// Generate a new password
				$password = $this->generatePassword();
				
				// Update the password in the database
				$user->password = Hash::make($password);
				$user->save();
				
				return Redirect::to('patient-password')->with('unique_id', $unique_id)->with('password', $password);
			} else {
				return Redirect::to('patient-password')->withErrors(array('failedIdMatch' => 'The password for patient ' . $unique_id . ' cannot be reset. No such patient exists in the database.'))->withInput(Input::all());
			}
		}
	}
	
	// Show add clinician
	public function showAddClinician() {
		$unique_id = Session::get('unique_id');
		if ($unique_id) {
			return View::make('staff-add-clinician-results', array(
				'title'		=> 'Clinician Added',
				'unique_id'	=> $unique_id,
			));
		} else {
			return View::make('staff-add-clinician', array(
				'title'	=> 'Add Clinician',
			));
		}
	}
	
	// Handle add clinician
	public function handleAddClinician() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique_id'		=> 'required|alpha',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('add-clinician')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique_id = Input::get('unique_id');
			
			// Throw error if uniquename is already in the database
			$user = User::where('unique_id', '=', $unique_id)->first();
			if (!empty($user)) {
				return Redirect::to('add-clinician')->withErrors(array('duplicateUniquename' => 'The user "' . $unique_id . '" already exists in the database and cannot be added as a clinician.'))->withInput(Input::all());
			}
			
			$user = User::create(array(
				'unique_id'		=> $unique_id,
				'type'			=> '1',
				'password'		=> Hash::make('capnat'),
			));
			$staff = new Staff(array(
				'role'			=> '0',
			));
			$user->userData()->save($staff);
			
			return Redirect::to('add-clinician')->with('unique_id', $unique_id);
		}
	}
	
	// Show remove clinician
	public function showRemoveClinician() {
		$unique_id = Session::get('unique_id');
		if ($unique_id) {
			return View::make('staff-remove-clinician-results', array(
				'title'		=> 'Clinician Removed',
				'unique_id'	=> $unique_id,
			));
		} else {
			return View::make('staff-remove-clinician', array(
				'title'	=> 'Remove Clinician',
			));
		}
	}
	
	// Handle remove clinician
	public function handleRemoveClinician() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique_id'		=> 'required|alpha',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('remove-clinician')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique_id = Input::get('unique_id');
			$user = User::where('unique_id', '=', $unique_id)->first();
			if (!empty($user)) {
				if ($user->userData->role == '0') {
					$user->delete();
					return Redirect::to('remove-clinician')->with('unique_id', $unique_id);
				}
			}
			return Redirect::to('remove-clinician')->withErrors(array('failedIdMatch' => 'Clinician ' . $unique_id . ' cannot be removed. No such clinician exists in the database.'))->withInput(Input::all());
		}
	}
	
	// Show add research staff
	public function showAddStaff() {
		$unique_id = Session::get('unique_id');
		if ($unique_id) {
			return View::make('staff-add-staff-results', array(
				'title'		=> 'Research Staff Added',
				'unique_id'	=> $unique_id,
			));
		} else {
			return View::make('staff-add-staff', array(
				'title'	=> 'Add Research Staff',
			));
		}
	}
	
	// Handle add research staff
	public function handleAddStaff() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique_id'		=> 'required|alpha',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('add-staff')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique_id = Input::get('unique_id');
			
			// Throw error if uniquename is already in the database
			$user = User::where('unique_id', '=', $unique_id)->first();
			if (!empty($user)) {
				return Redirect::to('add-staff')->withErrors(array('duplicateUniquename' => 'The user "' . $unique_id . '" already exists in the database and cannot be added as a research staff.'))->withInput(Input::all());
			}
			
			$user = User::create(array(
				'unique_id'		=> $unique_id,
				'type'			=> '1',
				'password'		=> Hash::make('capnat'),
			));
			$staff = new Staff(array(
				'role'			=> '1',
			));
			$user->userData()->save($staff);
			
			return Redirect::to('add-staff')->with('unique_id', $unique_id);
		}
	}
	
	// Show remove research staff
	public function showRemoveStaff() {
		$unique_id = Session::get('unique_id');
		if ($unique_id) {
			return View::make('staff-remove-staff-results', array(
				'title'		=> 'Research Staff Removed',
				'unique_id'	=> $unique_id,
			));
		} else {
			return View::make('staff-remove-staff', array(
				'title'	=> 'Remove Research Staff',
			));
		}
	}
	
	// Handle remove research staff
	public function handleRemoveStaff() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique_id'		=> 'required|alpha',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('remove-staff')->withErrors($validator)->withInput(Input::all());
		} else {
			$unique_id = Input::get('unique_id');
			$user = User::where('unique_id', '=', $unique_id)->first();
			if (!empty($user)) {
				if ($user->userData->role == '1') {
					$user->delete();
					return Redirect::to('remove-staff')->with('unique_id', $unique_id);
				}
			}
			return Redirect::to('remove-staff')->withErrors(array('failedIdMatch' => 'Research staff ' . $unique_id . ' cannot be removed. No such research staff exists in the database.'))->withInput(Input::all());
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
