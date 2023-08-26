<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
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
        if (!$jumlah) {
            $jumlah = $this->pokok + $this->bunga;
        }

        return $jumlah + ($this->denda);
    }

    public static function getTotalBunga()
    {
        return self::query()
            ->paid()
            ->sum('bunga');
    }

    public static function getTotalKreditMacet()
    {
        return self::query()
            ->unpaid()
            ->late(15)
            ->sum(DB::raw('pokok + bunga'));
    }

    // Relations
    public function permohonanPinjam()
    {
        return $this->belongsTo(PermohonanPinjam::class, 'id_permohonan_pinjam', 'id_permohonan_pinjam');
    }

    public function scopePaid($query)
    {
        return $query->where('status', 1);
    }

    public function scopeUnpaid($query)
    {
        return $query->where('status', 0);
    }

    public function scopeLate($query, $days)
    {
        return $query->whereHas('permohonanPinjam', function ($query) use ($days) {
            return $query->where('tanggal_terakhir_bayar', '<=', Carbon::now()->subDays($days));
        });
    }
}
