<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKemitraansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemitraans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_beli')->nullable();
            $table->string('nama_mitra')->nullable();
            $table->string('total_berat')->nullable();
            $table->string('photo')->nullable();
            $table->string('video')->nullable();
            $table->boolean('menyetujui')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemitraans');
    }
}
