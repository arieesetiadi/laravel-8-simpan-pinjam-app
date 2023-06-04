<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKitirKreditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kitir_kredit', function (Blueprint $table) {
            $table->integerIncrements('id_kitir');
            $table->integer('id_permohonan_pinjam');
            $table->date('tanggal_transaksi');
            $table->integer('pokok');
            $table->integer('bunga');
            $table->integer('denda');
            $table->integer('jumlah');
            $table->integer('sisa_pinjam');
            $table->tinyInteger('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kitir_kredit');
    }
}
