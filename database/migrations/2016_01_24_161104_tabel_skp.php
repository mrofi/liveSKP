<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TabelSkp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('skp', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('periode_id')->unsigned()->nullable();
            $table->string('pns_nip', 25)->nullable();
            $table->string('penilai_nip', 25)->nullable();
            $table->integer('nilai')->unsigned();
            $table->date('tanggal_penilaian')->nullable();
            $table->timestamps();

            $table->foreign('periode_id')->references('id')->on('periode')->onDelete('set null');
            $table->foreign('pns_nip')->references('nip')->on('pns')->onDelete('set null');
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
        Schema::drop('skp');
    }
}
