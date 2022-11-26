<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('category_id');
            $table->string('school_name');
            $table->string('school_code');
            $table->string('reg_no')->nullable()->unique();
            $table->string('emis_no')->nullable()->unique();
            $table->string('address');
            $table->string('email')->nullable()->unique();
            $table->string('main_contact')->nullable();
            $table->string('school_website_link')->nullable();
            $table->string('school_logo')->nullable();
            $table->string('water_mark')->nullable();
            $table->integer('user_id');
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
        Schema::dropIfExists('schools');
    }
}
