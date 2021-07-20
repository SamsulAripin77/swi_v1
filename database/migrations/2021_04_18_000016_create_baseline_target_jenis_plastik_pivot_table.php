<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaselineTargetJenisPlastikPivotTable extends Migration
{
    public function up()
    {
        Schema::create('baseline_target_jenis_plastik', function (Blueprint $table) {
            $table->unsignedBigInteger('baseline_target_id');
            $table->foreign('baseline_target_id', 'baseline_target_id_fk_3708931')->references('id')->on('baseline_targets')->onDelete('cascade');
            $table->unsignedBigInteger('jenis_plastik_id');
            $table->foreign('jenis_plastik_id', 'jenis_plastik_id_fk_3708931')->references('id')->on('jenis_plastiks')->onDelete('cascade');
        });
    }
}
