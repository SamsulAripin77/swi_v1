<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMitraSumberSampahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mitra_sumber_sampah', function (Blueprint $table) {
            $table->unsignedBigInteger('data_mitra_id');
            $table->unsignedBigInteger('sumber_sampah_id');
            $table->foreign('data_mitra_id','data_mitra_id_fk_37023500')->references('id')->on('data_mitras')->onDelete('cascade');
            $table->foreign('sumber_sampah_id','sumber_sampah_id_fk_1234')->references('id')->on('sumber_sampahs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_mitra_sumber_sampah');
    }
}
