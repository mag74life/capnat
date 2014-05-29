<?php

// The homepage will show the user dashboard when the user is logged in
class HomeController extends BaseController {

	public function __construct() {
		//Only allow authenticated users
		$this->beforeFilter('auth');
	}

	// Show the homepage
	public function showIndex() {
		// Direct the user to the appropriate dashboard
		if (Auth::user()->type == '0') {
			$user = Auth::user();
			$patient = $user->userData;
			$name = $patient->name;
			$exams = $patient->exams;
			return View::make('patient-dashboard', array(
				'title'		=> 'Dashboard',
				'user'		=> $user,
				'patient'	=> $patient,
				'name'		=> $name,
				'exams'		=> $exams,
			));
		} else {
			return View::make('staff-dashboard', array(
				'title'	=> 'Dashboard',
			));
		}
	}

}
