<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBuyersTable extends Migration
{
    public function up()
    {
        Schema::table('buyers', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_usaha_id');
            $table->foreign('jenis_usaha_id', 'jenis_usaha_fk_3708339')->references('id')->on('jenis_usahas');
        });
    }
}
