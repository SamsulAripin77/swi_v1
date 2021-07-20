<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DataMitraUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_mitra_user', function (Blueprint $table) {
            $table->unsignedBigInteger('data_mitra_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('data_mitra_id','data_mitra_id_fk_370784001235')->references('id')->on('data_mitras')->onDelete('cascade');
            $table->foreign('user_id','user_id_fk_123419100987')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_mitra_user');
    }
}
