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
			'password'		=> Hash::make('capnat'),
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
		
		// Create a clinician for each role
		$user = User::create(array(
			'unique_id'		=> 'staff0',
			'type'			=> '1',
			'password'		=> Hash::make('capnat'),
		));
		$staff = new Staff(array(
			'role'			=> '0',
		));
		$user->userData()->save($staff);
		
		$user = User::create(array(
			'unique_id'		=> 'staff1',
			'type'			=> '1',
			'password'		=> Hash::make('capnat'),
		));
		$staff = new Staff(array(
			'role'			=> '1',
		));
		$user->userData()->save($staff);
		
		$user = User::create(array(
			'unique_id'		=> 'staff2',
			'type'			=> '1',
			'password'		=> Hash::make('capnat'),
		));
		$staff = new Staff(array(
			'role'			=> '2',
		));
		$user->userData()->save($staff);
		
		$user = User::create(array(
			'unique_id'		=> 'staff3',
			'type'			=> '1',
			'password'		=> Hash::make('capnat'),
		));
		$staff = new Staff(array(
			'role'			=> '3',
		));
		$user->userData()->save($staff);
	}

}
