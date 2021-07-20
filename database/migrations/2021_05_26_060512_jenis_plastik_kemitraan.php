<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JenisPlastikKemitraan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_plastik_kemitraan', function (Blueprint $table) {
            $table->unsignedBigInteger('kemitraan_id');
            $table->unsignedBigInteger('jenis_plastik_id');
            $table->foreign('kemitraan_id','kemitraan_id_fk_37085001235')->references('id')->on('kemitraans')->onDelete('cascade');
            $table->foreign('jenis_plastik_id','jenis_plastik_id_fk_123411')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jenis_plastik_kemitraan');
    }
}
