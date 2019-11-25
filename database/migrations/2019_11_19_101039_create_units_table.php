<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function(Blueprint $table){
           $table->bigIncrements('id');
           $table->string('name');
           $table->timestamps();
        });
        Schema::create('measurement_types', function (Blueprint $table){
            $table->bigIncrements('id');
            $table->string('name');
            $table->double('value')->nullable();

            $table->timestamps();
        });
        Schema::create('measurements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();

            $table->unsignedBigInteger('type_id')->index()->nullable();
            $table->foreign('type_id')->references('id')->on('measurement_types');

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
        Schema::dropIfExists('units');
        Schema::dropIfExists('measurement_types');
        Schema::dropIfExists('measurements');
    }
}
