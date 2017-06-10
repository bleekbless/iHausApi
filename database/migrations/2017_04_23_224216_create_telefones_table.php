<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTelefonesTable extends Migration
{

    public function up()
    {
        Schema::create('telefones', function(Blueprint $table) {

            $table->increments('id');

            $table->unsignedSmallInteger('idTipoTelefone');

            $table->unsignedInteger('idUsuario')
                ->nullable();

            $table->unsignedInteger('universidade_id')
                ->nullable();

            $table->unsignedInteger('republica_id')
                ->nullable();

            $table->string('numeroTelefone', 50);


            // Constraints declaration
            $table->timestamps();

            $table->foreign('idTipoTelefone')
                ->references('id')
                ->on('tipotelefones')
                ->onDelete('cascade');

            $table->foreign('idUsuario')
                ->references('id')
                ->on('usuarios')
                ->onDelete('cascade');

            $table->foreign('universidade_id')
                ->references('id')
                ->on('universidades')
                ->onDelete('cascade');
                
            $table->foreign('republica_id')
                ->references('id')
                ->on('republicas')
                ->onDelete('cascade');

                

        });
    }

    public function down()
    {
        Schema::dropIfExists('telefones');
    }
}
