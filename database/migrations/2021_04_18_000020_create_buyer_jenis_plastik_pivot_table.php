<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerJenisPlastikPivotTable extends Migration
{
    public function up()
    {
        Schema::create('buyer_jenis_plastik', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id', 'buyer_id_fk_3708500')->references('id')->on('buyers')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_plastik_id');
            $table->foreign('jenis_plastik_id', 'jenis_plastik_id_fk_3708500')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }
}
