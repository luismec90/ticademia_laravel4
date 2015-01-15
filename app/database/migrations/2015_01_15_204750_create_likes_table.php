<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLikesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('likes', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('wall_message_id')->unsigned()->index()->nullable();
            $table->foreign('wall_message_id')->references('id')->on('wall_messages')->onDelete('cascade');
            $table->integer('topic_reply_id')->unsigned()->index()->nullable();
            $table->foreign('topic_reply_id')->references('id')->on('topic_replies')->onDelete('cascade');
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
        Schema::drop('likes');
    }

}
