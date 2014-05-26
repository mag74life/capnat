<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exams', function($table) {
			$table->increments('id');
			$table->integer('patient_id')->unsigned();
			$table->tinyInteger('survey_score')->unsigned()->nullable();
			$table->tinyInteger('assessment_score')->unsigned()->nullable();
			$table->timestamps();
			
			$table->foreign('patient_id')->references('id')->on('patients')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exams');
	}

}
