<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConvenienciumRepublicaTable extends Migration
{

    public function up()
    {
        Schema::create('conveniencia_republica', function(Blueprint $table) {
            $table->increments('id');
            
            $table->integer('conveniencia_id')->unsigned()->index();
            $table->integer('republica_id')->unsigned()->index();

            $table->foreign('conveniencia_id')
                ->references('id')
                ->on('conveniencias')->onDelete('cascade');

            $table->foreign('republica_id')
                ->references('id')
                ->on('republicas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('conveniencia_republica');
    }
}
