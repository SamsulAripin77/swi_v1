<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTargetToBaselineTargetJenisPlastikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('baseline_target_jenis_plastik', function (Blueprint $table) {
            $table->string('baseline')->nullable()->default(0);
            $table->string('target')->nullable()->default(0);
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
