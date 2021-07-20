<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_buyer');
            $table->string('no_telp');
            $table->string('alamat');
            $table->string('lokasi_sumber_sampah')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
