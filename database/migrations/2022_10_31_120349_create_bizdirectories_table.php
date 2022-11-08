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
        Schema::create('bizdirectories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('business_name')->unique();
            $table->string('business_name_slug');
            $table->string('description');
            $table->string('number_of_employees');
            $table->string('website');
            $table->string('email');
            $table->string('established');
            $table->enum('verified', ['YES', 'NO'])->default('YES');
            $table->string('phone');
            $table->string('registered_here');
            $table->string('location');
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
        Schema::dropIfExists('bizdirectories');
    }
};
