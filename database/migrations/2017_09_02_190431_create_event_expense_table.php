<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_expense', function (Blueprint $table) {
            $table->integer('expense_id')->unsigned();
            $table->integer('event_id')->unsigned();

            $table
                ->foreign('expense_id')
                ->references('id')
                ->on('expenses')
                ->onDelete('cascade');
            $table
                ->foreign('event_id')
                ->references('id')
                ->on('events')
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
        Schema::dropIfExists('event_expense');
    }
}
