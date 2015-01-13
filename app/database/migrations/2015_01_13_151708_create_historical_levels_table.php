<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHistoricalLevelsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historical_levels', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('course_id')->unsigned()->index();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('level_id')->unsigned()->index();;
            $table->foreign('level_id')->references('id')->on('levels')->onDelete('cascade');
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
        Schema::drop('historical_levels');
    }

}
