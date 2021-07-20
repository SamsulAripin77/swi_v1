<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBaselineTargetsTable extends Migration
{
    public function up()
    {
        Schema::table('baseline_targets', function (Blueprint $table) {
            $table->unsignedBigInteger('nama_user_id')->nullable();
            $table->foreign('nama_user_id', 'nama_user_fk_3708930')->references('id')->on('users');
        });
    }
}
