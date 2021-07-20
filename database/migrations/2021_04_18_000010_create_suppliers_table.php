<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_supplier');
            $table->string('alamat');
            $table->string('no_telp');
            $table->string('lokasi_sumber_sampah')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
