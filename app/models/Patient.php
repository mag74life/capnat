<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Patient extends Eloquent {

	protected $table = 'patients';

	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function exams()
	{
		return $this->hasMany('Exam');
	}
	
}
