<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayoutKeyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('layout_key', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->timestamps();
            
            $table->index('layout_id');
            $table->bigInteger('layout_id')->unsigned();
            $table->foreign('layout_id')->references('id')->on('layouts');
            
            $table->index('key_id');
            $table->bigInteger('key_id')->unsigned();
            $table->foreign('key_id')->references('id')->on('keys');
            
            $table->integer('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('layout_keys');
    }
}
