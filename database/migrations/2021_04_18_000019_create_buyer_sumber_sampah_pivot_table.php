<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerSumberSampahPivotTable extends Migration
{
    public function up()
    {
        Schema::create('buyer_sumber_sampah', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id', 'buyer_id_fk_3708879')->references('id')->on('buyers')->onDelete('cascade');
            $table->unsignedBigInteger('sumber_sampah_id');
            $table->foreign('sumber_sampah_id', 'sumber_sampah_id_fk_3708879')->references('id')->on('sumber_sampahs')->onDelete('cascade');
        });
    }
}
