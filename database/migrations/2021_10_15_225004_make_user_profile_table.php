<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_user', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('user_address')->nullable();
            $table->string('contact')->nullable();
            $table->string('nin')->nullable();
            $table->string('nin2')->nullable();
            $table->string('lin')->nullable();
            $table->string('nin2')->nullable();
            $table->string('guardian1')->nullable();
            $table->string('address1')->nullable();
            $table->string('nin1')->nullable();
            $table->string('relationship')->nullable();
            $table->string('contact1')->nullable();
            $table->string('email')->nullable();
            $table->string('guardian2')->nullable();
            $table->string('relationship')->nullable();
            $table->string('address2')->nullable();
            $table->string('nin2')->nullable();
            $table->string('contact2')->nullable();
            $table->string('email')->nullable();
            $table->string('nationality')->nullable();
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
        Schema::dropIfExists('profile_user');
    }
}
