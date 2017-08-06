<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuariosTable extends Migration
{

    public function up()
    {
        Schema::create('usuarios', function(Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->boolean('admin')->default(false);
            $table->string('nome', 100);
            $table->string('sobrenome', 100);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('notificationToken');
            // Constraints declaration
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios');
    }
}
