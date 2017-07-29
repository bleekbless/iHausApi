<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVagasTable extends Migration
{

    public function up()
    {
        Schema::create('vagas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 100);
            $table->string('tipo', 100);
            $table->float('valor');
            $table->date('data');
            $table->boolean('vaga_garagem')->default(0);
            $table->integer('republica_id')->unsigned();
            $table->foreign('republica_id')
                ->references('id')
                ->on('republicas');

        });
    }

    public function down()
    {
        Schema::drop('vagas');
    }
}
