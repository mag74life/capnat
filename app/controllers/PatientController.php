<?php

class PatientController extends BaseController {

	public function __construct() {
		// Only allow guests to access the login page
		$this->beforeFilter('guest', array(
			'only' => array(
				'showLogin',
				'handleLogin'
			),
		));
		
		// Only allow logged in patients to access the patient survey
		$this->beforeFilter('patient', array(
			'except' => array(
				'showLogin',
				'handleLogin'
			),
		));
	}
	
	// Show patient login
	public function showLogin() {
		return View::make('patient-login', array(
			'title'	=> 'Login',
		));
	}
	
	// Handle patient login
	public function handleLogin() {
		// Form validation
		$validator = Validator::make(Input::all(), array(
			'unique_id'	=> 'required',
			'password'	=> 'required',
		));
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
		} else {
			$userdata = array(
				'unique_id'	=> Input::get('unique_id'),
				'password'	=> Input::get('password'),
				'type'		=> 0,
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
		Session::flush();
		Auth::logout();
		return Redirect::to('login');
	}
	
	// Show patient dashboard
	public function showDashboard() {
		$vars = array(
			'title'			=> 'Dashboard',
			'newSurvey'		=> false,
			'reviseExam'	=> null,
		);
		$user = Auth::user();
		$newest = $user->userData->exams->first(); // Grab the most recent survey
		if ($newest == null || $newest->survey_total != null && $newest->assessment_total != null || $newest->survey_total == 0) { // Patient can start a new survey
			$option = 'Start a new survey';
		} else if ($newest->assessment_total == null) { // Patient can revise the most recent survey
			$option = 'Revise survey';
		}
		
		// Can the patient start a new survey?
		if ($newest == null || $newest->survey_total == 0 || $newest->assessment_total != null) {
			$vars['newSurvey'] = true;
		}
		
		// Can the patient revise the latest survey?
		if ($newest != null && $newest->assessment_total == null) {
			$vars['reviseExam'] = $newest->id;
		}
		
		$vars['name'] = $user->userData->name;
		$vars['exams'] = $user->userData->exams;
		return View::make('patient-dashboard', $vars);
	}
	
	// Show patient survey
	public function showSurvey() {
		$results = Session::get('results');
		if ($results != '') { // Show the results page
			return View::make('patient-survey-results', array(
				'title'		=> 'Survey Results',
				'questions'	=> PatientSurvey::getQuestions(),
				'results'	=> $results,
			));
		} else { // Show the survey form
			$vars = array(
				'title'		=> 'Survey',
				'exam'		=> null,
			);
			$user = Auth::user();
			$newest = $user->userData->exams->first(); // Grab the most recent survey
			if (Route::currentRouteName() == 'survey.new') {
				// Redirect to dashboard if patient cannot start new survey at this time
				if ($newest != null && $newest->survey_total != 0 && $newest->assessment_total == null) {
					return Redirect::route('dashboard');
				}
				$vars['route'] = 'survey.new';
			} else {
				// Redirect to dashboard if patient cannot revise the latest survey at this time
				if ($newest == null || $newest->assessment_total != null) {
					return Redirect::route('dashboard');
				}
				$vars['exam'] = $newest;
				$vars['route'] = 'survey.revise';
			}
			$vars['questions'] = PatientSurvey::getQuestions();
			$vars['choices'] = PatientSurvey::getChoices();
			return View::make('patient-survey', $vars);
		}
	}
	
	// Handle patient survey
	public function handleSurvey() {
		$questions = PatientSurvey::getQuestions();
		$route = Route::currentRouteName();
		
		// Form validation
		$rules = array();
		for ($i = 0; $i < count($questions); $i++) {
			$rules['survey_q' . $i] = 'required';
		}
		$validator = Validator::make(Input::all(), $rules);
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::route($route)->withErrors($validator)->withInput(Input::all());
		} else {
			$fields = array();
			$scaleTotals = array(0, 0, 0);
			$surveyTotal = 0;
			$allInput = Input::all();
			for ($i = 0; $i < count($questions); $i++) {
				$fields['survey_q' . $i] = $allInput['survey_q' . $i];
				$scaleTotals[$questions[$i]['scale']] += $allInput['survey_q' . $i];
				$surveyTotal += $allInput['survey_q' . $i];
			}
			$fields['survey_scale0'] = $scaleTotals[0];
			$fields['survey_scale1'] = $scaleTotals[1];
			$fields['survey_scale2'] = $scaleTotals[2];
			$fields['survey_total'] = $surveyTotal;
			$user = Auth::user();
			$newest = $user->userData->exams->first(); // Grab the most recent survey
			if ($route == 'survey.new') {
				// Redirect to dashboard if patient cannot start new survey at this time
				if ($newest != null && $newest->survey_total != 0 && $newest->assessment_total == null) {
					return Redirect::route('dashboard');
				}
				$exam = new Exam($fields);
				$patient = Auth::user()->userData;
				$patient->exams()->save($exam);
			} else {
				// Redirect to dashboard if patient cannot revise the latest survey at this time
				if ($newest == null || $newest->assessment_total != null) {
					return Redirect::route('dashboard');
				}
				$exam = Exam::find($newest->id);
				$exam->update($fields);
			}
			return Redirect::route($route)->with('results', $fields);
		}
	}
	
}