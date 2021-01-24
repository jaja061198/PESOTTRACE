<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('f_name',250)->nullable();
            $table->string('m_name',250)->nullable();
            $table->string('l_name',250)->nullable();
            $table->string('gender',250)->nullable();
            $table->date('b_day')->nullable();
            $table->string('qr_image',250)->nullable();
            $table->string('image',250)->nullable();
            $table->string('student_id',250)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
