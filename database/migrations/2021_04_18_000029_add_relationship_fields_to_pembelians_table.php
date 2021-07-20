<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPembeliansTable extends Migration
{
    public function up()
    {
        Schema::table('pembelians', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_supplier_id')->nullable();
            $table->foreign('nama_supplier_id', 'nama_supplier_fk_3708326')->references('id')->on('suppliers');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_3708336')->references('id')->on('users');
        });
    }
}
