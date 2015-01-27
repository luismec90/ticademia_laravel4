<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMaterialQuizTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('material_quiz', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('material_id')->unsigned()->index();
			$table->foreign('material_id')->references('id')->on('materials')->onDelete('cascade');
			$table->integer('quiz_id')->unsigned()->index();
			$table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('material_quiz');
	}

}
