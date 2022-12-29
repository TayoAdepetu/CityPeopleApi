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
            $table->string('business_name_slug')->unique();
            $table->foreign('business_name_slug')->references('business_name_slug')->on('users')->onUpdate('cascade')
                ->onDelete('cascade')
                ->unique();
            $table->string('description');
            $table->string('number_of_employees');
            $table->string('website');
            $table->string('established');
            $table->enum('verified', ['YES', 'NO']); //->default('YES');
            //$table->string('registered_here');
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
