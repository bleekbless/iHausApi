<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioVagaTable extends Migration
{

    public function up()
    {
        Schema::create('usuario_vaga', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned()->index();
            $table->integer('vaga_id')->unsigned()->index();
            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios');
            $table->foreign('vaga_id')
                ->references('id')
                ->on('vagas');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('usuario_vaga');
    }
}
