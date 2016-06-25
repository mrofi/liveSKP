<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('penilai_id')->unsigned()->nullable();
            $table->integer('target_kerja_id')->unsigned();
            $table->integer('kuantitas')->unsigned()->nullable();
            $table->integer('kualitas')->unsigned()->nullable();
            $table->integer('waktu')->unsigned()->nullable();
            $table->integer('biaya')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('penilai_id')->references('id')->on('pns')->onDelete('set null');
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
        Schema::drop('penilaian');
    }
}
