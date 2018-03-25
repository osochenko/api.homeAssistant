<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilityRateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('utility_rate_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_utility_id')->unsigned();
            $table->integer('currency_id')->unsigned();
            $table->float('rate');
            $table->integer('limit')->nullable();
            $table->timestamps();

            $table
                ->foreign('type_utility_id')
                ->references('id')
                ->on('type_utilities')
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
        Schema::dropIfExists('utility_rate_rules');
    }
}
