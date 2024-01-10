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
        Schema::create('smtp',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->string('host',255)->nullable();
            $table->string('user',255)->nullable();
            $table->string('password',255)->nullable();
            $table->integer('port')->nullable();
            $table->tinyInteger('type')->default(0);
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
        Schema::dropIfExists('smtp');
    }
};
