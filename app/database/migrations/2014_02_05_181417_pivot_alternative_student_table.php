<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class PivotAlternativeStudentTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alternative_student', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('alternative_id')->unsigned()->index();
			$table->integer('student_id')->unsigned()->index();
			$table->foreign('alternative_id')->references('id')->on('alternatives')->onDelete('cascade');
			$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
		});
	}



	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alternative_student');
	}

}
