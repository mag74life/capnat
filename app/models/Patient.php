<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Patient extends Eloquent {

	protected $table = 'patients';
	protected $guarded = array('id', 'user_id', 'created_at', 'updated_at');

	public function user() {
		return $this->belongsTo('User');
	}
	
	public function exams() {
		return $this->hasMany('Exam')->orderBy('created_at', 'desc');
	}
	
}
