<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenienciasTable extends Migration
{

    public function up()
    {
        Schema::create('conveniencias', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricaoConveniencia');
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('conveniencias');
    }
}
