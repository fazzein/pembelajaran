<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('passein_id');
            $table->float('berat_badan');
            $table->float('tinggi_badan');
            $table->float('lingkar_kepala')->nullable();
            $table->string('tekanan_darah')->nullable();
            $table->string('imunisasi')->nullable();
            $table->integer('usia_kehamilan')->nullable();
            $table->float('tinggi_fundus')->nullable();
            $table->string('detak_jantung_janin')->nullable();
            $table->string('keluhan')->nullable();
            $table->string('keterangan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
