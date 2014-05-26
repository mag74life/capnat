<?php

//Database Seeding
//http://laravel.com/docs/migrations#database-seeding

class UserTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users')->delete();
		User::create(array(
			'unique'		=> 1,
			'type'			=> 0,
			'password'		=> Hash::make('roygbiv'),
		));
	}

}
