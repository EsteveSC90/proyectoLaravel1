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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('registration');
            $table->string('type');
            $table->string('brand');
            $table->integer('wheels');
            $table->integer('seats');
            $table->string('color');
            $table->float('price');
            $table->boolean('is_second_hand');
            $table->integer('km');
            $table->boolean('is_available');
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
        Schema::dropIfExists('vehicles');
    }
};
