<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanPinjam extends Model
{
    use HasFactory;

    protected $table = 'permohonan_pinjam';
    protected $primaryKey = 'id_permohonan_pinjam';
    protected $guarded = [];
    protected $appends = ['sisa_pinjam'];

    public $timestamps = false;

    // Accessors
    public function getSisaPinjamAttribute()
    {
        $jumlahLunas = $this->kitirKredit()->where('status', true)->sum('pokok');
        $sisa = $this->besar_permohonan_pinjam - $jumlahLunas;

        return $sisa < 0 ? 0 : $sisa;
    }

    // Relations
    public function noPinjaman()
    {
        return $this->belongsTo(NoPinjaman::class, 'id_pinjaman', 'id_pinjaman');
    }

    public function kitirKredit()
    {
        return $this->hasMany(KitirKredit::class, 'id_permohonan_pinjam', 'id_permohonan_pinjam');
    }

    // Methods
    public static function getTotal()
    {
        $totalPinjaman = self::where('status', true)->sum('besar_permohonan_pinjam');
        $totalBayar = KitirKredit::where('status', true)->sum('pokok');
        $total = $totalPinjaman - $totalBayar;

        return $total;
    }
}
