<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Staff extends Eloquent {

	protected $table = 'staff';
	protected $guarded = array('id', 'user_id', 'created_at', 'updated_at');

	public function user()
	{
		return $this->belongsTo('User');
	}
	
}
