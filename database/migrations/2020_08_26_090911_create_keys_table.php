<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->id();
            $table->timestamps();
                        
            $table->string('label');
            $table->string('shortcut')->nullable();
            $table->string('value')->nullable();
            $table->string('type');
            $table->unique(['label', 'shortcut']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keys');
    }
}
