<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->enum('scope', ['admin', 'seller', 'commenter', 'guest', 'superadmin'])->default('guest');//guest is default
            $table->string('password');
            $table->string('password_confirmation');
            $table->string('phone_number')->nullable()->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->binary('user_image')->nullable()->nullable();//default('user.png');
            $table->string('business_name')->nullable()->unique();
            $table->string('business_name_slug')->nullable()->unique();
            $table->string('biz_logo')->nullable()->unique();
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
};
