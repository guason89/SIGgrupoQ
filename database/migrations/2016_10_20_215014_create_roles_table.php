<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('perfiles', function (Blueprint $table) {
            $table->integer('id');
            $table->string('nombre',20)->unique();
            $table->string('descripcion');
          
            $table->timestamps();

           $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('perfiles');
    }
}
