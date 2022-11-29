<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseworksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courseworks', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->integer('subject_id');
            $table->integer('topic_id');
            $table->integer('term_id');
            $table->integer('school_id');
            $table->float('marks');
            $table->integer('created_by')->nullable();
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
        Schema::dropIfExists('courseworks');
    }
}
