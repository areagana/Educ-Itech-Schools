<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('middlename')->nullable();
            $table->string('email')->unique();
            $table->string('contact')->nullable();
            $table->string('gender')->nullable();
            $table->string('nin')->nullable();
            $table->string('address')->nullable();
            $table->string('status')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('school_id')->nullable();
            $table->biginteger('barcode')->nullable();
            $table->string('account_status')->nullable();
            $table->string('password_status')->nullable();
            $table->string('user_role')->nullable();
            $table->string('image_url')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
