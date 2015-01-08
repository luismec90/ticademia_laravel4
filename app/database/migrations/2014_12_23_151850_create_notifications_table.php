<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('url');
            $table->string('image');
            $table->string('title');
            $table->string('body');
            $table->string('extra_info', 512);
            $table->boolean('viewed')->default(0);
            $table->boolean('show_modal')->default(0);
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
        Schema::drop('notifications');
    }

}
