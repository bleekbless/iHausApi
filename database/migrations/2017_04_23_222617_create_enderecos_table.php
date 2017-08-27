<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnderecosTable extends Migration
{

    public function up()
    {
        Schema::create('enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('logradouro', 100);
            $table->smallInteger('numero');
            $table->string('complemento', 50)->nullable();
            $table->smallInteger('numeroApto')->nullable();
            $table->integer('bairro_id')->unsigned();
            $table->foreign('bairro_id')
                ->references('id')
                ->on('bairros');
            $table->unsignedSmallInteger('complemento_id');
            $table->foreign('complemento_id')
                ->references('id')
                ->on('comlpementos');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('enderecos');
    }
}
