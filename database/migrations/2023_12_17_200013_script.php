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
        Schema::create('script',function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('title',255)->nullable();
            $table->longText('widget_code')->nullable();
            $table->tinyInteger('position')->comment('0: Header - 1:After body - 2:Footer');
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
        Schema::dropIfExists('script');
    }
};
