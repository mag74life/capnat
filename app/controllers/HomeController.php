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
			return View::make('patient-dashboard', array(
				'title'	=> 'Dashboard',
			));
		} else {
			return View::make('staff-dashboard', array(
				'title'	=> 'Dashboard',
			));
		}
	}

}
