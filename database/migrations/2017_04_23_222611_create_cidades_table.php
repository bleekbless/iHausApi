<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCidadesTable extends Migration
{

    public function up()
    {
        Schema::create('cidades', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nomeCidade', 100);
            $table->integer('estado_id')->unsigned();
            $table->foreign('estado_id')
                ->references('id')
                ->on('estados');

        });
    }

    public function down()
    {
        Schema::drop('cidades');
    }
}
