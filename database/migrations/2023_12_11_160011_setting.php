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
        Schema::create('setting',function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title',255)->nullable();
            $table->text('meta')->nullable();
            $table->text('keyword')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->tinyInteger('google_index')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->text('content')->nullable();
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
        Schema::dropIfExists('setting');
    }
};
