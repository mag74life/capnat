<?php

class ClinicianAssessment {

	// Questions
	private static $questions = array(
		'Tingling',
		'Numbness',
		'Neuropathic pain (burning, shooting, aching, stabbing)',
	);
	
	// Choices
	private static $choices = array(
		array(
			0 => 'No symptoms',
			1 => 'Symptoms to toes to mid-foot (not including the heel)',
			2 => 'Symptoms from mid-foot to ankle',
			3 => 'Symptoms extend above ankle to the knee without upper extremity symptoms',
			4 => 'Symptoms above the knee or concurrent lower and upper extremity symptoms',
			'x' => 'Unable to assess',
		),
		array(
			0 => 'Normal',
			1 => 'Absent/decreased from toes to mid-foot (not including the heel)',
			2 => 'Absent/decreased from mid-foot to ankle',
			3 => 'Absent/decreased above ankle to the knee',
			4 => 'Absent/decreased above the knee or in lower and upper extremities concurrently',
			'x' => 'Unable to assess',
		),
		array(
			0 => 'All reflexes normal',
			1 => 'Ankle reflex reduced',
			2 => 'Ankle reflex absent',
			3 => 'All reduced',
			4 => 'All reflexes absent',
			'x' => 'Unable to assess',
		),
	);
	
	public static function getQuestions() {
		return self::$questions;
	}
	
	public static function getChoices() {
		return self::$choices;
	}
	
}