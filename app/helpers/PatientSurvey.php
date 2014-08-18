<?php

class PatientSurvey {

	// Questions
	private static $questions = array(
		array('question' => 'Did you have tingling fingers or hands?', 'scale' => 0),
		array('question' => 'Did you have tingling toes or feet?', 'scale' => 0),
		array('question' => 'Did you have numbness in your fingers or hands?', 'scale' => 0),
		array('question' => 'Did you have numbness in your toes or feet?', 'scale' => 0),
		array('question' => 'Did you have shooting or burning pain in your fingers or hands?', 'scale' => 0),
		array('question' => 'Did you have shooting or burning pain in your toes or feet?', 'scale' => 0),
		array('question' => 'Did you have cramps in your hands?', 'scale' => 1),
		array('question' => 'Did you have cramps in your feet?', 'scale' => 1),
		array('question' => 'Did you have problems standing or walking because of difficulty feeling the ground under your feet?', 'scale' => 0),
		array('question' => 'Did you have difficulty distinguishing between hot and cold water?', 'scale' => 0),
		array('question' => 'Did you have a problem holding a pen, which made writing difficult?', 'scale' => 1),
		array('question' => 'Did you have difficulty manipulating small objects with your fingers (for example, fastening small buttons)?', 'scale' => 1),
		array('question' => 'Did you have difficulty opening a jar or bottle because of weakness in your hands?', 'scale' => 1),
		array('question' => 'Did you have difficulty walking because your feed dropped downwards?', 'scale' => 1),
		array('question' => 'Did you have difficulty climbing stairs or getting up out of a chair because of weakness in your legs?', 'scale' => 1),
		array('question' => 'Were you dizzy when standing up from a sitting or lying position?', 'scale' => 2),
		array('question' => 'Did you have blurred vision?', 'scale' => 2),
		array('question' => 'Did you have difficulty hearing?', 'scale' => 0),
		array('question' => 'Please answer the following question only if you drive a car. Did you have difficulty using pedals?', 'scale' => 1),
		array('question' => 'Please answer the following question only if you are a man. Did you have difficulty getting or maintaining an erection?', 'scale' => 2),		
	);
	
	// Choices
	private static $choices = array(
		0 => 'Not at all',
		1 => 'A little',
		2 => 'Quite a bit',
		3 => 'Very much',
	);
	
	public static function getQuestions() {
		return self::$questions;
	}
	
	public static function getChoices() {
		return self::$choices;
	}
	
}