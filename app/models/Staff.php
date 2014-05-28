<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Staff extends Eloquent {

	protected $table = 'staff';

	public function user()
	{
		return $this->belongsTo('User');
	}
	
}
