<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstadosTable extends Migration
{

    public function up()
    {
        Schema::create('estados', function(Blueprint $table) {
            $table->increments('id');
            $table->string('nomeEstado', 70);
            
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('estados');
    }
}
