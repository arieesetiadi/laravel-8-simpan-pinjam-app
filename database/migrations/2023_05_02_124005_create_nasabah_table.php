<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNasabahTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nasabah', function (Blueprint $table) {
            $table->integer('id_nasabah')->primary();
            $table->integer('id_pegawai');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->string('pekerjaan');
            $table->string('alamat');
            $table->tinyInteger('status_pinjam');
            $table->string('kode_nasabah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nasabah');
    }
}
