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
        Schema::create('subsubjects', function (Blueprint $table) {
            $table->id();
            $table->string('subsubject_name');
            $table->string('subject_name')->unique();
            $table->integer('user_id');
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('body');
            $table->enum('status', ['published', 'draft'])->default('published');//published is default
            //$table->string('image');
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
        Schema::dropIfExists('subsubjects');
    }
};
