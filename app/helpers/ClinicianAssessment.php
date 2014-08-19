<?php

class ClinicianAssessment {

	// Questions
	private static $questions = array(
		0 => 'Tingling',
		1 => 'Numbness',
		2 => 'Neuropathic pain (burning, shooting, aching, stabbing)',
		3 => 'Rating for neuropathic pain (0 = No pain, 10 = Pain as bad as you can imagine)',
		4 => 'Vibration sensibility',
		5 => 'Tendon reflexes',
	);
	
	// Choices
	private static $choices = array(
		0 => array(
			0 => 'No symptoms',
			1 => 'Symptoms to toes to mid-foot (not including the heel)',
			2 => 'Symptoms from mid-foot to ankle',
			3 => 'Symptoms extend above ankle to the knee without upper extremity symptoms',
			4 => 'Symptoms above the knee or concurrent lower and upper extremity symptoms',
			99 => 'Unable to assess',
		),
		1 => array(
			0 => 'No symptoms',
			1 => 'Symptoms to toes to mid-foot (not including the heel)',
			2 => 'Symptoms from mid-foot to ankle',
			3 => 'Symptoms extend above ankle to the knee without upper extremity symptoms',
			4 => 'Symptoms above the knee or concurrent lower and upper extremity symptoms',
			99 => 'Unable to assess',
		),
		2 => array(
			0 => 'No symptoms',
			1 => 'Symptoms to toes to mid-foot (not including the heel)',
			2 => 'Symptoms from mid-foot to ankle',
			3 => 'Symptoms extend above ankle to the knee without upper extremity symptoms',
			4 => 'Symptoms above the knee or concurrent lower and upper extremity symptoms',
			99 => 'Unable to assess',
		),
		3 => array(
			0 => '0',
			1 => '1',
			2 => '2',
			3 => '3',
			4 => '4',
			5 => '5',
			6 => '6',
			7 => '7',
			8 => '8',
			9 => '9',
			10 => '10',
		),
		4 => array(
			0 => 'Normal',
			1 => 'Absent/decreased from toes to mid-foot (not including the heel)',
			2 => 'Absent/decreased from mid-foot to ankle',
			3 => 'Absent/decreased above ankle to the knee',
			4 => 'Absent/decreased above the knee or in lower and upper extremities concurrently',
			99 => 'Unable to assess',
		),
		5 => array(
			0 => 'All reflexes normal',
			1 => 'Ankle reflex reduced',
			2 => 'Ankle reflex absent',
			3 => 'All reduced',
			4 => 'All reflexes absent',
			99 => 'Unable to assess',
		),
	);
	
	public static function getQuestions() {
		return self::$questions;
	}
	
	public static function getChoices() {
		return self::$choices;
	}
	
}