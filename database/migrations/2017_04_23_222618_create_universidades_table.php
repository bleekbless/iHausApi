<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUniversidadesTable extends Migration
{

    public function up()
    {
        Schema::create('universidades', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nomeUniversidade', 100);
            $table->string('cnpj', 20);
            $table->string('sigla', 10);
            $table->integer('endereco_id')->unsigned();

            $table->foreign('endereco_id')
                ->references('id')
                ->on('enderecos');

                
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('universidades');
    }
}
