<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPlastikPembelianPivotTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_plastik_pembelian', function (Blueprint $table) {
            $table->unsignedBigInteger('pembelian_id');
            $table->foreign('pembelian_id', 'pembelian_id_fk_3708334')->references('id')->on('pembelians')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_plastik_id');
            $table->foreign('jenis_plastik_id', 'jenis_plastik_id_fk_3708334')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }
}
