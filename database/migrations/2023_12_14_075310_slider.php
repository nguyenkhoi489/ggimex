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
        Schema::create('slider',function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title',255)->nullable();
            $table->string('thumb',255)->nullable();
            $table->tinyInteger('type')->default(1);
            $table->string('text',255)->nullable();
            $table->string('subtext',255)->nullable();
            $table->integer('sort_by')->default(0);
            $table->integer('text_position')->nullable();
            $table->tinyInteger('is_active')->nullable();
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
        Schema::dropIfExists('slider');
    }
};
