<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNilaiToTargetKerja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('target_kerja', function (Blueprint $table) {
            $table->integer('nilai')->unsigned()->after('satuan_biaya');
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
            $table->dropColumn('nilai');
        });
    }
}
