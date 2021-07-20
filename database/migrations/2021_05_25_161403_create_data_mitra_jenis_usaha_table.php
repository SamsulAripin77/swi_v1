<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMitraJenisUsahaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mitra_jenis_usaha', function (Blueprint $table) {
            $table->unsignedBigInteger('data_mitra_id');
            $table->unsignedBigInteger('jenis_usaha_id');
            $table->foreign('data_mitra_id','data_mitra_id_fk_370851234')->references('id')->on('data_mitras')->onDelete('cascade');
            $table->foreign('jenis_usaha_id','jenis_usaha_id_fk_331234')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_mitra_jenis_usaha');
    }
}
