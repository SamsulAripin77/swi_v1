<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenjualansTable extends Migration
{
    public function up()
    {
        Schema::create('penjualans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl_jual')->nullable();
            $table->boolean('konfirmasi')->default(0);
            $table->string('total_berat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
