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
            $table->string('nip', 25)->unique();
            $table->string('nama');
            $table->string('alamat');
            $table->string('jenis_kelamin', 1); // L atau P
            $table->string('telp', 12);
            $table->string('email', 100);
            $table->date('tmt');
            $table->integer('jabatan_id')->unisigned()->nullable();
            $table->integer('dinas_id')->unisigned()->nullable();
            $table->integer('user_id')->unisigned()->nullable();
            $table->timestamps();
            $table->primary('nip');
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
