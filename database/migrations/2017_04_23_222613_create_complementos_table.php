<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComplementosTable extends Migration
{

    public function up()
    {
        Schema::create('complementos', function(Blueprint $table) {
            $table->smallIncrements('id');
            $table->string('descricao', 50);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('complementos');
    }
}
