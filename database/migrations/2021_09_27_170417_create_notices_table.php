<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
            $table->string('notice_title');
            $table->longText('notice_content');
            $table->string('notice_attachment')->nullable();
            $table->date('start_date')->nullable();
            $table->Time('start_time')->nullable();
            $table->date('close_date')->nullable();
            $table->Time('close_time')->nullable();
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
        Schema::dropIfExists('notices');
    }
}
