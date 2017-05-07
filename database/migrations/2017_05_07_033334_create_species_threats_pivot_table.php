<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesThreatsPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species_threats', function (Blueprint $table) {
            $table->integer('species_id')->unsigned();
            $table->integer('threat_id')->unsigned();
            $table->nullableTimestamps();

            $table->primary(['species_id', 'threat_id']);

            $table->foreign('species_id')
                  ->references('id')
                  ->on('species')
                  ->onDelete('cascade');

            $table->foreign('threat_id')
                  ->references('id')
                  ->on('threats')
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
        Schema::dropIfExists('species_threats');
    }
}
