<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagemsTable extends Migration
{

    public function up()
    {
        Schema::create('imagems', function(Blueprint $table) {
            $table->increments('id');
            $table->text('url');
            $table->integer('republica_id')->unsigned();

            $table->foreign('republica_id')
                ->references('id')
                ->on('republicas');
                
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('imagems');
    }
}
