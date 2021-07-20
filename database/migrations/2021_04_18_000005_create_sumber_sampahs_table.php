<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSumberSampahsTable extends Migration
{
    public function up()
    {
        Schema::create('sumber_sampahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sumber_sampah');
            $table->string('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
