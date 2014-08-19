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
			for ($i = 0; $i < count(PatientSurvey::getQuestions()); $i++) {
				$table->tinyInteger('survey_q' . $i)->unsigned()->nullable();
			}
			$table->tinyInteger('survey_scale0')->unsigned()->nullable();
			$table->tinyInteger('survey_scale1')->unsigned()->nullable();
			$table->tinyInteger('survey_scale2')->unsigned()->nullable();
			$table->tinyInteger('survey_total')->unsigned()->nullable();
			for ($i = 0; $i < count(ClinicianAssessment::getQuestions()); $i++) {
				$table->tinyInteger('assessment_q' . $i)->unsigned()->nullable();
			}
			$table->tinyInteger('assessment_total')->unsigned()->nullable();
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
