<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSumberSampahSupplierPivotTable extends Migration
{
    public function up()
    {
        Schema::create('sumber_sampah_supplier', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id', 'supplier_id_fk_3708878')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedBigInteger('sumber_sampah_id');
            $table->foreign('sumber_sampah_id', 'sumber_sampah_id_fk_3708878')->references('id')->on('sumber_sampahs')->onDelete('cascade');
        });
    }
}
