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
            $table->integer('bizdirectory_id');
            $table->string('product_name')->unique();
            $table->string('product_name_slug')->unique();
            $table->string('description');
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
        Schema::dropIfExists('bizdirectoryproducts');
    }
};
