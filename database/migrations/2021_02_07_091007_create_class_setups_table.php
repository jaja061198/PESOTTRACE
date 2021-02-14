<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSetupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_setups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('grade',250)->nullable();
            $table->string('section',250)->nullable();
            $table->string('subject',250)->nullable();
            $table->string('status',250)->nullable();
            $table->string('adviser',250)->nullable();
            $table->time('time_start')->nullable();
            $table->time('time_end')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_setups');
    }
}
