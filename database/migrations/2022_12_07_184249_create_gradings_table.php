<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGradingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gradings', function (Blueprint $table) {
            $table->id();
            $table->integer('level_id')->references('levels');
            $table->float('min_value')->nullable();
            $table->float('max_value')->nullable();
            $table->string('grade_value')->nullable();
            $table->string('grade')->nullable();
            $table->string('gradable')->nullable();
            $table->string('average')->nullable();
            $table->string('highest_value')->nullable();
            $table->string('lowest_value')->nullable();
            $table->string('min_gradable')->nullable();
            $table->integer('user_id')->references('users');
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
        Schema::dropIfExists('gradings');
    }
}
