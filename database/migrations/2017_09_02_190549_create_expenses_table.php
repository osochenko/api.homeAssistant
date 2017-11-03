<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->integer('price');
            $table->text('description')->nullable();
            $table->date('date');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table
                ->foreign('category_id')
                ->references('id')
                ->on('category_expenses')
                ->onDelete('cascade');

            $table
                ->foreign('type_id')
                ->references('id')
                ->on('type_expenses')
                ->onDelete('cascade');

            $table
                ->foreign('currency_id')
                ->references('id')
                ->on('currencies')
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
        Schema::dropIfExists('expenses');
    }
}
