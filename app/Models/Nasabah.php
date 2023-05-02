<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $guarded = [];

    public $timestamps = false;

    public function pembuat()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function pinjaman()
    {
        return $this->hasMany(NoPinjaman::class, 'id_nasabah', 'id_nasabah');
    }

    public function tabungan()
    {
        return $this->hasMany(NoTabungan::class, 'id_nasabah', 'id_nasabah');
    }

    public function kitir()
    {
        return $this->hasMany(KitirKredit::class, 'id_nasabah', 'id_nasabah');
    }

    public function permohonanPinjam()
    {
        return $this->hasMany(PermohonanPinjam::class, 'id_nasabah', 'id_nasabah');
    }
}
