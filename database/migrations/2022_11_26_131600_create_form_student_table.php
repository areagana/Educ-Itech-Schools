<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_student', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('form_id');
            $table->integer('stream_id')->nullable();
            $table->year('year')->nullable();
            $table->integer('academicyear_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_student');
    }
}
