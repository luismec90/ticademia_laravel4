<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoursesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();;
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->smallInteger('levels');
            $table->string('type_of_registration');
            $table->float('threshold');
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
        Schema::drop('courses');
    }

}
