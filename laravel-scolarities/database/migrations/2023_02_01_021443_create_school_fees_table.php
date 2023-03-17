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
        Schema::create('school_fees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('level_id');
            $table->foreign('level_id')->references('id')->on('levels');

            $table->unsignedBigInteger('school_year_id');
            $table->foreign('school_year_id')->references('id')->on('school_years');

            $table->integer('montant');

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
        Schema::dropIfExists('school_fees');
    }
};
