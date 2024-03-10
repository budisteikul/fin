<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fin_categories', function (Blueprint $table) {
            $table->id();
			
            $table->bigInteger('parent_id')->default(0);
			$table->string('name')->nullable();
			//$table->enum('type', ['Expenses', 'Revenue', 'Cost of Goods Sold']);
			$table->string('type')->nullable();
            $table->timestamps(6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fin_categories');
    }
}
