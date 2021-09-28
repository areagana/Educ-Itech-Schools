<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id');
            $table->string('announcement_title');
            $table->string('announcement_category')->nullable();
            $table->string('announcement_attachment')->nullable();
            $table->date('start_date')->nullable();
            $table->Time('start_time')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('announcements');
    }
}
