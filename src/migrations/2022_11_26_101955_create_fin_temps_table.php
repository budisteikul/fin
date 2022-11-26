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
        Schema::create('fin_temps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type')->nullable();
            $table->integer('year')->nullable();
            $table->integer('month')->nullable();
            //$table->date('date')->nullable();
            $table->float('amount', 8, 2);
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
        Schema::dropIfExists('fin_temps');
    }
};
