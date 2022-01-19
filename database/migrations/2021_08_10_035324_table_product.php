<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->string('price', 20);
            $table->string('material', 50);
            $table->string('number', 20);
            $table->string('view', 10)->default('0');
            $table->string('image', 100);
            $table->string('id_danhmuc', 10);
            $table->string('slug_danhmuc', 120);
            $table->string('slug_product', 150);
            $table->string('AnHien', 5);
            $table->longText('content');
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
        Schema::dropIfExists('product');
    }
}
