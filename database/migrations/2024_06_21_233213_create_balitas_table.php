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
        Schema::create('balitas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_balita',60);
            $table->string('tempat_lahir',60);
            $table->date('tanggal_lahir');
            $table->string('usia',50)->nullable();
            $table->string('nama_ayah',50)->nullable();
            $table->string('nama_ibu',50)->nullable();
            $table->string('no_hp',15)->nullable();
            $table->string('alamat',255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('balitas');
    }
};
