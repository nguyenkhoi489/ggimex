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
        Schema::create('seo',function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title',255)->nullable();
            $table->text('description')->nullable();
            $table->string('canonical',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->string('thumb')->nullable();
            $table->integer('posts_id')->default(0);
            $table->tinyInteger('google_index')->default(1);
            $table->string('type',255)->nullable();
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
        Schema::dropIfExists('seo');
    }
};
