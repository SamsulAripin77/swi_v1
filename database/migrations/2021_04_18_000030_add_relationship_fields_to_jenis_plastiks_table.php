<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToJenisPlastiksTable extends Migration
{
    public function up()
    {
        Schema::table('jenis_plastiks', function (Blueprint $table) {
            $table->unsignedBigInteger('kategori_plastik_id');
            $table->foreign('kategori_plastik_id', 'kategori_plastik_fk_3708320')->references('id')->on('kategori_plastiks');
        });
    }
}
