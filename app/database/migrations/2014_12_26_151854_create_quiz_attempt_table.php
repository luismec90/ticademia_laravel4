<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuizAttemptTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quiz_attempts', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('quiz_id')->unsigned()->index();
            $table->foreign('quiz_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->float('grade');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('feedback');
            $table->timestamps();
        });

       // DB::statement('ALTER TABLE quiz_attempts MODIFY COLUMN start_date DATETIME(3) NOT NULL');
       // DB::statement('ALTER TABLE quiz_attempts MODIFY COLUMN end_date DATETIME(3) DEFAULT NULL');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('quiz_attempts');
    }

}
