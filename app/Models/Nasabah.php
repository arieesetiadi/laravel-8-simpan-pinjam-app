<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $table = 'nasabah';
    protected $primaryKey = 'id_nasabah';
    protected $guarded = [];

    public $timestamps = false;

    public static function getLeaderboardNasabah()
    {
        // return self::select('nasabah.*')
        //     ->join('no_pinjaman', 'nasabah.id_nasabah', '=', 'no_pinjaman.id_nasabah')
        //     ->join('permohonan_pinjam', 'no_pinjaman.no_pinjaman', '=', 'permohonan_pinjam.id_permohonan_pinjam')
        //     ->groupBy('nasabah.id_nasabah')
        //     ->orderByDesc(DB::raw('SUM(permohonan_pinjam.amount)'))
        //     ->get();
    }

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
