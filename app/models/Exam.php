<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Exam extends Eloquent {

	protected $table = 'exams';

	public function patient()
	{
		return $this->belongsTo('Patient');
	}
	
}
