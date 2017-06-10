<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoRepublicasTable extends Migration
{

    public function up()
    {
        Schema::create('tipoRepublicas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('tipoRepublicas');
    }
}
