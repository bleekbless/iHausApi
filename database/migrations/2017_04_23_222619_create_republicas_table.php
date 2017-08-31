<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepublicasTable extends Migration
{

    public function up()
    {
        Schema::create('republicas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nomeRepublica', 100);
            $table->string('curso', 100)->nullable();
            $table->tinyInteger('quantidadeQuartos');
            $table->tinyInteger('quantidadeMoradores')->nullable();
            $table->text('descricao');
            $table->integer('tipo_republica')->unsigned();
            $table->integer('universidade_id')->unsigned()->nullable();
            $table->integer('endereco_id')->unsigned();
            $table->uuid('usuario_id');

            $table->foreign('tipo_republica')
                ->references('id')
                ->on('tipoRepublicas');

            $table->foreign('universidade_id')
                ->references('id')
                ->on('universidades');

            $table->foreign('endereco_id')
                ->references('id')
                ->on('enderecos');

            $table->foreign('usuario_id')
                ->references('id')
                ->on('usuarios');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('republicas');
    }
}
