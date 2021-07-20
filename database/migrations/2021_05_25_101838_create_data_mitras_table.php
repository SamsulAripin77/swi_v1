<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMitrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mitras', function (Blueprint $table) {
            $table->id();
            $table->string('nama_mitra')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('jenis_plastik')->nullable();
            $table->string('sumber_sampah')->nullable();
            $table->string('lokasi_sampah')->nullable();
            $table->string('nama_user')->nullable();
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
        Schema::dropIfExists('data_mitras');
    }
}
