<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Staff extends Eloquent {

	protected $table = 'staff';
	protected $fillable = array('role');

	public function user()
	{
		return $this->belongsTo('User');
	}
	
}
