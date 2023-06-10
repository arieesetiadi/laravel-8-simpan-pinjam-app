<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KitirKredit extends Model
{
    use HasFactory;

    protected $table = 'kitir_kredit';
    protected $primaryKey = 'id_kitir';
    protected $guarded = [];

    public $timestamps = false;

    // Accessors
    public function getDendaAttribute($denda)
    {
        $expiredDate = Carbon::make($this->permohonanPinjam->tanggal_terakhir_bayar)->startOfDay();
        $now = now()->startOfDay();

        // Cek expired (15 hari)
        if ($expiredDate->addDay(15)->lessThanOrEqualTo($now)) {
            $denda = 25000;
        }

        return $denda;
    }

    public function getJumlahAttribute($jumlah)
    {
        if(!$jumlah){
            $jumlah = $this->pokok + $this->bunga;
        }
        
        return $jumlah + ($this->denda);
    }

    // Relations
    public function permohonanPinjam()
    {
        return $this->belongsTo(PermohonanPinjam::class, 'id_permohonan_pinjam', 'id_permohonan_pinjam');
    }
}
