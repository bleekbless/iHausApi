<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBairrosTable extends Migration
{

    public function up()
    {
        Schema::create('bairros', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nomeBairro', 100);
            $table->integer('cidade_id')->unsigned();
            $table->foreign('cidade_id')
                ->references('id')
                ->on('cidades');

        });
    }

    public function down()
    {
        Schema::drop('bairros');
    }
}
