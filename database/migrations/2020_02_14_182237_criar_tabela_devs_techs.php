<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaDevsTechs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devs_techs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('dev_id')->nullable()->unsigned();
            $table->bigInteger('techs_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('dev_id', 'devs_id_devs_techs')->references('id')->on('devs')->onDelete('set null');
            $table->foreign('techs_id', 'techs_id_devs_techs')->references('id')->on('techs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devs_techs');
    }
}
