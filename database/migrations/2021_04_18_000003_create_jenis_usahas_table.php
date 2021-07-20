p<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    class CreateJenisUsahasTable extends Migration
    {
        public function up()
        {
            Schema::create('jenis_usahas', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('nama_usaha');
                $table->string('keterangan')->nullable();
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }
