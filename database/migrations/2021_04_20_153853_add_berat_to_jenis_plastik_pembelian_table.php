<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBeratToJenisPlastikPembelianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jenis_plastik_pembelian', function (Blueprint $table) {
            $table->string('berat')->nullable();
        });
    }

    /**
     * Reverse the migrations.p
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jenis_plastik_pembelian', function (Blueprint $table) {
            //
        });
    }
}
