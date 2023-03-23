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
        Schema::create('blogimages', function (Blueprint $table) {
            $table->id();
            $table->string('image_path')->unique();
            $table->integer('user_id');
            $table->string('public_id')->unique();
           // $table->integer('category_id');
            $table->string('image_name')->unique();
            $table->string('image_description');
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
        Schema::dropIfExists('afrimages');
    }
};
