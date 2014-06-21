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
			'only' => array(
				'showSurvey',
				'handleSurvey'
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
		$survey = new Survey();
		$results = Session::get('results');
		if ($results != '') { // Show the results page
			return View::make('patient-survey-results', array(
				'title'		=> 'Survey Results',
				'questions'	=> $survey->questions,
				'results'	=> $results,
			));
		} else { // Show the survey form
			return View::make('patient-survey', array(
				'title'		=> 'Survey',
				'survey'	=> $survey,
			));
		}
	}
	
	// Handle patient survey
	public function handleSurvey() {
		// Form validation
		$rules = array();
		for ($i = 0; $i < Config::get('app.surveyLength'); $i++) {
			$rules['q' . $i] = 'required';
		}
		$validator = Validator::make(Input::all(), $rules);
		
		// Redirect back to the form if validation fails
		if ($validator->fails()) {
			return Redirect::to('survey')->withErrors($validator)->withInput(Input::all());
		} else {
			$survey = new Survey();
			$fields = array();
			$scaleTotals = array(0, 0, 0);
			$surveyTotal = 0;
			$allInput = Input::all();
			for ($i = 0; $i < Config::get('app.surveyLength'); $i++) {
				$fields['survey_q' . $i] = $allInput['q' . $i];
				$scaleTotals[$survey->questions[$i]->scale] += $allInput['q' . $i];
				$surveyTotal += $allInput['q' . $i];
			}
			$fields['survey_scale0'] = $scaleTotals[0];
			$fields['survey_scale1'] = $scaleTotals[1];
			$fields['survey_scale2'] = $scaleTotals[2];
			$fields['survey_total'] = $surveyTotal;
			$exam = new Exam($fields);
			$patient = Auth::user()->userData;
			$patient->exams()->save($exam);
			return Redirect::to('survey')->with('results', $fields);
		}
	}
}

class Survey {
	public $questions = array();
	
	public $choices = array(
		'Not at all',
		'A little',
		'Quite a bit',
		'Very much',
	);

	public function __construct() {
		$this->questions[] = new Question('Did you have tingling fingers or hands?', 0);
		$this->questions[] = new Question('Did you have tingling toes or feet', 0);
		$this->questions[] = new Question('Did you have numbness in your fingers or hands?', 0);
		$this->questions[] = new Question('Did you have numbness in your toes or feet?', 0);
		$this->questions[] = new Question('Did you have shooting or burning pain in your fingers or hands?', 0);
		$this->questions[] = new Question('Did you have shooting or burning pain in your toes or feet?', 0);
		$this->questions[] = new Question('Did you have cramps in your hands?', 1);
		$this->questions[] = new Question('Did you have cramps in your feet?', 1);
		$this->questions[] = new Question('Did you have problems standing or walking because of difficulty feeling the ground under your feet?', 0);
		$this->questions[] = new Question('Did you have difficulty distinguishing between hot and cold water?', 0);
		$this->questions[] = new Question('Did you have a problem holding a pen, which made writing difficult?', 1);
		$this->questions[] = new Question('Did you have difficulty manipulating small objects with your fingers (for example, fastening small buttons)?', 1);
		$this->questions[] = new Question('Did you have difficulty opening a jar or bottle because of weakness in your hands?', 1);
		$this->questions[] = new Question('Did you have difficulty walking because your feed dropped downwards?', 1);
		$this->questions[] = new Question('Did you have difficulty climbing stairs or getting up out of a chair because of weakness in your legs?', 1);
		$this->questions[] = new Question('Were you dizzy when standing up from a sitting or lying position?', 2);
		$this->questions[] = new Question('Did you have blurred vision?', 2);
		$this->questions[] = new Question('Did you have difficulty hearing?', 0);
		$this->questions[] = new Question('Please answer the following question only if you drive a car. Did you have difficulty using pedals?', 1);
		$this->questions[] = new Question('Please answer the following question only if you are a man. Did you have difficulty getting or maintaining an erection?', 2);
	}
}

class Question {
	public $question;
	public $scale;
	
	public function __construct($q, $s) {
		$this->question = $q;
		$this->scale = $s;
	}
}