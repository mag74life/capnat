<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Exam extends Eloquent {

	protected $table = 'exams';
	protected $fillable = array('survey_score', 'assessment_score');

	public function patient()
	{
		return $this->belongsTo('Patient');
	}
	
}
