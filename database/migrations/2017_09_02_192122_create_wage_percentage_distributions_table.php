<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWagePercentageDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wage_percentage_distributions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wage_id')->unsigned();
            $table->string('name');
            $table->integer('percent');
            $table->text('description')->nullable();

            $table
                ->foreign('wage_id')
                ->references('id')
                ->on('wages')
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
        Schema::dropIfExists('wage_percentage_distributions');
    }
}
