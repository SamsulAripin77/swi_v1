<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembeliansTable extends Migration
{
    public function up()
    {
        Schema::create('pembelians', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl_beli')->nullable();
            $table->boolean('konfirmasi')->default(0)->nullable();
            $table->string('total_berat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
 