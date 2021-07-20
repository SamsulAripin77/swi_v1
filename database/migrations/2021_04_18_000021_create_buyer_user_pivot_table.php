<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('buyer_user', function (Blueprint $table) {
            $table->unsignedBigInteger('buyer_id');
            $table->foreign('buyer_id', 'buyer_id_fk_3708347')->references('id')->on('buyers')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_3708347')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
