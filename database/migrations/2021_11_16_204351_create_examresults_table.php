<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examresults', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id');
            $table->integer('student_id');
            $table->integer('school_id');
            $table->integer('form_id');
            $table->integer('term_id');
            $table->integer('subject_id');
            $table->integer('subjectpaper_id')->nullable();
            $table->integer('user_id');
            $table->integer('marks')->nullable();
            $table->integer('effort')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('examresults');
    }
}
