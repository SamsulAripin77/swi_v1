<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSuppliersTable extends Migration
{
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_usaha_id');
            $table->foreign('jenis_usaha_id', 'jenis_usaha_fk_3708300')->references('id')->on('jenis_usahas');
        });
    }
}
