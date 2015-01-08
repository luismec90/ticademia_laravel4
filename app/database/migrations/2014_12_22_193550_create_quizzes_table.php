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
            $table->integer('module_id')->unsigned();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->integer('quiz_type_id')->unsigned();
            $table->foreign('quiz_type_id')->references('id')->on('quiz_types')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
