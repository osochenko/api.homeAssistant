<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensePlaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expense_place', function (Blueprint $table) {
            $table->integer('expense_id')->unsigned();
            $table->integer('place_id')->unsigned();

            $table
                ->foreign('expense_id')
                ->references('id')
                ->on('expenses')
                ->onDelete('cascade');
            $table
                ->foreign('place_id')
                ->references('id')
                ->on('places')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expense_place');
    }
}
