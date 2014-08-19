<?php

//Database Seeding
//http://laravel.com/docs/migrations#database-seeding

class UserSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
		DB::table('patients')->delete();
		DB::table('staff')->delete();
		
		// Create one patient
		$user = User::create(array(
			'unique_id'		=> '1',
			'type'			=> '0',
			'password'		=> Hash::make('roygbiv'),
		));
		$patient = new Patient(array(
			'name'			=> 'John Smith',
			'dob'			=> '1974-03-15',
			'gender'		=> 0,
			'race'			=> 0,
			'ethnicity'		=> 1,
			'education'		=> 5,
		));
		$user->userData()->save($patient);
		
		// Create one clinician
		$user = User::create(array(
			'unique_id'		=> 'eagard',
			'type'			=> '1',
			'password'		=> Hash::make('capnat'),
		));
		$staff = new Staff(array(
			'role'			=> '0',
		));
		$user->userData()->save($staff);
	}

}
