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
	
	/* Accessors */
	
	public function getGenderAttribute($value) {
		return PatientDemographics::getOptions('gender')[$value];
	}
	
	public function getRaceAttribute($value) {
		return PatientDemographics::getOptions('race')[$value];
	}
	
	public function getEthnicityAttribute($value) {
		return PatientDemographics::getOptions('ethnicity')[$value];
	}
	
	public function getEducationAttribute($value) {
		return PatientDemographics::getOptions('education')[$value];
	}
	
}
