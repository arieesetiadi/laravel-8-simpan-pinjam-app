<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoTabungan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'no_tabungan';
    protected $primaryKey = 'id_tabungan';
    protected $guarded = [];
    protected $appends = ['saldo'];

    // Accessors
    public function getSaldoAttribute(){
        $uangMasuk = $this->kas()->where('jenis', 'Uang Masuk')->sum('total');
        $uangKeluar = $this->kas()->where('jenis', 'Uang Keluar')->sum('total');
        $saldo = $uangMasuk - $uangKeluar;
        
        return $saldo;
    }

    // Relations
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah', 'id_nasabah');
    }

    public function kas()
    {
        return $this->hasMany(Kas::class, 'id_tabungan', 'id_tabungan')->orderByDesc('tanggal');
    }

    // Methods
    public static function generateNoTabungan()
    {
        $no = str_pad(self::count() + 1, 3, '0', STR_PAD_LEFT);
        $company = 'BUMDES';
        $month = month_to_roman(now()->month);
        $year = now()->year;

        return "$no/$company/$month/$year";
    }
    
}
