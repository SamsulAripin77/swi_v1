<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisPlastikSupplierPivotTable extends Migration
{
    public function up()
    {
        Schema::create('jenis_plastik_supplier', function (Blueprint $table) {
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id', 'supplier_id_fk_3708489')->references('id')->on('suppliers')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_plastik_id');
            $table->foreign('jenis_plastik_id', 'jenis_plastik_id_fk_3708489')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }
}
