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
        Schema::create('penyluhans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_tempat',255);
            $table->string('topik_penyuluhan',255);
            $table->date('tanggal');
            $table->string('penanggung_jawab', 50);
            $table->text('alamat');
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
        Schema::dropIfExists('penyluhans');
    }
};
