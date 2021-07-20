<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KemitraanUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kemitraan_user', function (Blueprint $table) {
            $table->unsignedBigInteger('kemitraan_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('kemitraan_id','kemitraan_id_fk_37078001235')->references('id')->on('kemitraans')->onDelete('cascade');
            $table->foreign('user_id','jenis_plastik_id_fk_12341100987')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kemitraan_user');
    }
}
