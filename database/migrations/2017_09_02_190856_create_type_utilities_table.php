<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_utilities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->string('name');
            $table->float('rate');
            $table->string('unit');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('type_utilities');
    }
}
