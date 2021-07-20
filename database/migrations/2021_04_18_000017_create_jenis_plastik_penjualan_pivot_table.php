<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPlastikPenjualanPivotTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_plastik_penjualan', function (Blueprint $table) {
            $table->unsignedBigInteger('penjualan_id');
            $table->foreign('penjualan_id', 'penjualan_id_fk_3708359')->references('id')->on('penjualans')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_plastik_id');
            $table->foreign('jenis_plastik_id', 'jenis_plastik_id_fk_3708359')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }
}
