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
        Schema::create('product_categories',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('title',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('thumb',255)->nullable();
            $table->longText('description')->nullable();
            $table->tinyInteger('is_active')->default(0);
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
        Schema::dropIfExists('product_categories');
    }
};
