<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table)
        {
            $table->increments('id');
            $table->string('nombres', 45);
            $table->string('apellidos', 45);
            $table->date('fecha_nacimiento');
            $table->string('sexo', '1');
            $table->string('email')->unique();
            $table->string('imagen', 15);
            $table->string('password', 60);
            $table->boolean('activo');
            $table->rememberToken();
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
        Schema::drop('users');
    }

}
