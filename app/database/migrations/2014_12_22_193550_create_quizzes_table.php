<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizzesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('module_id')->unsigned()->index();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->integer('quiz_type_id')->unsigned()->index();
            $table->foreign('quiz_type_id')->references('id')->on('quiz_types')->onDelete('cascade');
            $table->integer('topic_id')->unsigned()->index()->nullable();
            $table->foreign('topic_id')->references('id')->on('topics')->onDelete('set null');
            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->decimal('best_time',8,3)->nullable();
            $table->integer('order');
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
        Schema::drop('quizzes');
    }

}
