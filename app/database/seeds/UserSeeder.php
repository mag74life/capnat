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
			'unique'		=> '1',
			'type'			=> '0',
			'password'		=> Hash::make('roygbiv'),
		));
		$patient = new Patient(array(
			'name'			=> 'John Smith',
		));
		$user->userData()->save($patient);
		
		// Create one clinician
		$user = User::create(array(
			'unique'		=> 'eagard',
			'type'			=> '1',
			'password'		=> Hash::make('capnat'),
		));
		$staff = new Staff(array(
			'role'			=> '1',
		));
		$user->userData()->save($staff);
	}

}
