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
        Schema::create('bizdirectoryproducts', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            /*$table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')
            ->onDelete('cascade')
            ->unique();*/
            $table->string('product_name');
            $table->string('product_name_slug')->unique();
            $table->string('description');
            $table->string('location');
            $table->string('price');
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
        Schema::dropIfExists('bizdirectoryproducts');
    }
};
