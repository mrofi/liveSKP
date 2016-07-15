<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetNilaiSigned extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('target_kerja', function (Blueprint $table) {
            $table->integer('nilai')->signed()->change();
        });

        Schema::table('skp', function (Blueprint $table) {
            $table->integer('nilai')->signed()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('target_kerja', function (Blueprint $table) {
            $table->integer('nilai')->unsigned()->change();
        });

        Schema::table('skp', function (Blueprint $table) {
            $table->integer('nilai')->unsigned()->change();
        });
    }
}
