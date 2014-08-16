<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patients', function($table) {
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->string('name', 60);
			$table->date('dob');
			$table->char('gender', 1);
			$table->char('race', 1);
			$table->char('ethnicity', 1);
			$table->char('education', 1);
			$table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('patients');
	}

}
