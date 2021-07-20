<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMitraJenisPlastikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mitra_jenis_plastik', function (Blueprint $table) {
            $table->unsignedBigInteger('data_mitra_id');
            $table->unsignedBigInteger('jenis_plastik_id');
            $table->foreign('data_mitra_id','data_mitra_id_fk_3708500')->references('id')->on('data_mitras')->onDelete('cascade');
            $table->foreign('jenis_plastik_id','jenis_plastik_id_fk_1234')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_mitra_jenis_plastik');
    }
}
