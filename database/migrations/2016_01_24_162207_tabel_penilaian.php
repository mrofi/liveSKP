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
            $table->string('penilai_nip', 25)->nullable();
            $table->integer('target_kerja_id')->unsigned();
            $table->integer('kuantitas')->unsigned()->nullable();
            $table->integer('kualitas')->unsigned()->nullable();
            $table->integer('waktu')->unsigned()->nullable();
            $table->integer('biaya')->unsigned()->nullable();
            $table->timestamps();
            
            $table->foreign('penilai_nip')->references('nip')->on('pns')->onDelete('set null');
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
