<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeciesCountriesPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('species_countries', function (Blueprint $table) {
            $table->integer('species_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->nullableTimestamps();

            $table->primary(['species_id', 'country_id']);

            $table->foreign('species_id')
                  ->references('id')
                  ->on('species')
                  ->onDelete('cascade');

            $table->foreign('country_id')
                  ->references('id')
                  ->on('countries')
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
        Schema::dropIfExists('species_countries');
    }
}
