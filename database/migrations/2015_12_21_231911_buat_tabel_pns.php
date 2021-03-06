<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTabelPns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nip', 25)->unique();
            $table->string('nama');
            $table->string('alamat');
            $table->string('jenis_kelamin', 1); // L atau P
            $table->string('telp', 13);
            $table->string('email', 100);
            $table->date('tmt');
            $table->integer('instansi_id')->unsigned()->nullable();
            $table->integer('jabatan_id')->unsigned()->nullable();
            $table->integer('atasan_id')->unsigned()->nullable();
            $table->integer('pengguna_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pns', function (Blueprint $table) {
            $table->foreign('instansi_id')->references('id')->on('instansi')->onDelete('set null');
            $table->foreign('jabatan_id')->references('id')->on('jabatan')->onDelete('set null');
            $table->foreign('atasan_id')->references('id')->on('pns')->onDelete('set null');
            $table->foreign('pengguna_id')->references('id')->on('pengguna')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pns');
    }
}
