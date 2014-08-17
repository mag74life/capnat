<?php

class PatientHelper {

	// Demographic options
	private static $demoOpts = array(
		'gender' => array(
			0 => 'Male',
			1 => 'Female',
			2 => 'Other',
		),
		'race' => array(
			0 => 'Caucasian',
			1 => 'African American',
			2 => 'Native American',
			3 => 'Asian',
			4 => 'Latino/Hispanic',
			5 => 'Multiracial',
			6 => 'Other',
		),
		'ethnicity' => array(
			0 => 'Hispanic',
			1 => 'Non-Hispanic',
		),
		'education' => array(
			0 => 'Less than high school',
			1 => 'Some high school',
			2 => 'Graduated from high school',
			3 => 'Some college',
			4 => 'Completed an undergraduate associate degree',
			5 => 'Completed an undergraduate bachelors degree',
			6 => 'Some graduate school',
			7 => 'Completed a masters degree',
			8 => 'Completed a doctoral degree',
		),
	);
	
	public static function getOptions($opt) {
		return self::$demoOpts[$opt];
	}

}