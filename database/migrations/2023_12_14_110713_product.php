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
        //
        Schema::create('product',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('title',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('thumb',255)->nullable();
            $table->json('gallery',255)->nullable();
            $table->text('description')->nullable();
            $table->longText('content')->nullable();
            $table->integer('categories_id')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_type')->nullable();
            $table->integer('price_to')->nullable();
            $table->string('sku',255)->nullable();
            $table->integer('prefix_id')->nullable();
            $table->tinyInteger('is_active')->default(1);
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
        //
        Schema::dropIfExists('product');
    }
};
