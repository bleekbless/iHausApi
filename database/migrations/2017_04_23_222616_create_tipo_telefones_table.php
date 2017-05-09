<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoTelefonesTable extends Migration
{

    public function up()
    {
        Schema::create('tipoTelefones', function(Blueprint $table) {

            $table->smallIncrements('id');
            $table->string('descricao',50);
           
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tipoTelefones');
    }
}
