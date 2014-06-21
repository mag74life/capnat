<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Exam extends Eloquent {

	protected $table = 'exams';
	protected $guarded = array('id', 'patient_id', 'created_at', 'updated_at');

	public function patient()
	{
		return $this->belongsTo('Patient');
	}
	
	public function score() {
		$score = 0;
		for ($i = 0; $i < Config::get('app.surveyLength'); $i++) {
			$q = $this->{'survey_q' . $i};
			if (!isset($q)) {
				return NULL;
			}
			$score += $q;
		}
		$this->update(array('survey_total' => $score));
		return $score;
	}
	
}
