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
		Auth::logout();
		return Redirect::to('login');
	}
	
	// Show patient dashboard
	public function showDashboard() {
		$user = Auth::user();
		$newest = $user->userData->exams->first();
		$option = NULL;
		if ($newest == NULL || $newest->survey_total != NULL && $newest->assessment_total != NULL) { // Patient can start a new survey
			$option = 'Start a new survey';
		} else if ($newest->assessment_total == NULL) { // Patient can revise the most recent survey
			$option = 'Revise survey';
		} else { // Patient can continue the current, incomplete survey
			$option = 'Continue survey';
		}
		return View::make('patient-dashboard', array(
			'title'		=> 'Dashboard',
			'name'		=> $user->userData->name,
			'exams'		=> $user->userData->exams,
			'option'	=> $option,
		));
	}
	
	// Show patient survey
	public function showSurvey($page = 1) {
		/*
		$surveyLength = Config::get('app.surveyLength');
	
		// Throw 404 if going to an invalid page
		if ($page < 1 || $page > $surveyLength) {
			throw new NotFoundHttpException;
		}
		*/
		$results = Session::get('results');
		if ($results != '') { // Show the results page
			return View::make('patient-survey-results', array(
				'title'		=> 'Survey Results',
				'questions'	=> PatientSurvey::getQuestions(),
				'results'	=> $results,
			));
		} else { // Show the survey form
			$user = Auth::user();
			$newest = $user->userData->exams->first(); // Grab the most recent survey
			$questions = PatientSurvey::getQuestions();
			$choices = PatientSurvey::getChoices();
			$exam = $newest;
			if ($newest == NULL || $newest->survey_total != NULL && $newest->assessment_total != NULL) { // Patient can start a new survey
				$exam = NULL;
			} else if ($newest->assessment_total == NULL) { // Patient can revise the most recent survey
				
			} else { // Patient can continue the current, incomplete survey
				
			}
			return View::make('patient-survey', array(
				'title'		=> 'Survey',
				'questions'	=> $questions,
				'choices'	=> $choices,
				'exam'		=> $exam,
			));
		}
	}
	
	// Handle new patient survey
	public function handleSurvey() {
		$questions = PatientSurvey::getQuestions();
		
		// Form validation
		$rules = array();
		for ($i = 0; $i < count($questions); $i++) {
			$rules['survey_q' . $i] = 'required';
		}
		$validator = Validator::make(Input::all(), $rules);
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('survey')->withErrors($validator)->withInput(Input::all());
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
			if ($newest == NULL || $newest->survey_total != NULL && $newest->assessment_total != NULL) { // Create new exam
				$exam = new Exam($fields);
				$patient = Auth::user()->userData;
				$patient->exams()->save($exam);
			} else { // Revise existing exam
				$exam = Exam::find($newest->id);
				$exam->update($fields);
			}
			return Redirect::to('survey')->with('results', $fields);
		}
	}
	
}