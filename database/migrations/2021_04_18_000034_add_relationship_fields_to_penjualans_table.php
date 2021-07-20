<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPenjualansTable extends Migration
{
    public function up()
    {
        Schema::table('penjualans', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_buyer_id')->nullable();
            $table->foreign('nama_buyer_id', 'nama_buyer_fk_3708352')->references('id')->on('buyers');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_3708362')->references('id')->on('users');
        });
    }
}
