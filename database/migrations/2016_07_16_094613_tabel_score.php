<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelScore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('score', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('target_kerja_id')->unsigned();
            $table->integer('kuantitas')->nullable();
            $table->integer('kualitas')->nullable();
            $table->integer('waktu')->nullable();
            $table->integer('biaya')->nullable();
            $table->integer('total_nilai')->nullable();
            $table->timestamps();
            
            $table->foreign('target_kerja_id')->references('id')->on('target_kerja');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('score');
    }
}
