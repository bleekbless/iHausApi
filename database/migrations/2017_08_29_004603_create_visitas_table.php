<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration
{

    public function up()
    {
        Schema::create('visitas', function(Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->integer('usuario_id')->unsigned();
            $table->integer('vaga_id');
            $table->integer('vaga_id')->unsigned();
            $table->foreign('vaga_id')
                ->references('id')
                ->on('vagas');

        });
    }

    public function down()
    {
        Schema::drop('visitas');
    }
}
