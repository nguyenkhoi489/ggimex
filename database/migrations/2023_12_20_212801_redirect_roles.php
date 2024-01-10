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
        Schema::create('redirect_roles',function (Blueprint $table){
            $table->id()->autoIncrement();
            $table->text('old_url')->nullable();
            $table->text('new_url')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->smallInteger('type')->default(301);
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
        Schema::dropIfExists('redirect_roles');
    }
};
