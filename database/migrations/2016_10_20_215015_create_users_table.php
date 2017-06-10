<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',60);
            $table->string('email',60);
            $table->string('usuario',30)->unique();
            $table->string('password',64);
            $table->boolean('activo');
            $table->integer('idPerfil');            
            $table->rememberToken();
            $table->timestamps();

            //$table->primary('id');
            $table->foreign('idPerfil')->references('id')->on('perfiles');                      
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('usuarios');
    }
}
