<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDuelsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duels', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->index();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('quiz_id')->unsigned()->index();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->integer('defiant_user_id')->unsigned()->index()->nullable();
            $table->foreign('defiant_user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('opponent_user_id')->unsigned()->index()->nullable();
            $table->foreign('opponent_user_id')->references('id')->on('users')->onDelete('set null');
            $table->integer('bet')->integer();
            $table->integer('winner_user_id')->unsigned()->index()->nullable();
            $table->foreign('winner_user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::drop('duels');
    }

}
