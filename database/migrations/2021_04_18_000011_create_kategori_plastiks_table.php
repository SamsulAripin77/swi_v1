<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriPlastiksTable extends Migration
{
    public function up()
    {
        Schema::create('kategori_plastiks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('jenis_plastik');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
