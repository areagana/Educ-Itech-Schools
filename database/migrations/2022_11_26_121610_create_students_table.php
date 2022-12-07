<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('school_id')->constrained();
            $table->string('admin_no')->nullable();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('nin')->nullable();
            $table->string('lin')->nullable();
            $table->year('year')->nullable();
            $table->year('year_joined')->nullable();
            $table->integer('term_joined')->nullable();
            $table->integer('form_id')->contrained()->nullable()->onUpdatecacade();
            $table->integer('stream_id')->contrained()->nullable()->onUpdatecacade();
            $table->integer('user_id')->constrained()->nullable();
            $table->string('payment_code')->nullable();
            $table->string('bar_code')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('contact')->nullable();
            $table->integer('parent_id')->nullable();
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
        Schema::dropIfExists('students');
    }
}
