<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProgressIncrementalAwalToBaselineTargetJenisPlastikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baseline_target_jenis_plastik', function (Blueprint $table) {
            Schema::table('baseline_target_jenis_plastik', function (Blueprint $table) {
                $table->string('inc_awal')->nullable()->default(0);
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('baseline_target_jenis_plastik', function (Blueprint $table) {
            //
        });
    }
}
