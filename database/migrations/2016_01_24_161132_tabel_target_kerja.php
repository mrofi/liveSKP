<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelTargetKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('target_kerja', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('skp_id')->unsigned();
            $table->string('tugas');
            $table->integer('angka_kredit')->unsigned()->nullable();
            $table->integer('kuantitas')->unsigned()->nullable();
            $table->string('satuan_kuantitas', '20')->nullable();
            $table->integer('kualitas')->unsigned()->nullable();
            $table->string('satuan_kualitas', '20')->nullable();
            $table->integer('waktu')->unsigned()->nullable();
            $table->string('satuan_waktu', '20')->nullable();
            $table->integer('biaya')->unsigned()->nullable();
            $table->string('satuan_biaya', '20')->nullable();
            $table->timestamps();

            $table->foreign('skp_id')->references('id')->on('skp')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('target_kerja');
    }
}
