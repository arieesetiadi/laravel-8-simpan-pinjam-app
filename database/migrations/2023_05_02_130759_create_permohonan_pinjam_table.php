<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonanPinjamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan_pinjam', function (Blueprint $table) {
            $table->integerIncrements('id_permohonan_pinjam');
            $table->integer('id_pinjaman');
            $table->date('tanggal');
            $table->integer('besar_permohonan_pinjam');
            $table->integer('jumlah_angsuran');
            $table->tinyInteger('jangka_waktu');
            $table->date('tanggal_terakhir_bayar');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permohonan_pinjam');
    }
}
