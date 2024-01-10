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
        Schema::create('menus',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('title',255)->nullable();
            $table->string('slug',255)->nullable();
            $table->integer('type')->default(0);
            $table->integer('parent_id')->default(0);
            $table->integer('table_id')->default(0);
            $table->integer('sort_by')->default(0);
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
        Schema::dropIfExists('menus');
    }
};
